@extends('layouts.master')

@section('content')
<div class="container">
    <div id="content">
    <form action="{{ route('postsignup') }}" method="post" class="beta-form-checkout">

            @csrf <!-- Laravel CSRF protection -->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng kí</h4>
                    <div class="space20">&nbsp;</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        
                    @endif

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-block">
                        <label for="name">Fullname*</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-block">
                        <label for="address">Address*</label>
                        <input type="text" id="address" name="address" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>

                    <div class="form-block">
                        <label for="password">Password*</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-block">
                        <label for="repassword">Re-enter password*</label>
                        <input type="password" id="repassword" name="repassword" required>
                    </div>

                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection

@section('js')
<!-- Custom JS scripts -->
<script type="text/javascript">
    $(function() {
        var url = window.location.href;
        $(".main-menu a").each(function() {
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
$(this).parents('li').addClass('parent-active');
            }
        });
    });   

    jQuery(document).ready(function($) {
        'use strict';
        jQuery('#style-selector').animate({ left: '-213px' });
        jQuery('#style-selector a.close').click(function(e){
            e.preventDefault();
            var div = jQuery('#style-selector');
            if (div.css('left') === '-213px') {
                jQuery('#style-selector').animate({ left: '0' });
                jQuery(this).removeClass('icon-angle-left').addClass('icon-angle-right');
            } else {
                jQuery('#style-selector').animate({ left: '-213px' });
                jQuery(this).removeClass('icon-angle-right').addClass('icon-angle-left');
            }
        });
    });
</script>
@endsection