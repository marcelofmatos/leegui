<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stack;

class Environment extends Model
{
    protected $fillable = [
        'stack_id',
        'name',
        'value',
        'description',
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function stack() {
        return $this->belongsTo(Stack::class);
    }

}
