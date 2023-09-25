<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class DataTableForm extends Component
{
    public static $view_permission = null;

    protected $modify_permission = null;
    protected $view_name = '';
    protected $model = null;
    
    public $fields = [];
    public $visible = false;
    public $selected_id = null;

    protected $listeners = [
        'modify' => 'loadFields',
        'create' => 'create',
    ];
    
    public function loadFields($id) {
        if (Auth::user()->checkPermission($this->modify_permission)) {
            $this->visible = true;
            try {
                $obj = $this->model::find($id);
                $attrs = $obj->getAttributes();
                $this->selected_id = $id;
                foreach ($this->fields as $key => $value) {
                    if (array_key_exists($key, $attrs)) {
                        $this->fields[$key] = $obj->$key;
                    }
                }
            } catch(\Exception $e) {
                abort(500);
            }
        }
    }

    public function create() {
        $this->visible = true;
        $this->selected_id = null;
    }

    public function update() {
        if (Auth::user()->checkPermission($this->modify_permission)) {
            try {
                if ($this->selected_id) {
                    $obj = $this->model::find($this->selected_id);
                } else {
                    $obj = new $this->model();
                }
                $attrs = $obj->getAttributes();
                foreach ($this->fields as $key => $value) {
                    if (array_key_exists($key, $attrs)) {
                        $obj->$key = $this->fields[$key];
                    }
                }
                $obj->save();
                $this->dispatch('refresh');
            } catch(\Exception $e) {
                abort(500);
            }
            $this->visible = false;
            $this->resetFields();
        }
    }

    public function cancel() {
        $this->visible = false;
        $this->selected_id = null;
        $this->resetFields();
    }

    public function resetFields() {
        foreach ($this->fields as $key => $value) {
            $this->fields[$key] = '';
        }
    }

    public function render() {
        return view($this->view_name);
    }
}
