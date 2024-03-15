<div>
    <p>
        <div>Tasks:</div>
        @if ($this->checkModifyPermission())
            <button wire:click="$dispatchTo('task-data-table-form', 'create')">Add</button>
        @endif
        <br/>
        <x-data-table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td>Responsible</td>
                    <td>Priority</td>
                    <td>Due Date</td>
                    <td>Attachments</td>
                    <td>Created by</td>
                    <td>Closed</td>
                    <td>Updated at</td>
                    <td>Created at</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }} </td>
                        <td>{{ $item->name }} </td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->status_id ? $item->status->name : '-' }}</td>
                        <td>{{ $item->responsible ? $item->responsible->display_name : '-' }}</td>
                        <td>{{ $item->priority }}</td>
                        <td>{{ $item->due_date }}</td>
                        <td>{{ $item->attachments }}</td>
                        <td>{{ $item->creator ? $item->creator->display_name : '-' }}</td>
                        <td>{{ $item->closed }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if (!$item->closed)
                            @if ($this->checkClosePermission())
                                    <button wire:click="close({{ $item->id }})">Close</button>
                                @endif
                            @if ($this->checkModifyPermission())
                                    <button wire:click="$dispatchTo('task-data-table-form', 'modify', { id: {{ $item->id }}})">Edit</button>
                                @endif
                            @if ($this->checkDeletePermission())
                                    <button wire:click="delete({{ $item->id }})">Delete</button>
                                @endif
                            @else
                            @if ($this->checkClosePermission())
                                    <button wire:click="return({{ $item->id }})">Return</button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-data-table>
        <div>
            {{ $items->links('components.layouts.pagination') }} 
        </div>
        @livewire('task-data-table-form')
    </p>
</div>