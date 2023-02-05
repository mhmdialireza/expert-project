<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'description', 'user_id', 'folder_id'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
