<div>
    <p>
        <div>Users:</div>
        <button wire:click="$dispatchTo('user-data-table-form', 'create')">Add</button>
        <br/>
        <div>
            @foreach ($items as $item)
                <span>{{ $item->id }} </span>
                <span>{{ $item->name }} </span>
                <span>{{ $item->display_name }} </span>
                <span>({{ $item->role->name }}) </span>
                @if (Auth::user()->checkPermission('user.modify'))
                    <button wire:click="$dispatchTo('user-data-table-form', 'modify', { id: {{ $item->id }}})">Edit</button>
                @endif
                @if (Auth::user()->checkPermission('user.delete'))
                    <button wire:click="delete({{ $item->id }})">Delete</button>
                @endif
                <br/>
            @endforeach
        </div>
        @livewire('user-data-table-form')
    </p>
</div>
