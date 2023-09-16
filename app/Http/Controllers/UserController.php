<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $name = 'user';

    public function __construct() {
        parent::__construct();
        $this->data['users'] = \App\Models\User::with('role')->get();
    }
}
