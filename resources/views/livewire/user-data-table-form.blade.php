<x-data-table-form wire:model="visible">
    <div>
        <input type="text" wire:model.defer="fields.name"/>
        <input type="text" wire:model.defer="fields.display_name"/>
        <input type="password" wire:model.defer="fields.new_password"/>
        <select wire:model.defer="fields.role_id">
            @foreach($roles as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <button wire:click="update">Save</button>
        <button wire:click="cancel">Cancel</button>
    </div>
    <div>
        @error('fields.name') <span>{{ $message }}</span> @enderror
        @error('fields.display_name') <span>{{ $message }}</span> @enderror
        @error('fields.role_id') <span>{{ $message }}</span> @enderror
    </div>
</x-data-table-form>