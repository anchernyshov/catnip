<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;

class DataTable extends Component
{
    use WithPagination;

    protected const VIEW_PERMISSION = '';
    protected const MODIFY_PERMISSION = '';
    protected const DELETE_PERMISSION = '';

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

    public function checkViewPermission() {
        return $this->checkPermission('VIEW_PERMISSION');
    }

    public function checkModifyPermission() {
        return $this->checkPermission('MODIFY_PERMISSION');
    }

    public function checkDeletePermission() {
        return $this->checkPermission('DELETE_PERMISSION');
    }

    public function checkPermission($name) {
        $class_reflex = new \ReflectionClass($this);
        $class_constants = $class_reflex->getConstants();
        $constant_value = null;
        if (array_key_exists($name, $class_constants)) {
            $constant_value = $class_constants[$name];
        }
        if ($constant_value) {
            return Auth::user()->checkPermission($constant_value);
        }
        return true;
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
