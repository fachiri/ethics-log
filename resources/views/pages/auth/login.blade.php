@extends('layouts.auth')
@section('title', 'Login')
@section('content')
	<h1>Login {{ $setting->app_name }}</h1>
	<p class="auth-subtitle mb-5">{{ $setting->app_desc }}</p>
	<x-main.alerts />
	<form action="{{ route('auth.login.authenticate') }}" method="POST">
		@csrf
		@if (request('from'))
			<input type="hidden" name="from" value="{{ request('from') }}">
		@endif
		<div class="form-group position-relative has-icon-left mb-4">
			<input type="username" name="username" class="form-control form-control-xl" placeholder="Username / Email">
			<div class="form-control-icon">
				<i class="bi bi-person"></i>
			</div>
		</div>
		<div class="form-group position-relative has-icon-left mb-4">
			<input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
			<div class="form-control-icon">
				<i class="bi bi-shield-lock"></i>
			</div>
		</div>
		<button class="btn btn-primary btn-block btn-lg mt-5 shadow-lg">Log in</button>
	</form>
	<div class="fs-4 mt-5 text-center text-lg">
		<p class="text-gray-600">Tidak punya akun? <a href="{{ route('auth.register.index') }}" class="font-bold">Register</a>.</p>
		{{-- <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p> --}}
	</div>
@endsection
