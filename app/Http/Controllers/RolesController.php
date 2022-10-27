<?php

use TCG\Voyager\Models\Role as Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return $roles;
    }
}
