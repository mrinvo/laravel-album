@extends('layouts.app')

@section('content')
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <h1>Welcome</h1>
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
    	
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


    	@csrf
      <input type="text" id="login" class="fadeIn second" name="email" placeholder="{{ __('E-Mail Address') }}">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="{{ __('Password') }}">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="{{ route('password.request') }}">Forgot Password?</a>
    </div>

  </div>
</div>

@endsection
