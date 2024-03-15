<?php

namespace App\Livewire;

use Livewire\Component;

class PermissionDataTable extends DataTable
{
    protected const VIEW_PERMISSION = 'permission.read';
    protected const MODIFY_PERMISSION = 'permission.modify';
    protected const DELETE_PERMISSION = 'permission.delete';
    
    protected $view_name = 'livewire.permission-data-table';
    protected $model = \App\Models\Permission::class;
}
