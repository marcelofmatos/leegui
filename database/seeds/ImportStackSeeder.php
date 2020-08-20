<?php

use Illuminate\Database\Seeder;
use App\PortainerServer;
use App\Stack;

class ImportStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $portainerServers = PortainerServer::all();

        foreach($portainerServers as $portainerServer) {

            $portainer = new \Mangati\Portainer\Client($portainerServer->url);
            $portainer->auth($portainerServer->auth_user, $portainerServer->auth_password);

            $endpointsApi = $portainer->endpoints();
            $endpoints    = $endpointsApi->getAll();

            $stacksApi = $portainer->stacks($endpoints[0]['Id']);
            $stacks    = $stacksApi->getAll();

            foreach($stacks as $stack) {
                Stack::updateOrCreate([
                    'name' => $stack['Name'],
                    'portainer_server_id' => $portainerServer->id,
                ],[
                    'name' => $stack['Name'],
                    'stack_id' => $stack['Id'],
                    'swarm_id' => $stack['SwarmId'],
                    'endpoint_id' => $stack['EndpointId'],
                    'portainer_server_id' => $portainerServer->id,
                ]);
            }

        }
        
    }
}
