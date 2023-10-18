<div>
    <p>
        <div>Users:</div>
        @if (Auth::user()->checkPermission('user.modify'))
            <button wire:click="$dispatchTo('user-data-table-form', 'create')">Add</button>
        @endif
        <br/>
        <x-data-table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Display name</td>
                    <td>Role</td>
                    <td>Created at</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }} </td>
                        <td>{{ $item->name }} </td>
                        <td>{{ $item->display_name }}</td>
                        <td>{{ $item->role->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if (Auth::user()->checkPermission('user.modify'))
                                <button wire:click="$dispatchTo('user-data-table-form', 'modify', { id: {{ $item->id }}})">Edit</button>
                            @endif
                            @if (Auth::user()->checkPermission('user.delete'))
                                <button wire:click="delete({{ $item->id }})">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-data-table>
        @livewire('user-data-table-form')
    </p>
</div>