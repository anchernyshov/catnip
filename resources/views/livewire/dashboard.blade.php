<div>
    <p>
        @if(Auth::user()->checkPermission('user.read'))
            <a href="/users" wire:navigate>Manage users</a><br/>
        @endif
        @if(Auth::user()->checkPermission('role.read'))
            <a href="/roles" wire:navigate>Manage roles</a><br/>
        @endif
    </p>
</div>