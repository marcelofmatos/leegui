@extends('layouts.app')
@section('content')
<div class="page-create">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>Criar novo projeto</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/saas/next">
                            @csrf
                            <div class="form-group">
                                @error('project_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group">
                                    <input onkeypress="this.style.width = ((this.value.length + 1) * 7.5) + 'px';" style="border: 1px solid gray; height: 40px; min-width: 200px; padding: 0px 5px" type="text" class="text-left" name="project_name">
                                    <div class="input-group-prepend">
                                        <select name="domain_id" class="form-control input-group-text select-domains">
                                            <option>option1</option>
                                            <option>option2</option>
                                            <option>option3</option>
                                            <option>option4</option>
                                            <option>option5</option>
                                            <option>option6</option>
                                        </select>

                                    </div>
                                    <button style="margin-left: auto" type="submit" class="btn btn-info">Criar</button>
                                </div>
                        </form>
                    </div>
                    <!--
            <div class="card">
                <div class="card-header"><h2>Criar novo projeto</h2></div>
                <div class="card-body">
                    <form method="post" action="/saas/next">
                    @csrf
                        <div class="form-group">
                        @error('project_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="input-group">
                            <input type="text" class="text-center" name="project_name">
                            <div class="input-group-prepend">
                                {!! Form::select(
                                    'domain_id',
                                    $domains,
                                    2,
                                    ['class' => 'form-control input-group-text select-domains']) !!}
                            </div>
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </div>
                        <div class="form-group">

                        </div>
                    </form>
                </div>
                -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
