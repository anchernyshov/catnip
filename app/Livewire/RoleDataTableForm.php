<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;

class RoleDataTableForm extends DataTableForm
{
    const VIEW_PERMISSION = 'role.read';

    protected $modify_permission = 'role.modify';
    protected $view_name = 'livewire.role-data-table-form';
    protected $model = \App\Models\Role::class;

    public $permissions = [];

    public $selected_permissions = [];
    public $fields = [
        'name' => null,
        'description' => null
    ];

    protected $rules = [
        'fields.name' => 'required',
        'fields.description' => 'required'
    ];

    public function mount() {
        $permissions = \App\Models\Permission::get();
        foreach ($permissions as $permission) {
            $this->permissions[$permission->id] = $permission->name;
        }
    }

    public function loadFields($id) {
        if (Auth::user()->checkPermission($this->modify_permission)) {
            $this->clear();
            try {
                $obj = $this->model::with('permissions')->find($id);
                $attrs = $obj->getAttributes();
                $this->selected_id = $id;
                foreach ($this->fields as $key => $value) {
                    if (array_key_exists($key, $attrs)) {
                        $this->fields[$key] = $obj->$key;
                    }
                }
                foreach ($obj->permissions as $permission) {
                    $this->selected_permissions[] = $permission->id;
                }
                $this->visible = true;
            } catch(\Exception $e) {
                abort(500);
            }
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
                $saved = $obj->save();
                if ($saved) {
                    \App\Models\Role::find($obj->id)->permissions()->detach();
                    \App\Models\Role::find($obj->id)->permissions()->attach($this->selected_permissions);
                } else {
                    abort(500);
                }
                $this->dispatch('refresh');
            } catch(\Exception $e) {
                abort(500);
            }
            $this->visible = false;
            $this->clear();
        }
    }

    public function resetFields() {
        $this->selected_permissions = [];
        parent::resetFields();
    }
}