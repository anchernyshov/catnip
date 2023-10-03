<div>
    <p>
        <div>Roles:</div>
        @if (Auth::user()->checkPermission('role.modify'))
            <button wire:click="$dispatchTo('role-data-table-form', 'create')">Add</button>
        @endif
        <br/>
        <div>
            @foreach ($items as $item)
                <span>{{ $item->id }} </span>
                <span>{{ $item->name }} </span>
                <span>{{ $item->description }} </span>
                <span>{{ $item->added_at }} </span>
                @if (Auth::user()->checkPermission('role.modify'))
                    <button wire:click="$dispatchTo('role-data-table-form', 'modify', { id: {{ $item->id }}})">Edit</button>
                @endif
                @if (Auth::user()->checkPermission('role.delete'))
                    <button wire:click="delete({{ $item->id }})">Delete</button>
                @endif
                <br/>
            @endforeach
        </div>
        @livewire('role-data-table-form')
    </p>
</div>
