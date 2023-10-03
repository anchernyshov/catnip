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

    public function mount() {
        $this->roles = \App\Models\Role::get();
    }

    public function update() {
        if (!empty($this->fields['new_password'])) {
            $this->fields['password'] = Hash::make($this->fields['new_password']);
        }
        parent::update();
    }
}
