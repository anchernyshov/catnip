<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;

class DataTable extends Component
{
    use WithPagination;

    const VIEW_PERMISSION = '';

    protected $delete_permission = null;
    protected $view_name = null;
    protected $model = null;
    protected $items_on_page = 6;

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
        $this->items = $this->model::paginate($this->items_on_page);
    }

    public function render() {
        $this->refresh();
        if ($this->view_name) {
            return view($this->view_name, ['items' => $this->items]);
        }
    }
}
