<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{   
    public function index()
    {
        return view('admin.contact');
    }
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'your-name' => 'required|string|max:255',
            'your-email' => 'required|email|max:255',
            'your-subject' => 'nullable|string|max:255',
            'your-message' => 'required|string',
            
        ]);

        Contact::create([
            'name' => $validated['your-name'],
            'email' => $validated['your-email'],
            'subject' => $validated['your-subject'],
            'message' => $validated['your-message'],

        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
