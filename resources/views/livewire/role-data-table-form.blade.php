<x-data-table-form wire:model="visible">
    <div>
        <input type="text" wire:model.defer="fields.name"/>
        <input type="text" wire:model.defer="fields.description"/>
        <div>
            @foreach ($permissions as $key => $permission)
                <input wire:model.defer="selected_permissions" wire:key="{{ 'permission-' . $key }}" type="checkbox" id="{{ 'permission-' . $key }}" name="permission" value="{{ $key }}" />
                <label for="{{ 'permission-' . $key }}">{{ $permission }}</label><br>
            @endforeach
        </div>
        <button wire:click="update">Save</button>
        <button wire:click="cancel">Cancel</button>
    </div>
    <div>
        @error('fields.name') <span>{{ $message }}</span> @enderror
        @error('fields.description') <span>{{ $message }}</span> @enderror
    </div>
</x-data-table-form>