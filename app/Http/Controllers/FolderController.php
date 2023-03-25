<?php

namespace App\Http\Controllers;

use App\Http\Requests\Folder\DeleteRequest;
use App\Http\Requests\Folder\StoreRequest;
use App\Http\Requests\Folder\UpdateRequest;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function create(int $type)
    {
        $from = match($type) {
            1 => 'todos',
            2 => 'bookmarks',
            3 => 'passwords',
        };
        $folders = Folder::where('type', $type)->get();

        return view('pages.folder.create', compact('type', 'from', 'folders'));
    }

    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        if ($inputs['parent_id'] == 0) {
            $inputs['parent_id'] = null;
        } else {
            Folder::find($inputs['parent_id'])->increment('include');
        }

        Folder::create([...$inputs, 'user_id' => Auth::id()]);

        $type = (int) $inputs['type'];
        $from = match($type) {
            1 => 'todos',
            2 => 'bookmarks',
            3 => 'passwords',
        };

        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Folder Created Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Folder Created Successfully');
        }

        if ($type == 1) {
            $todos = Auth::user()->todos;
            $folders = Auth::user()->folders()->where('type', 1)->get();
            return redirect()->to(route('todo.index'))->with(compact('folders', 'todos', 'from'));
        } else if ($type == 2) {
            $bookmarks = Auth::user()->bookmarks;
            $folders = Auth::user()->folders()->where('type', 2)->get();
            return redirect()->to(route('bookmark.index'))->with(compact('folders', 'bookmarks', 'from'));
        } else if ($type == 3) {
            $passwords = Auth::user()->passwords;
            $folders = Auth::user()->folders()->where('type', 3)->get();
            return redirect()->to(route('password.index'))->with(compact('folders', 'passwords', 'from'));
        }
    }

    public function show(Folder $folder)
    {
        $from = match($folder->type) {
            1 => 'todos',
            2 => 'bookmarks',
            3 => 'passwords',
        };

        $items = match($folder->type) {
            1 => $folder->todos,
            2 => $folder->bookmarks,
            3 => $folder->passwords,
        };

        $folders = $folder->children;

        return view('pages.folder.folder', compact('folder', 'items', 'from', 'folders'));
    }

    public function edit(Folder $folder)
    {
        $from = match($folder->type) {
            1 => 'todos',
            2 => 'bookmarks',
            3 => 'passwords',
        };
        $folders = Folder::where('type', $folder->type)
        ->where('id','!=',$folder->id)
        //TODO: even no children 
        ->get();

        return view('pages.folder.edit', compact('folder', 'from','folders'));
    }

    public function update(Folder $folder, UpdateRequest $request)
    {
        $folder->update($request->all());
        $from = match($folder->type) {
            1 => 'todos',
            2 => 'bookmarks',
            3 => 'passwords',
        };

        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Folder Updated Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Folder Updated Successfully');
        }

        return view('pages.folder.edit', compact('folder', 'from'));
    }

    public function delete(Folder $folder, DeleteRequest $request)
    {
        $parent = $folder->parent;
        if ($parent) {
            $parent->decrement('include');
        }

        $folder->delete();
        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Folder Deleted Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Folder Deleted Successfully');
        }

        return response()->json(['status' => 'ok', 'message' => 'Folder Successfully Deleted']);
    }
}
