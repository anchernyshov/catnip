@extends('app')

@section('content')
    @if(Auth::user()->checkPermission('user.read'))
        <a href="/users">Manage users</a><br/>
    @endif
    @if(Auth::user()->checkPermission('role.read'))
        <a href="/roles">Manage roles</a><br/>
    @endif
@stop