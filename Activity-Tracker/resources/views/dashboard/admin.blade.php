@extends('master')
<!-- Main.blade.php -->
@section('site-content')
<center>
    <p>Welcome Back Admin,

        @if (session()->has('userdata'))
            <b>{{ucfirst(session()->get('userdata')->name)}}</b>
            (
            <b>{{session()->get('userdata')->email}}</b>
            )
        @endif
        <hr />
    </p>
    @include('dashboard.layouts.nav')
    @yield('admin-content')
</center>
@endsection