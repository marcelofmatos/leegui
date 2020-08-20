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
                                <div class="row p-4">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="input-group col-md-8 offset-md-2 col-sm-12">
                                        <input placeholder="nome-do-projeto" title="Digite o nome do projeto a ser criado. Não pode conter espaços ou caracteres especiais" 
                                        onkeypress="this.style.width = ((this.value.length + 1) * 7.5) + 'px';"
                                        type="text" class="project-name text-left col-md-3" name="project_name"
                                        value="{{ old('project_name') }}" />
                                            {!! Form::select(
                                            'domain_id',
                                            $domains,
                                            old('domain_id', 2),
                                            ['class' => 'form-control input-group-text select-domains col-md-6']) !!}

                                            <button type="submit" style="margin: 0px 10px;"
                                                class="btn btn-info btn-save col-md-3"
                                                onclick="this.classList.add('btn-working')">
                                                Criar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
