<?php

namespace App\Livewire;

use Livewire\WithPagination;

class DataTable extends BaseComponent
{
    use WithPagination;

    protected $view_name = null;
    protected $model = null;
    protected $items_on_page = 6;

    protected $items = [];

    protected $listeners = [
        'refresh' => 'refresh'
    ];

    public function delete($id) {
        if ($this->checkDeletePermission()) {
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
