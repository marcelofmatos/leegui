@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Domínio {{ $object->name }} </h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            Data de criação: <br/>
                            {{ $object->created_at }}
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            Data de atualização: <br/>
                            {{ $object->updated_at }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group text-dark">
                                <strong>Info : </strong>
                                @foreach($object->toArray() as $key=>$attr)
                                @if(preg_match('/password/',$key))
                                    <pre>{{ $key }}: ******</pre>
                                @else
                                    <pre>{{ $key }}: {{ $attr }}</pre>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection