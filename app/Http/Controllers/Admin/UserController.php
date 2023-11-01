<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function add()
    {
    }

    public function edit()
    {
    }

    public function userlist(Request $request)
    {
        $order = $request->get('order', [[
            'column' => 0,
            'dir' => 'asc'
        ]])[0];

        $search = $request->get('search', ['value' => ''])['value'];

        $columnNames = [
            'users.id', 'users.name', 'user_groups.name', 'email'
        ];

        $columnNamesWithAliases = [
            'users.id', 'users.name as name', 'user_groups.name as group', 'email'
        ];

        $query = DB::table('users')
            ->select($columnNamesWithAliases)
            ->join('user_groups', 'users.group_id', '=', 'user_groups.id');

        if ($search) {
            $query->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('users.email', 'like', "%$search%")
                ->orWhere('user_groups.name', 'like', "%$search%", 'or');
        }

        $count = User::count();
        $countFiltered = DB::select("SELECT count(0) as count from ({$query->toRawSql()}) as sub")['0']->count;

        $query->orderBy($columnNames[$order['column']], $order['dir'])
            ->limit($request->get('length', 10))
            ->offset($request->get('start', 0));

        $data = $query->get();

        $result = [
            'data' => $data,
            "recordsTotal" => $count,
            "recordsFiltered" => $countFiltered,
        ];

        return response()->json($result, 200);
    }
}
