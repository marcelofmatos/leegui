<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PortainerServer;
use App\Domain;

class Template extends Model
{
    protected $fillable = [
        'name',
        'description',
        'repository_url',
        'repository_reference_name',
        'repository_authentication',
        'repository_username',
        'repository_password',
        'compose_file',
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function domains() {
        return $this->hasMany(Domain::class);
    }
}
