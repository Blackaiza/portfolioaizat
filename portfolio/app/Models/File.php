<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['project_id', 'file_path', 'file_name'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
