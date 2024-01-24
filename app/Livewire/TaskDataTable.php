<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class TaskDataTable extends DataTable
{
    const VIEW_PERMISSION = 'task.read';
    
    protected $delete_permission = 'task.delete';
    protected $close_permission = 'task.close';
    protected $view_name = 'livewire.task-data-table';
    protected $model = \App\Models\Task::class;
    
    public function __construct() {
        $this->listeners['close'] = 'close';
        $this->listeners['return'] = 'return';
    }

    public function close($id) {
        $this->setClosed($id, 1);
    }

    public function return($id) {
        $this->setClosed($id, 0);
    }

    private function setClosed($id, $val) {
        if (Auth::user()->checkPermission($this->close_permission)) {
            try {
                $task = $this->model::find($id);
                if ($task) {
                    $event_details = ['old' => ['closed' => $task->closed], 'new' => ['closed' => $val]];
                    $task->closed = $val;
                    $task->save();
                    \App\Helpers\EventLogger::add('update', (new $this->model)->getTable(), $id, json_encode($event_details));
                }
            } catch (\Exception $e) {
                abort(500);
            }
        }
    }

}
