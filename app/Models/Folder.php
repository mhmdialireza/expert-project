<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'include', 'type', 'user_id', 'parent_id', 'is_done'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function passwords()
    {
        return $this->hasMany(Password::class);
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class,'parent_id');
    }
}
