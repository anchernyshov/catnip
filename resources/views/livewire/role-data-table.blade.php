<div>
    <p>
        <div>Roles:</div>
        @if (Auth::user()->checkPermission('role.modify'))
            <button wire:click="$dispatchTo('role-data-table-form', 'create')">Add</button>
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
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if (Auth::user()->checkPermission('role.modify'))
                                <button wire:click="$dispatchTo('role-data-table-form', 'modify', { id: {{ $item->id }}})">Edit</button>
                            @endif
                            @if (Auth::user()->checkPermission('role.delete'))
                                <button wire:click="delete({{ $item->id }})">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-data-table>
        @livewire('role-data-table-form')
    </p>
</div>