@extends('layouts.app')
@section('content')
  <div class="row">
  <div class="col-sm-12">
    <div class="full-right">
      <h2>Stacks</h2>
    </div>
  </div>
  </div>

  <div class="text-right">
    registros: {{ $stacks->total() }}
  </div>
  <table class="table table-bordered table-striped table-hover">
    <tr>
      <th>Nome</th>
      <th>Servidor</th>
      <th>Data de criação</th>
      <th>Última atualização</th>
      <th with="140px" class="text-center">
        <a href="{{route('stack.create')}}" class="btn btn-success btn-sm">
          <i class="fa fa-plus"></i>
        </a>
      </th>
    </tr>
    <?php $no=1; ?>
    @foreach ($stacks as $key => $value)
      <tr>
        <td>{{ $value->name }}</td>
        <td>{{ $value->portainer_server->name }}</td>
        <td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
        <td>{{ $value->updated_at->format('d/m/Y H:i:s') }}</td>
        <td class="text-nowrap">
          <a class="btn btn-info btn-sm" href="{{route('stack.show',$value->id)}}">
              <i class="fa fa-th-large"></i>
          </a>
          <a class="btn btn-info btn-sm" target="_blank" href="{{ $value->portainer_server->url }}/#/stacks/balanceador?id={{ $value->stack_id }}" title="Abrir stack no Portainer">
              <i class="fa fa-config"></i>
          </a>
        </td>
      </tr>
    @endforeach
  </table>
  <div class="text-center">
    {{ $stacks->render() }}
  </div>
@endsection