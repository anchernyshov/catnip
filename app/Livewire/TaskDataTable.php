<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class TaskDataTable extends DataTable
{
    protected const VIEW_PERMISSION = 'task.read';
    protected const MODIFY_PERMISSION = 'task.modify';
    protected const DELETE_PERMISSION = 'task.delete';
    protected const CLOSE_PERMISSION = 'task.close';
    
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

    public function checkClosePermission() {
        return $this->checkPermission('CLOSE_PERMISSION');
    }

    private function setClosed($id, $val) {
        if (Auth::user()->checkPermission(self::CLOSE_PERMISSION)) {
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
