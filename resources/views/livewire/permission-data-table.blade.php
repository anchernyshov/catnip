<div>
    <p>
        <div>Permissions:</div>
        @if ($this->checkModifyPermission())
            <button wire:click="$dispatchTo('permission-data-table-form', 'create')">Add</button>
        @endif
        <br/>
        <x-data-table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Created at</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }} </td>
                        <td>{{ $item->name }} </td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->added_at }}</td>
                        <td>
                            @if ($this->checkModifyPermission())
                                <button wire:click="$dispatchTo('permission-data-table-form', 'modify', { id: {{ $item->id }}})">Edit</button>
                            @endif
                            @if ($this->checkDeletePermission())
                                <button wire:click="delete({{ $item->id }})">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-data-table>
        @livewire('permission-data-table-form')
    </p>
</div>
