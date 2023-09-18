<div>
    <p>
        <div>Users:</div><br/>
        <div>
            @foreach ($users as $user)
                <span>{{ $user->id }} </span>
                <span>{{ $user->name }} </span>
                <span>({{ $user->role->name }}) </span>
                @if (Auth::user()->checkPermission('user.modify'))
                    <button>Edit</button>
                @endif
                @if (Auth::user()->checkPermission('user.delete'))
                    <button>Delete</button>
                @endif
                <br/>
            @endforeach
        </div>
    </p>
</div>
