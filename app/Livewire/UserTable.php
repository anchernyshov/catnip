<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserTable extends Component
{
    public $users;
    public $roles;
    public $selected_user_id = null;
    public $form_visible = false;

    public $fields = [
        'name' => '',
        'password' => '',
        'role_id' => ''
    ];

    public function userCreate() {
        $this->form_visible = true;
        $this->selected_user_id = null;
    }

    public function userModify($id) {
        if (Auth::user()->checkPermission('user.modify')) {
            $this->selected_user_id = $id;
            $this->form_visible = true;
            try {
                $user = \App\Models\User::find($id);
                $this->fields['name'] = $user->name;
                $this->fields['role_id'] = $user->role_id;
            } catch(\Exception $e) {
                abort(500);
            }
        }
    }

    public function userUpdate() {
        if (Auth::user()->checkPermission('user.modify')) {
            try {
                if ($this->selected_user_id) {
                    $user = \App\Models\User::find($this->selected_user_id);
                } else {
                    $user = new \App\Models\User();
                }
                $user->name = $this->fields['name'];
                if (!empty($this->fields['password'])) {
                    $user->password = Hash::make($this->fields['password']);
                }
                $user->role_id = $this->fields['role_id'];
                $user->save();
            } catch(\Exception $e) {
                abort(500);
            }
            $this->form_visible = false;
            $this->resetFields();
        }
    }

    public function userDelete($id) {
        if (Auth::user()->checkPermission('user.delete')) {
            try {
                \App\Models\User::find($id)->delete();
            } catch (\Exception $e) {
                abort(500);
            }
        }
    }

    public function cancel() {
        $this->form_visible = false;
        $this->selected_user_id = null;
        $this->resetFields();
    }

    public function resetFields() {
        foreach ($this->fields as $key => $value) {
            $this->fields[$key] = '';
        }
    }

    public function refresh() {
        $this->users = \App\Models\User::with('role')->get();
        $this->roles = \App\Models\Role::get();
    }

    public function render() {
        $this->refresh();
        return view('livewire.user-table');
    }
}
