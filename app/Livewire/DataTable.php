<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class DataTable extends Component
{
    const VIEW_PERMISSION = '';

    protected $delete_permission = null;
    protected $view_name = null;
    protected $model = null;

    protected $items = [];

    protected $listeners = [
        'refresh' => 'refresh'
    ];

    public function delete($id) {
        if (Auth::user()->checkPermission($this->delete_permission)) {
            try {
                $this->model::find($id)->delete();
                \App\Helpers\EventLogger::add('delete', (new $this->model)->getTable(), $id, null);
            } catch (\Exception $e) {
                abort(500);
            }
        }
    }

    public function refresh() {
        $this->items = $this->model::get();
    }

    public function render() {
        $this->refresh();
        if ($this->view_name) {
            return view($this->view_name, ['items' => $this->items]);
        }
    }
}
