<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;

class TaskDataTableForm extends DataTableForm
{
    const VIEW_PERMISSION = 'task.read';

    protected $modify_permission = 'task.modify';
    protected $view_name = 'livewire.task-data-table-form';
    protected $model = \App\Models\Task::class;

    public $users = [];
    
    public $fields = [
        'name' => null,
        'description' => null,
        'responsible_id' => null,
        'priority' => 1,
        'due_date' => null,
        'attachments' => '[]',
        'creator_id' => null
    ];

    protected $rules = [
        'fields.name' => 'required',
        'fields.description' => 'required',
        'fields.attachments' => 'required|json'
    ];

    public function update() {
        $this->fields['creator_id'] = Auth::user()->id;
        if ($this->fields['responsible_id'] === "") {
            $this->fields['responsible_id'] = null;
        }
        if ($this->fields['attachments'] == null) {
            $this->fields['attachments'] = '[]';
        }
        parent::update();
    }

    public function mount() {
        $users = \App\Models\User::get();
        foreach ($users as $user) {
            $this->users[$user->id] = $user->display_name;
        }
    }
}
