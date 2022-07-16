<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_histori extends Model
{
    protected $table = 'task_historis';
    protected $primaryKey = 'id_history';
    //each category might have one parent
    public function parent() {
        return $this->belongsToOne(static::class, 'parent', 'id_task');
    }

    //each category might have multiple children
    public function children() {
        return $this->hasMany(static::class, 'parent', 'id_task')->orderBy('sortorder', 'asc');
    }
}
