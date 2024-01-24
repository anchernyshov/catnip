<x-data-table-form wire:model="visible">
    <div>
        <input type="text" wire:model.defer="fields.name"/>
        <input type="text" wire:model.defer="fields.description"/>
        <select wire:model.defer="fields.status_id">
            <option value="">No status selected</option>
            @foreach($statuses as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <select wire:model.defer="fields.responsible_id">
            <option value="">No user selected</option>
            @foreach($users as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <input type="text" wire:model.defer="fields.priority"/>
        <input type="text" wire:model.defer="fields.due_date"/>
        <input type="text" wire:model.defer="fields.attachments"/>
        <button wire:click="update">Save</button>
        <button wire:click="cancel">Cancel</button>
    </div>
    <div>
        @error('fields.name') <span>{{ $message }}</span> @enderror
        @error('fields.description') <span>{{ $message }}</span> @enderror
        @error('fields.attachments') <span>{{ $message }}</span> @enderror
    </div>
</x-data-table-form>