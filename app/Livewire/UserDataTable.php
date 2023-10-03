<?php

namespace App\Livewire;

use Livewire\Component;

class UserDataTable extends DataTable
{
    const VIEW_PERMISSION = 'user.read';
    
    protected $delete_permission = 'user.delete';
    protected $view_name = 'livewire.user-data-table';
    protected $model = \App\Models\User::class;
}
