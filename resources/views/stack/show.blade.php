@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Server {{ $stack->Matricula }} </h2>
        </div>
        <div class="pull-right">
            <br/>
            <a class="btn btn-primary" href="/stack/sync/{{ $stack->Matricula }}">
                <i class="glyphicon glyphicon-refresh"></i> Sincronizar
            </a>
            <a class="btn btn-primary" href="{{ route('stack.index') }}"> <i class="glyphicon glyphicon-list-alt"></i> Lista</a>
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3">
        Data de criação: <br/>
        {{ $stack->created_at }}
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        Data de atualização: <br/>
        {{ $stack->updated_at }}
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            @foreach($stack->toArray() as $key=>$attr)
            <pre class="alert">{{ $key }}: {{ $attr }}</pre>
            @endforeach
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Sybase : </strong>
            @foreach($stack->toArray() as $key=>$attr)
            <pre class="alert {{ $stack->sybase->$key == $stack->$key ? 'alert-success' : 'alert-warning' }}">{{ $key }}: {{ $stack->sybase->$key }}</pre>
            @endforeach
        </div>
    </div>
    <div>
    </div>
</div>
@endsection