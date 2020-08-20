@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Atualizar Template </h2>
                </div>

                <div class="card-body">

                    {{ Form::open(array('url' => route('template.update', $object->id ), 'method' => 'PUT')) }}

                    {{ Form::model($object, array('route' => array('template.update', $object->id))) }}

                    @include('template.form')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection