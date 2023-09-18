<?php

namespace App\Livewire;

use Livewire\Component;

class UserTable extends Component
{
    public $users;

    public function mount() {
        $this->users = \App\Models\User::with('role')->get();
    }

    public function render()
    {
        return view('livewire.user-table');
    }
}
