<?php

use Illuminate\Database\Seeder;
use App\PortainerServer;
use App\Stack;
use App\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Template::create([
            'id' => 1,
            'name' => 'template-example-1',
            'description' => 'Template Example 1',
            'repository_url' => 'https://github.com/marcelofmatos/leegui',
            'repository_reference_name' => 'refs/heads/master',
            'repository_authentication' => 1,
            'repository_username' => '',
            'repository_password' => '',
            'compose_file' => '',
        ]);


    }
}
