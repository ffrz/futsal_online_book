<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Termwind\render;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function add()
    {
        return $this->_renderUserEditor();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $this->_renderUserEditor($user);
    }

    public function save(Request $request)
    {
        $id = (int)$request->id;
        $data = $request->all();
        $rules = [
            'email' => 'required|email|unique:users,email,' . $id . '|max:100',
            'name' => 'required'
        ];
        $messages = [
            'email.required' => 'Alamat email harus diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'email.max' => 'Alamat email terlalu panjang.',
            'email.unique' => 'Alamat email sudah digunakan.',
            'name.required' => 'Nama harus diisi.',
        ];

        if (!$id || ($id && !empty($data['password']))) {
            $rules['password'] = 'required|min:5';
            $messages['password.required'] = 'Kata sandi harus diisi.';
            $messages['password.min'] = 'Kata sandi minimal 5 karakter.';
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($id) {
            $user = User::findOrFail($id);
            $user->update($data);
            $message = 'Data pengguna telah diperbarui.';
        }
        else {
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $message = 'Data pengguna telah dibuat.';
        }

        return redirect(route('admin.users.index'))
            ->with('flash-message', ['info', $message, 'Sukses']);
    }

    private function _renderUserEditor($data = [])
    {
        $userGroups = UserGroup::where('id', '>', '1')->orderBy('id', 'desc')->get();
        return view('admin.users.editor', compact('data', 'userGroups'));
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
