<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\DeleteRequest;
use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Models\Folder;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public $from = 'todos';

    public function index()
    {
        $todos = Auth::user()->todos()->where('folder_id', null)->get();
        $folders = Auth::user()->folders()
            ->where('parent_id', null)
            ->where('type', 1)
            ->get();
        $from = $this->from;

        return view('pages.todo.index', compact('folders', 'todos', 'from'));
    }

    public function create()
    {
        $folders = Auth::user()->folders()->where('type', 1)->get();
        $from = $this->from;

        return view('pages.todo.create', compact('folders', 'from'));
    }

    public function store(StoreRequest $request)
    {
        $inputs = [...$request->all(), 'user_id' => Auth::id()];
        if ($inputs['folder_id'] == 0) {
            $inputs['folder_id'] = null;
        } else {
            Folder::find($inputs['folder_id'])->increment('include');
        }
        Todo::create($inputs);
        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Todo Created Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Todo Created Successfully');
        }

        $todos = Auth::user()->todos;
        $folders = Auth::user()->folders()->where('type', 1)->get();
        $from = $this->from;

        return redirect()->to(route('todo.index'))->with(compact('folders', 'todos', 'from'));
    }

    public function show(Todo $todo)
    {
        $from = $this->from;
        $folders = Auth::user()->folders()->where('type', 1)->get();

        return view('pages.todo.todo', compact('todo', 'from', 'folders'));
    }

    public function update(Todo $todo, UpdateRequest $request)
    {
        $inputs = $request->all();

        if ($inputs['is_reminder_active'] ?? false) {
            if ($inputs['reminder_datetime'] != null) {
                $inputs['reminder_datetime'] = Carbon::createFromDate($inputs['reminder_datetime'])->format('Y-m-d H:i');
            }
        } else {
            $inputs['reminder_datetime'] = null;
        }

        if ($inputs['folder_id'] != $todo->folder_id) {
            $todo->folder()->decrement('include');
            if ($inputs['folder_id'] == 0) {
                $inputs['folder_id'] = null;
            } else {
                Folder::find($inputs['folder_id'])->increment('include');
            }
        }

        $todo->update($inputs);

        if ($inputs['dark'] == 'true') {
            alert()->success('', 'Todo Updated Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Todo Updated Successfully');
        }

        return redirect()->to(route('todo.show', $todo->id));
    }

    public function delete(Todo $todo, DeleteRequest $request)
    {
        $todo->folder()->decrement('include');
        $todo->delete();

        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Todo Deleted Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Todo Deleted Successfully');
        }

        return response()->json(['status' => 'ok', 'message' => 'Todo Deleted Successfully']);
    }

    public function changeStatus(Todo $todo)
    {
        $todo->is_done = 1 - (int)$todo->is_done;
        $todo->save();

        return back();
    }
}
