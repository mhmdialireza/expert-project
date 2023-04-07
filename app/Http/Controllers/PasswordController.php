<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password\DeleteRequest;
use App\Http\Requests\Password\StoreRequest;
use App\Http\Requests\Password\UpdateRequest;
use App\Models\Folder;
use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public $from = 'passwords';

    public function index()
    {
        $passwords = Auth::user()->passwords()->where('folder_id', null)->get();
        $folders = Auth::user()->folders()
        ->where('parent_id', null)
        ->where('type', 3)
        ->get();
        $from = $this->from;

        return view('pages.password.index', compact('folders', 'passwords', 'from'));
    }

    public function create()
    {
        $folders = Auth::user()->folders()->where('type', 3)->get();
        $from = $this->from;

        return view('pages.password.create', compact('folders', 'from'));
    }

    public function store(StoreRequest $request)
    {
        $inputs = [...$request->all(), 'user_id' => Auth::id()];
        if ($inputs['folder_id'] == 0) {
            $inputs['folder_id'] = null;
        } else {
            Folder::find($inputs['folder_id'])->increment('include');
        }
        Password::create($inputs);
        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Password Created Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Password Created Successfully');
        }

        $passwords = Auth::user()->passwords;
        $folders = Auth::user()->folders()->where('type', 3)->get();
        $from = $this->from;

        return redirect()->to(route('password.index'))->with(compact('folders', 'passwords', 'from'));
    }

    public function show(Password $password)
    {
        $from = $this->from;
        $folders = Auth::user()->folders()->where('type', 3)->get();

        return view('pages.password.password', compact('password', 'from', 'folders'));
    }

    public function update(UpdateRequest $request, Password $password)
    {
        $inputs = $request->all();

        if ($inputs['folder_id'] != $password->folder_id) {
            $password->folder()->decrement('include');
            if ($inputs['folder_id'] == 0) {
                $inputs['folder_id'] = null;
            } else {
                Folder::find($inputs['folder_id'])->increment('include');
            }
        }

        $password->update($inputs);

        if ($inputs['dark'] == 'true') {
            alert()->success('', 'Password info Updated Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Password info Updated Successfully');
        }

        return redirect()->to(route('password.show', $password->id));
    }

    public function delete(Password $password, DeleteRequest $request)
    {
        $password->folder()->decrement('include');
        $password->delete();

        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Password Deleted Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Password Deleted Successfully');
        }

        return response()->json(['status' => 'ok', 'message' => 'Password Deleted Successfully']);
    }

    public function getPassword(Request $request)
    {
        $password = Password::find($request->id);

        return response()->json(['password' => $password->password]);
    }
}
