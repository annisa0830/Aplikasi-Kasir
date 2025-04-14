@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, Admin!</p>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endsection
