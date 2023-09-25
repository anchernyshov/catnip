<div>
    @if ($visible)
        <div>
            <input type="text" wire:model.defer="fields.name"/>
            <input type="text" wire:model.defer="fields.description"/>
            <button wire:click="update">Save</button>
            <button wire:click="cancel">Cancel</button>
        </div>
    @endif
</div>
