@extends('layouts.main')

@section('body')

    <div id="register" class="userLoginRegister">
        <div class="interface">
            @include('left-column.logo')

            <h1>{{ __('Register') }}</h1>
        
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name Field --}}
                <input id="name" type="text" placeholder="{{ __('Name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                {{-- Email Address Field --}}
                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                
                {{-- Confirm Password Field --}}
                <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}" class="form-control" name="password_confirmation" required>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
    </div>

@endsection
