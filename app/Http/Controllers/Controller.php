<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected $name = null;
    protected $data = [];

    public function __construct() {
        $this->middleware('simple');
    }

    protected function index() {
        if ($this->name != null) {
            if (!Auth::user()->checkPermission($this->name . '.read')) {
                abort(403);
            }
            return view($this->name, ['data' => $this->data]);
        }

        abort(404);
    }
}
