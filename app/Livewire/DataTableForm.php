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
            $this->clear();
        }
    }

    public function update() {
        if (Auth::user()->checkPermission($this->modify_permission)) {
            $this->validate();
            try {
                $table_name = (new $this->model)->getTable();
                $event_details = [];

                if ($this->selected_id) {
                    $obj = $this->model::find($this->selected_id);
                } else {
                    $obj = new $this->model();
                }
                $attrs = \Schema::getColumnListing($table_name);
                foreach ($this->fields as $key => $value) {
                    if (in_array($key, $attrs)) {
                        if ($obj->$key != $this->fields[$key]) {
                            $event_details['old'][$key] = $obj->$key;
                            $event_details['new'][$key] = $this->fields[$key];
                        }
                        $obj->$key = $this->fields[$key];
                    }
                }
                $obj->save();

                if ($this->selected_id) {
                    \App\Helpers\EventLogger::add('update', $table_name, $obj->id, json_encode($event_details));
                } else {
                    \App\Helpers\EventLogger::add('create', $table_name, $obj->id, null);
                }
                
                $this->dispatch('refresh');
            } catch(\Exception $e) {
                abort(500);
            }
            $this->visible = false;
            $this->clear();
        }
    }

    public function cancel() {
        $this->visible = false;
        $this->clear();
    }

    public function clear() {
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
