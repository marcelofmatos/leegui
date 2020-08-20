@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Novo Template </h2>
                </div>

                <div class="card-body">

                    {{ Form::open(array('url' => route('template.store'), 'method' => 'POST')) }}

                    @include('template.form')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection