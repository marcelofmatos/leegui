<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use \Exception;

class TemplateController extends Controller
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

        $list = Template::paginate(15);

        return view('template.index',[
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
        $Template = new Template();
        return view('template.create', [
            'object' => $Template,
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

        $Template = new Template($request->all());
        if(empty($request->repository_authentication)) {
            $Template->repository_authentication = 0;
        }
        $Template->save();
        return redirect("/template");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $Template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $Template)
    {

        return view('template.show',[
            'object' => $Template,
        ]);

    }

    public function stacks($id)
    {

        $Template = Template::findOrFail($id);

        $Template->loadFromAPI();

        return view('template.stacks',[
            'list' => $Template->stacks,
            'object' => $Template,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $Template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $Template)
    {
        return view('template.edit',[
            'object' => $Template,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $Template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $Template)
    {
        $this->validate($request);

        $Template->fill($request->except('repository_password'));
        if($request->repository_password) {
            $Template->repository_password = $request->repository_password;
        }
        if(empty($request->repository_authentication)) {
            $Template->repository_authentication = 0;
        }
        $Template->save();
        return redirect("/template");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $Template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $Template)
    {
        $Template->delete();
        return redirect("/template");
    }

    public function stackDelete($id,$stack_id)
    {
        $Template = Template::findOrFail($id);

        $Template->loadFromAPI();

        try {
            $Template->stacksApi->delete($stack_id);  
        } catch (Exception $e) {
        }

        return redirect("/template/$id/stacks");
    }

    public function validate($request, $rules=[], $messages=[], $customAttributes=[]) {

        if (!$rules) {
            $rules =  [
                'name' => 'required',
                'repository_url' => 'required|url',
                'repository_reference_name' => 'required',
                'compose_file' => 'required',
            ];
        }

        if(!$messages) {
            $messages = [
                'name.required' => 'O campo nome é obrigatório',
            ];
        }

        return parent::validate($request, $rules, $messages, $customAttributes);

    }

}
