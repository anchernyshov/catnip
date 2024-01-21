<?php

namespace App\Livewire;

use Livewire\Component;

class TaskDataTable extends DataTable
{
    const VIEW_PERMISSION = 'task.read';
    
    protected $delete_permission = 'task.delete';
    protected $view_name = 'livewire.task-data-table';
    protected $model = \App\Models\Task::class;
}
