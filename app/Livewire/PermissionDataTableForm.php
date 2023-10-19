<?php

namespace App\Livewire;

class PermissionDataTableForm extends DataTableForm
{
    const VIEW_PERMISSION = 'permission.read';

    protected $modify_permission = 'permission.modify';
    protected $view_name = 'livewire.permission-data-table-form';
    protected $model = \App\Models\Permission::class;
    
    public $fields = [
        'name' => null,
        'description' => null
    ];

    protected $rules = [
        'fields.name' => 'required',
        'fields.description' => 'required'
    ];
}
