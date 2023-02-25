<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
      }
      public function index() {
        return view('manager.dashboard');
      }
}
