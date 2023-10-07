<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;

class UserDataTableForm extends DataTableForm
{
    const VIEW_PERMISSION = 'user.read';

    protected $modify_permission = 'user.modify';
    protected $view_name = 'livewire.user-data-table-form';
    protected $model = \App\Models\User::class;

    public $roles = [];
    
    public $fields = [
        'name' => null,
        'display_name' => null,
        'password' => null,
        'new_password' => null,
        'role_id' => 2
    ];

    protected $rules = [
        'fields.name' => 'required',
        'fields.display_name' => 'required',
        'fields.role_id' => 'required'
    ];

    public function mount() {
        $roles = \App\Models\Role::get();
        foreach ($roles as $role) {
            $this->roles[$role->id] = $role->name;
        }
    }

    public function update() {
        if (!empty($this->fields['new_password'])) {
            $this->fields['password'] = Hash::make($this->fields['new_password']);
        }
        parent::update();
    }
}
