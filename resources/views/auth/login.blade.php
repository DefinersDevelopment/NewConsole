@extends('layouts.main')

@section('body')
    
    <div id="login" class="userLoginRegister">
        <div class="interface">
            @include('left-column.logo')

            <h1>{{ __('Login') }}</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email Address Field --}}
                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                
                {{-- Password Field --}}
                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
                {{-- Remember Me Checkbox --}}
                {{-- <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label> --}}
                 
                {{-- Submit Button --}}
                <button type="submit" class="btn">
                    {{ __('Login') }}
                </button>

                {{-- Forgot Password Button --}}
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>  
            </form>
        </div>
    </div>    

@endsection
