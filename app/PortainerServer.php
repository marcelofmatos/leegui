<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stack;
use App\Domain;

class PortainerServer extends Model
{
    protected $fillable = ['name','description','url','monitor_url','logs_url','swarm_id','auth_user','auth_password'];
    protected $guarded = ['id', 'created_at', 'update_at'];

    var $endpointsApi;
    var $endpoints;
    var $stacksApi;
    var $stacks;
    var $portainer;

    public function loadFromAPI() {

        $this->portainer = new \Mangati\Portainer\Client($this->url);
        $this->portainer->auth($this->auth_user, $this->auth_password);

        $this->endpointsApi = $this->portainer->endpoints();
        $this->endpoints = $this->endpointsApi->getAll();

        $this->stacksApi = $this->portainer->stacks($this->endpoints[0]['Id']);
        $this->stacks = $this->stacksApi->getAll();
    }

    public function domains() {
        return $this->hasMany(Domain::class);
    }

}
