<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PortainerServer;
use App\Environment;

class Stack extends Model
{
    protected $fillable = [
        'name',
        'description',
        'env',
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function portainer_server() {
        return $this->belongsTo(PortainerServer::class);
    }

    public function environment() {
        return $this->hasMany(Environment::class);
    }
}
