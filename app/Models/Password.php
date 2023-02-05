<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'password', 'user_id', 'folder_id'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
