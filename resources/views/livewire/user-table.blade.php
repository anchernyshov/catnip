<div>
    <p>
        <div>Users:</div>
        <button wire:click="userCreate">Add</button>
        <br/>
        <div>
            @foreach ($users as $user)
                <span>{{ $user->id }} </span>
                <span>{{ $user->name }} </span>
                <span>({{ $user->role->name }}) </span>
                @if (Auth::user()->checkPermission('user.modify'))
                    <button wire:click="userModify({{ $user->id }})">Edit</button>
                @endif
                @if (Auth::user()->checkPermission('user.delete'))
                    <button wire:click="userDelete({{ $user->id }})">Delete</button>
                @endif
                <br/>
            @endforeach
        </div>
        @if ($form_visible)
            <div>
                <input type="text" wire:model.defer="fields.name"/>
                <input type="password" wire:model.defer="fields.password"/>
                <select wire:model.defer="fields.role_id">
                    @foreach($roles as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                <button wire:click="userUpdate">Save</button>
                <button wire:click="cancel">Cancel</button>
            </div>
        @endif
    </p>
</div>
