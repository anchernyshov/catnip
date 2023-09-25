<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class DataTable extends Component
{
    public static $view_permission = null;

    protected $delete_permission = null;
    protected $view_name = null;
    protected $model = null;

    public $items = [];

    protected $listeners = [
        'refresh' => 'refresh'
    ];

    public function delete($id) {
        if (Auth::user()->checkPermission($this->delete_permission)) {
            try {
                $this->model::find($id)->delete();
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
            return view($this->view_name);
        }
    }
}
