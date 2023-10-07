<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class DataTableForm extends Component
{
    const VIEW_PERMISSION = '';

    protected $modify_permission = null;
    protected $view_name = '';
    protected $model = null;
 
    public $fields = [];
    protected $default_field_values = [];
    protected $rules = [];

    public $visible = false;
    public $selected_id = null;

    protected $listeners = [
        'modify' => 'loadFields',
        'create' => 'create',
    ];

    public function __construct() {
        $this->default_field_values = $this->fields;
    }
    
    public function loadFields($id) {
        if (Auth::user()->checkPermission($this->modify_permission)) {
            $this->resetValidation();
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
        if (Auth::user()->checkPermission($this->modify_permission)) {
            $this->visible = true;
            $this->selected_id = null;
            $this->resetFields();
            $this->resetValidation();
        }
    }

    public function update() {
        if (Auth::user()->checkPermission($this->modify_permission)) {
            $this->validate();
            try {
                if ($this->selected_id) {
                    $obj = $this->model::find($this->selected_id);
                } else {
                    $obj = new $this->model();
                }
                $attrs = \Schema::getColumnListing((new $this->model)->getTable());
                foreach ($this->fields as $key => $value) {
                    if (in_array($key, $attrs)) {
                        $obj->$key = $this->fields[$key];
                    }
                }
                $obj->save();
                $this->dispatch('refresh');
            } catch(\Exception $e) {
                abort(500);
            }
            $this->visible = false;
            $this->resetValidation();
            $this->resetFields();
        }
    }

    public function cancel() {
        $this->visible = false;
        $this->selected_id = null;
        $this->resetValidation();
        $this->resetFields();
    }

    public function resetFields() {
        $this->fields = $this->default_field_values;
    }

    public function render() {
        return view($this->view_name);
    }
}
