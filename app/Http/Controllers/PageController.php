<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    // Show trang index
    public function index(){
        $new_products = Product::where('new', 1)->get();
        return view('banhang.index', compact('new_products'));
    }

    // Chi tiết sản phẩm
    public function detail($id){
        $product = Product::find($id); // Lấy sản phẩm theo ID
        return view('banhang.productDetail', compact('product'));
    }

    // giỏ hàng
    public function addToCart(Request $request,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
     }

     public function delCartItem($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else Session::forget('cart');
        return redirect()->back();
    }

    public function getCheckout(){
        return view('layouts.checkout');
    }

    public function postCheckout(Request $request){
    
        $cart=Session::get('cart');
        $customer=new Customer();
        $customer->name=$request->input('name');
        $customer->gender=$request->input('gender');
        $customer->email=$request->input('email');
        $customer->address=$request->input('address');
        $customer->phone_number=$request->input('phone_number');
        $customer->note=$request->input('notes');
        $customer->save();

        $bill=new Bill();
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$request->input('payment_method');
        $bill->note=$request->input('notes');
        $bill->save();

        foreach($cart->items as $key=>$value)
        {
            $bill_detail=new BillDetail();
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=$value['price']/$value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('success','Đặt hàng thành công');

    }
   public function getSignup() {
        return view('dangky.dangky');
    }
    public function getLogin()
    {
        return view('dangnhap.login');
    }
    public function postSignup(Request $req) {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'name' => 'required',
            'repassword' => 'required|same:password',
        ];
    
        $messages = [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã có người sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'repassword.same' => 'Mật khẩu không giống nhau',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
        ];
    
        $validator = Validator::make($req->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password); 
        $user->phone = $req->phone;
        $user->level = 3;
        $user->address = $req->address;
        $user->save();
    
        return redirect()->route('getsignup')->with('success', 'Tạo tài khoản thành công. Vui lòng đăng nhập.');
    }
    
    public function postLogin(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự'
            ]
        );
    
        $credentials = ['email' => $request->email, 'password' => $request->password];
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->level == 1) {
                return redirect()->route('admin.postLogin')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
            } elseif ($user->level == 3) {
                return redirect()->route('banhang.index')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
            } else {
                // Handle other levels if necessary
                return redirect()->route('banhang.index')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
            }
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
    }
    
    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('banhang.index');
    }
    public function getInputEmail(){
        return view('emails.input-email');
    }

//hàm xử lý gửi email
    public function postInputEmail(Request $req){
        $email=$req->txtEmail;
        //validate

        // kiểm tra có user có email như vậy không
        $user=User::where('email',$email)->get();
        //dd($user);
        if($user->count()!=0){
            //gửi mật khẩu reset tới email
            $sentData = [
                'title' => 'Mật khẩu mới của bạn là:',
                'body' => '123456'
            ];
            Mail::to($email)->send(new \App\Mail\SendMail($sentData));
            Session::flash('message', 'Send email successfully!');
            return view('dangnhap.login');  //về lại trang đăng nhập của khách
        }
        else {
              return redirect()->route('getInputEmail')->with('message','Your email is not right');
        }
    }//hết postInputEmail
}