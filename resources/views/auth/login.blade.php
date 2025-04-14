@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <div class="card shadow-lg rounded-4">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="fw-bold">Login</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required>
                        @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <div>
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Ingat Saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>

                    <div class="text-center mt-3">
                        <span>Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill px-4">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
