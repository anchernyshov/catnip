@extends('app')

@section('content')
    <p>
        <div>Users:</div><br/>
        <div>
            @foreach ($data['users'] as $user)
                <span>{{ $user->id }} </span><span>{{ $user->name }} </span><span>({{ $user->role->name }})</span><br/>
            @endforeach
        </div>
    </p>
@stop