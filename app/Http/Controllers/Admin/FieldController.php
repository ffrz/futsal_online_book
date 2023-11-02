<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FieldController extends Controller
{
    //
    public function index()
    {
        $fields = Field::all();
        return view('admin.fields.index', compact('fields'));
    }

    public function add()
    {
        return view('admin.fields.editor');
    }

    public function edit($id)
    {
        $data = Field::findOrFail($id);
        return view('admin.fields.editor', compact('data'));
    }

    public function save(Request $request)
    {
        $id = (int)$request->id;
        $data = $request->only('id', 'name');

        $validator = Validator::make($data, [
            'name' => 'required|unique:fields,name,' . $id . '|max:100',
        ], [
            'name.required' => 'Nama lapangan harus diisi.',
            'name.max' => 'Nama lapangan terlalu panjang.',
            'name.unique' => 'Nama lapangan sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        DB::transaction(function () use ($id, $request, $data) {
            if (!$id) {
                $field = Field::create($data);
            } else {
                $field = Field::findOrFail($id);
                $field->update($data);
            }

            $coverFile = $request->file('cover');
            if ($field->cover && $coverFile) {
                Storage::delete('fields/' . $field->cover);
            }

            if ($coverFile) {
                $ext = $coverFile->getClientOriginalExtension();
                $newName = $field->id . '-' . now()->timestamp . '.' . $ext;
                $coverFile->storeAs('fields', $newName);
                $field->cover = $newName;
                $field->save();
            }
        });

        return redirect(route('admin.fields.index'))
            ->with('flash-message', ['info', 'Lapangan telah diperbarui', 'Sukses']);
    }

    public function delete($id)
    {
    }

    public function restore($id)
    {
    }
}
