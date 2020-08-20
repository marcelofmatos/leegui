<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Template;
use App\PortainerServer;
use Illuminate\Http\Request;

class DomainController extends Controller
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
        $list = Domain::paginate(15);

        return view('domain.index',[
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
        $domain = new domain();
        $portainer_servers = PortainerServer::pluck('name', 'id');
        $templates = Template::pluck('name', 'id');
        return view('domain.create', [
            'object' => $domain,
            'portainer_servers' => $portainer_servers,
            'templates' => $templates,
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

        $domain = new Domain($request->all());
        $domain->save();
        return redirect("/domain");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        return view('domain.show',[
            'object' => $domain,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        $portainer_servers = PortainerServer::pluck('name', 'id');
        $templates = Template::pluck('name', 'id');
        return view('domain.edit',[
            'object' => $domain,
            'portainer_servers' => $portainer_servers,
            'templates' => $templates,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        $this->validate($request);

        $domain->fill($request->all());
        $domain->save();
        return redirect("/domain");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect("/domain");
    }

    public function validate($request, $rules=[], $messages=[], $customAttributes=[]) {

        if (!$rules) {
            $rules = [
                'name' => 'required|regex:/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/',
                'description' => 'required',
                'template_id' => 'required',
                'portainer_server_id' => 'required',
            ];
        }

        if(!$messages) {
            $messages = [
                'name.required' => 'O campo domínio é obrigatório',
                'name.regex' => 'O formato do domínio é inválido',
                'description.required' => 'O campo descrição é obrigatório',
                'portainer_server_id.required' => 'Selecione um servidor manager para associar ao domínio',
                'template_id.required' => 'Selecione um template para associar ao domínio',
            ];
        }

        return parent::validate($request, $rules, $messages, $customAttributes);

    }
}
