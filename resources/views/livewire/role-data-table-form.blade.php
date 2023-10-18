<x-data-table-form wire:model="visible">
    <div>
        <input type="text" wire:model.defer="fields.name"/>
        <input type="text" wire:model.defer="fields.description"/>
        <button wire:click="update">Save</button>
        <button wire:click="cancel">Cancel</button>
    </div>
    <div>
        @error('fields.name') <span>{{ $message }}</span> @enderror
        @error('fields.description') <span>{{ $message }}</span> @enderror
    </div>
</x-data-table-form>