<?php

namespace App\Livewire;

use Livewire\Component;

class UserDataTable extends DataTable
{
    protected const VIEW_PERMISSION = 'user.read';
    protected const MODIFY_PERMISSION = 'user.modify';
    protected const DELETE_PERMISSION = 'user.delete';
    
    protected $view_name = 'livewire.user-data-table';
    protected $model = \App\Models\User::class;
}
