<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookmark\DeleteRequest;
use App\Http\Requests\Bookmark\StoreRequest;
use App\Http\Requests\Bookmark\UpdateRequest;
use App\Models\Bookmark;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public $from = 'bookmarks';

    public function index()
    {
        $bookmarks = Auth::user()->bookmarks()->where('folder_id', null)->get();
        $folders = Auth::user()->folders()->where('type', 2)->get();
        $from = $this->from;

        return view('pages.bookmark.index', compact('folders', 'bookmarks', 'from'));
    }

    public function create()
    {
        $folders = Auth::user()->folders()->where('type', 2)->get();
        $from = $this->from;

        return view('pages.bookmark.create', compact('folders', 'from'));
    }

    public function store(StoreRequest $request)
    {
        $inputs = [...$request->all(), 'user_id' => Auth::id()];
        if ($inputs['folder_id'] == 0) {
            $inputs['folder_id'] = null;
        } else {
            Folder::find($inputs['folder_id'])->increment('include');
        }
        Bookmark::create($inputs);
        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Bookmark Created Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Bookmark Created Successfully');
        }

        $bookmarks = Auth::user()->bookmarks;
        $folders = Auth::user()->folders()->where('type', 2)->get();
        $from = $this->from;

        return redirect()->to(route('bookmark.index'))->with(compact('folders', 'bookmarks', 'from'));
    }

    public function show(Bookmark $bookmark)
    {
        $from = $this->from;
        $folders = Auth::user()->folders()->where('type', 2)->get();

        return view('pages.bookmark.bookmark', compact('bookmark', 'from', 'folders'));
    }

    public function update(Bookmark $bookmark, UpdateRequest $request)
    {
        $inputs = $request->all();

        if ($inputs['folder_id'] != $bookmark->folder_id) {
            $bookmark->folder()->decrement('include');
            if ($inputs['folder_id'] == 0) {
                $inputs['folder_id'] = null;
            } else {
                Folder::find($inputs['folder_id'])->increment('include');
            }
        }

        $bookmark->update($inputs);

        if ($inputs['dark'] == 'true') {
            alert()->success('', 'Bookmark Updated Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Bookmark Updated Successfully');
        }

        return redirect()->to(route('bookmark.show', $bookmark->id));
    }

    public function delete(Bookmark $bookmark, DeleteRequest $request)
    {
        $bookmark->folder()->decrement('include');
        $bookmark->delete();

        if ($request->all()['dark'] == 'true') {
            alert()->success('', 'Bookmark Deleted Successfully')->background('#1A1C23');
        } else {
            alert()->success('', 'Bookmark Deleted Successfully');
        }

        return response()->json(['status' => 'ok', 'message' => 'Bookmark Deleted Successfully']);
    }
}
