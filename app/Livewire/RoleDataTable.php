<?php

namespace App\Livewire;

use Livewire\Component;

class RoleDataTable extends DataTable
{
    protected const VIEW_PERMISSION = 'role.read';
    protected const MODIFY_PERMISSION = 'role.modify';
    protected const DELETE_PERMISSION = 'role.delete';
    
    protected $view_name = 'livewire.role-data-table';
    protected $model = \App\Models\Role::class;
}
