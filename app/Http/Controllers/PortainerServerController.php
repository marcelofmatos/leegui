<?php

namespace App\Http\Controllers;

use App\PortainerServer;
use Illuminate\Http\Request;
use \Exception;

class PortainerServerController extends Controller
{

    function __construct(Request $request) {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = PortainerServer::paginate(15);

        return view('portainer_server.index',[
            'list' => $list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portainerServer = new PortainerServer();
        return view('portainer_server.create', [
            'object' => $portainerServer,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request);

        $portainerServer = new PortainerServer($request->all());
        $portainerServer->slug_name = \Str::slug($portainerServer->name,'-');
        $portainerServer->save();
        return redirect("/portainer_server");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PortainerServer  $portainerServer
     * @return \Illuminate\Http\Response
     */
    public function show(PortainerServer $portainerServer)
    {

        return view('portainer_server.show',[
            'object' => $portainerServer,
        ]);

    }

    public function stacks($id)
    {

        $portainerServer = PortainerServer::findOrFail($id);

        $portainerServer->loadFromAPI();

        return view('portainer_server.stacks',[
            'list' => $portainerServer->stacks,
            'object' => $portainerServer,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PortainerServer  $portainerServer
     * @return \Illuminate\Http\Response
     */
    public function edit(PortainerServer $portainerServer)
    {
        return view('portainer_server.edit',[
            'object' => $portainerServer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PortainerServer  $portainerServer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortainerServer $portainerServer)
    {
        $this->validate($request);

        $portainerServer->fill($request->except('auth_password'));
        $portainerServer->slug_name = \Str::slug($portainerServer->name,'-');
        if($request->auth_password) {
            $portainerServer->auth_password = $request->auth_password;
        }
        $portainerServer->save();
        return redirect("/portainer_server");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PortainerServer  $portainerServer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortainerServer $portainerServer)
    {
        $portainerServer->delete();
        return redirect("/portainer_server");
    }

    public function stackDelete($id,$stack_id)
    {
        $portainerServer = PortainerServer::findOrFail($id);

        $portainerServer->loadFromAPI();

        try {
            $portainerServer->stacksApi->delete($stack_id);  
        } catch (Exception $e) {
        }

        return redirect("/portainer_server/$id/stacks");
    }

    public function validate($request, $rules=[], $messages=[], $customAttributes=[]) {

        if (!$rules) {
            $rules =  [
                'name' => 'required',
                'url' => 'required|url',
                'monitor_url' => 'sometimes|url',
                'logs_url' => 'sometimes|url',
                'swarm_id' => 'required',
                'auth_user' => 'required',
                'auth_password' => 'required',
            ];
        }

        if(!$messages) {
            $messages = [
                'name.required' => 'O campo nome é obrigatório',
                'url.required' => 'O campo Portainer URL é obrigatório',
                'auth_user.required' => 'O campo portainer usuário é obrigatório',
                'auth_password.required' => 'O campo portainer senha é obrigatório',
            ];
        }

        return parent::validate($request, $rules, $messages, $customAttributes);

    }

}
