<?php

namespace App\Livewire;

class RoleDataTableForm extends DataTableForm
{
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

    protected function afterFieldsLoad($obj) {
        foreach ($obj->permissions as $permission) {
            $this->selected_permissions[] = $permission->id;
        }
    }

    protected function afterModelSave($obj) {
        $obj->permissions()->detach();
        $obj->permissions()->attach($this->selected_permissions);
    }

    public function resetFields() {
        $this->selected_permissions = [];
        parent::resetFields();
    }
}