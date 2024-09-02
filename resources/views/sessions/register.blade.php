@extends('components.layout')

@section('content')
    <x-auth-form :action="route('register')">
        <div class="form-outline mb-4">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control form-control-lg" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name" />
            <x-error name="name" />
        </div>

        <div class="form-outline mb-4">
            <label for="username" class="col-form-label">{{ __('Username') }}</label>
            <input id="username" type="text" class="form-control form-control-lg" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Enter your username" />
            <x-error name="username" />
        </div>

        <div class="form-outline mb-4">
            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter a valid email address" />
            <x-error name="email" />
        </div>

        <div class="form-outline mb-3">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control form-control-lg" name="password" required autocomplete="new-password" placeholder="Enter password" />
            <x-error name="password" />
        </div>
        
        <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="/login" class="link-danger">Login</a></p>
        </div>
    </x-auth-form>
@endsection
