<?php

use Illuminate\Database\Seeder;
use App\PortainerServer;
use App\Stack;

class PortainerServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portainerServer = PortainerServer::create([
            'id' => 1,
            'name' => 'Portainer Server Example',
            'slug_name' => 'portainer-server-example',
            'url' => 'https://portainer.example.com',
            'monitor_url' => 'https://monitor.example.com',
            'logs_url' => 'https://logs.example.com',
            'auth_user' => 'api',
            'auth_password' => '123456',
            'swarm_id' => 'j3j4894h4209hjnsmsfsfsdf',
        ]);


    }
}
