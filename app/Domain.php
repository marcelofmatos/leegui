<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PortainerServer;
use App\Template;

class Domain extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'portainer_server_id', 
        'template_id'
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $with = ['template', 'portainer_server'];

    public function portainer_server() {
        return $this->belongsTo(PortainerServer::class);
    }

    public function template() {
        return $this->belongsTo(Template::class);
    }

    public function scopeWithAll($query) 
    {
        $query->with('portainer_server', 'template');
    }

    function __toString()
    {
        return $this->name;
    }

    public function getDeepNameAttribute($value)
    {
        return "{$this->name} - {$this->template->name} - {$this->portainer_server->name}";
    }
}
