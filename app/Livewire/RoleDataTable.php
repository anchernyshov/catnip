<?php

namespace App\Livewire;

use Livewire\Component;

class RoleDataTable extends DataTable
{
    public static $view_permission = 'role.read';
    
    protected $delete_permission = 'role.delete';
    protected $view_name = 'livewire.role-data-table';
    protected $model = \App\Models\Role::class;
}
