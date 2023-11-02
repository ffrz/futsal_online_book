<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function edit($id)
    {
        $data = UserGroup::findOrFail($id);
        return view('admin.user-groups.editor', compact('data'));
    }

    public function save(Request $request)
    {
        $id = (int)$request->id;
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|unique:user_groups,name,' . $id . '|max:100',
        ], [
            'name.required' => 'Nama grup harus diisi.',
            'name.max' => 'Nama grup terlalu panjang.',
            'name.unique' => 'Nama grup sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $group = UserGroup::findOrFail($id);
        $group->update($data);

        return redirect(route('admin.user-groups.index'))
            ->with('flash-message', ['success', 'Grup telah diperbarui', 'Sukses']);
    }
}
