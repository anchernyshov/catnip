<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

abstract class BaseComponent extends Component
{
    protected const VIEW_PERMISSION = '';
    protected const MODIFY_PERMISSION = '';
    protected const DELETE_PERMISSION = '';

    public function checkViewPermission() {
        return $this->checkPermission('VIEW_PERMISSION');
    }

    public function checkModifyPermission() {
        return $this->checkPermission('MODIFY_PERMISSION');
    }

    public function checkDeletePermission() {
        return $this->checkPermission('DELETE_PERMISSION');
    }

    protected function checkPermission($name) {
        $class_reflex = new \ReflectionClass($this);
        $class_constants = $class_reflex->getConstants();
        $constant_value = null;
        if (array_key_exists($name, $class_constants)) {
            $constant_value = $class_constants[$name];
        }
        if ($constant_value) {
            return Auth::user()->checkPermission($constant_value);
        }
        return true;
    }
}