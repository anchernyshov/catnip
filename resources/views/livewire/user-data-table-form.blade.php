<div>
    @if ($visible)
        <div>
            <input type="text" wire:model.defer="fields.name"/>
            <input type="text" wire:model.defer="fields.display_name"/>
            <input type="password" wire:model.defer="fields.new_password"/>
            <select wire:model.defer="fields.role_id">
                @foreach($roles as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
            <button wire:click="update">Save</button>
            <button wire:click="cancel">Cancel</button>
        </div>
    @endif
</div>
