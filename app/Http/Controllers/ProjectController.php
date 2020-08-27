<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PortainerServer;
use App\Domain;
use App\Template;
use App\Stack;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    var $server_id = 1;

    function __construct(Request $request) {
        $this->middleware('auth');
    }

    function create(request $request) {

        // pluck for select list
        $domains = Domain::orderBy('name')->get();

        return view('project.create',[
            'domains' => $domains->pluck('deep_name','id'),
        ]);

    }

    function next(request $request) {
        

        $domain = Domain::findOrFail($request->domain_id);

        $template = $domain->template;

        //$portainerServer = PortainerServer::findOrFail($this->server_id);
        $portainerServer = $domain->portainer_server;

        // FQDN size limit is 64 bytes (for SSL cert)
        $max_project_name = 63 - strlen($domain->name);
        
        $this->validate($request, [
            'project_name' => "required|regex:/^[a-z][-a-z0-9]+$/|max:$max_project_name",
            'domain_id' => 'required|integer',
        ],[
            'project_name.required' => 'Preencha o campo nome do projeto',
            'project_name.regex' => 'Formato inválido para o nome do projeto',
            'project_name.max' => "Endereço {$request->project_name}.{$domain->name} ficou muito grante. O nome do projeto deve ter no máximo $max_project_name caracteres para o domínio {$domain->name}",
        ]);


        // stack create

        $portainerServer->loadFromAPI();

        $stack = $portainerServer->stacksApi->add([
            "name" => $request->project_name,
            "SwarmID" => $portainerServer->swarm_id,
            "RepositoryAuthentication" => (bool) $template->repository_authentication,
            "RepositoryUsername" => $template->repository_username,
            "RepositoryPassword" => $template->repository_password,
            "RepositoryURL" => $template->repository_url,
            "RepositoryReferenceName" => $template->repository_reference_name,
            "ComposeFilePathInRepository" => $template->compose_file,
            "Env" => [
                    [
                        "name" => "WEBSERVER_FQDN",
                        "value" => $request->project_name . "." . $domain->name
                    ],[
                        "name" => "PROJECT_NAME",
                        "value" => $request->project_name
                    ]
            ]
        ],[
            'method' => 'repository',
            'type' => 1,
            'endpointId' => $portainerServer->getFirstEndpointId(), 
        ]);

        // save stack info
        //$stackDB = new Stack();



        return redirect("/saas/status/".$portainerServer->id."/".$stack['Id']."/".$template->id);
    }

    function status(request $request) {

        // stack create
        $portainerServer = PortainerServer::findOrFail($request->portainer_server_id);

        $portainerServer->loadFromAPI();

        $stack = $portainerServer->stacksApi->get($request->stack_id);

        $template = Template::find($request->template_id);

        $view_name = 'project.status.default';

        if(preg_match("/ligerosmart/i",$template->name)) {
            $view_name = 'project.status.ligerosmart';
        }

        if(preg_match("/otrs/i",$template->name)) {
            $view_name = 'project.status.otrs';
        }

        if(preg_match("/zabbix/i",$template->name)) {
            $view_name = 'project.status.zabbix';
        }

        return view($view_name,[
            'object' => $stack,
            'template' => $template
        ]);
    }

    function check(request $request) {

        // stack create
        $domain = $request->domain;
/*
        $ch = curl_init();

        // define options
        $optArray = array(
            CURLOPT_URL => 'http://'.$domain.'/progress.txt',
        );
        
        // apply those options
        @curl_setopt_array($ch, $optArray);
        
        // execute request and get response
        $result = @curl_exec($ch);
        */
        $result = trim(file_get_contents('http://'.$domain.'/progress.txt'));
        
        return response()->json(['status' => $result]);
    }

    function fqdnValidate(request $request) {

        @list($project_name, $domain_name) = explode('.', $request->fqdn, 2);

        $allowed_referers = [
            'painel.cloud.ligerosmart.com',
        ];

        if(!in_array($request->headers->get('referer'), $allowed_referers)) {
            return response()->json([
                'message' => 'Disallowed request'
            ], 400);
        }

        if(! filter_var($request->fqdn, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            return response()->json([
                'message' => 'Invalid fqdn'
            ], 400);
        }

        $domain = Domain::where('name', $domain_name)->first();

        if($domain instanceof Domain) {

            $domain->portainer_server->loadFromAPI();

            foreach($domain->portainer_server->stacks as $stack) {
                if($stack['Name'] == $project_name) {
                    return response()->json([
                        'project_name' => $project_name,
                        'exists' => true,
                        'message' => "already exists",
                    ], 400);
                }
            }

        } else {

            return response()->json([
                'message' => 'Invalid domain'
            ], 400);

        }

        return response()->json([
            'project_name' => $project_name,
            'exists' => false,
            'message' => 'available',
        ], 200);
    }
}
