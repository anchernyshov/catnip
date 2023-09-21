@extends('app')

@section('content')
    @if(Auth::user()->checkPermission('user.read'))
        <a href="/users">Manage users</a>
    @endif
@stop