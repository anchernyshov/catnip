<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class RoleTable extends Component
{
    public $roles;
    public $selected_role_id = null;
    public $form_visible = false;

    public $fields = [
        'name' => '',
        'description' => ''
    ];

    public function roleCreate() {
        $this->form_visible = true;
        $this->selected_role_id = null;
    }

    public function roleModify($id) {
        if (Auth::user()->checkPermission('role.modify')) {
            $this->selected_role_id = $id;
            $this->form_visible = true;
            try {
                $role = \App\Models\Role::find($id);
                $this->fields['name'] = $role->name;
                $this->fields['description'] = $role->description;
            } catch(\Exception $e) {
                abort(500);
            }
        }
    }

    public function roleUpdate() {
        if (Auth::user()->checkPermission('role.modify')) {
            try {
                if ($this->selected_role_id) {
                    $role = \App\Models\Role::find($this->selected_role_id);
                } else {
                    $role = new \App\Models\Role();
                }
                $role->name = $this->fields['name'];
                $role->description = $this->fields['description'];
                $role->save();
            } catch(\Exception $e) {
                dd($e);
                abort(500);
            }
            $this->form_visible = false;
            $this->resetFields();
        }
    }

    public function roleDelete($id) {
        if (Auth::user()->checkPermission('role.delete')) {
            try {
                \App\Models\Role::find($id)->delete();
            } catch (\Exception $e) {
                abort(500);
            }
        }
    }

    public function cancel() {
        $this->form_visible = false;
        $this->selected_role_id = null;
        $this->resetFields();
    }

    public function resetFields() {
        foreach ($this->fields as $key => $value) {
            $this->fields[$key] = '';
        }
    }

    public function refresh() {
        $this->roles = \App\Models\Role::get();
    }

    public function render() {
        $this->refresh();
        return view('livewire.role-table');
    }
}
