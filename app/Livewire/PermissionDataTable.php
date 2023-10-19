<?php

namespace App\Livewire;

use Livewire\Component;

class PermissionDataTable extends DataTable
{
    const VIEW_PERMISSION = 'permission.read';
    
    protected $delete_permission = 'permission.delete';
    protected $view_name = 'livewire.permission-data-table';
    protected $model = \App\Models\Permission::class;
}
