@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      {{ Form::model($stack,['route'=>['stack.update',$stack->id],'method'=>'PATCH']) }}
      @include('stack.form')
      {{ Form::close() }}
    </div>
  </div>
@endsection