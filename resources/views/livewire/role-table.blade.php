<div>
    <p>
        <div>Roles:</div>
        <button wire:click="roleCreate">Add</button>
        <br/>
        <div>
            @foreach ($roles as $role)
                <span>{{ $role->id }} </span>
                <span>{{ $role->name }} </span>
                <span>{{ $role->description }} </span>
                <span>{{ $role->added_at }} </span>
                @if (Auth::user()->checkPermission('role.modify'))
                    <button wire:click="roleModify({{ $role->id }})">Edit</button>
                @endif
                @if (Auth::user()->checkPermission('role.delete'))
                    <button wire:click="roleDelete({{ $role->id }})">Delete</button>
                @endif
                <br/>
            @endforeach
        </div>
        @if ($form_visible)
            <div>
                <input type="text" wire:model.defer="fields.name"/>
                <input type="text" wire:model.defer="fields.description"/>
                <button wire:click="roleUpdate">Save</button>
                <button wire:click="cancel">Cancel</button>
            </div>
        @endif
    </p>
</div>
