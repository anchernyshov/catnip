<?php

namespace App\Livewire;

class RoleDataTableForm extends DataTableForm
{
    public static $view_permission = 'role.read';

    protected $modify_permission = 'role.modify';
    protected $view_name = 'livewire.role-data-table-form';
    protected $model = \App\Models\Role::class;
    
    public $fields = [
        'name' => '',
        'description' => ''
    ];
}
