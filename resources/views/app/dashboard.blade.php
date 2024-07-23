@extends('layouts.app')
@section('title', 'Dashboard')

Hello Mister
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
