<?php

namespace App\Livewire;

use Livewire\Component;

class UserDataTable extends DataTable
{
    public static $view_permission = 'user.read';
    
    protected $delete_permission = 'user.delete';
    protected $view_name = 'livewire.user-data-table';
    protected $model = \App\Models\User::class;
}
