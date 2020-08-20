<?php

use Illuminate\Database\Seeder;
use App\PortainerServer;
use App\Stack;
use App\Domain;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Domain::create([
            'id' => 1,
            'name' => 'example.com',
            'description' => 'Example Domain',
            'portainer_server_id' => 1,
            'template_id' => 1,
        ]);
    }
}
