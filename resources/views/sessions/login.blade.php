@extends('components.layout')

@section('content')
    <x-auth-form :action="route('login')">
        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <a href="https://www.facebook.com" target="_blank" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com" target="_blank" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        

        <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">OR</p>
        </div>

        <div class="form-outline mb-4">
            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter a valid email address" />
            <x-error name="email" />
        </div>

        <div class="form-outline mb-3">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control form-control-lg" name="password" required autocomplete="current-password" placeholder="Enter password" />
            <x-error name="password" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
        </div>

        <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/register" class="link-danger">Register</a></p>
        </div>
    </x-auth-form>
@endsection
