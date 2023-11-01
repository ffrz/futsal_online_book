<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
    //
    public function index()
    {
        $items = DB::table('user_groups', 'g')
            ->selectRaw('g.id, g.name, (select count(0) from users u where u.group_id = g.id) as userCount')
            ->orderBy('g.name', 'asc')
            ->get();

        return view('admin.user-groups.index', compact('items'));
    }
}
