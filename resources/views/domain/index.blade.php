@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
              <h2>Cloud Domains</h2>
          </div>

          <div class="card-body">

            <div class="text-right">
              registros: {{ $list->total() }}
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Manager</th>
                  <th>Data de criação</th>
                  <th>Última atualização</th>
                  <th with="140px" class="text-center">
                    <a href="{{route('domain.create')}}" class="btn btn-success btn-sm" title="Adicionar novo manager">
                      <i class="fa fa-plus"></i>
                    </a>
                  </th>
                </tr>
                <?php $no=1; ?>
                @foreach ($list as $key => $value)
                  <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->portainer_server->name }}</td>
                    <td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $value->updated_at->format('d/m/Y H:i:s') }}</td>
                    <td class="text-nowrap text-center">
                      <a class="btn btn-info btn-sm" href="{{route('domain.show',$value->id)}}" title="Show info">
                          <i class="fa fa-info"></i>
                      </a>
                      <a class="btn btn-info btn-sm" href="domain/{{$value->id}}/edit" title="Edit">
                        <i class="fa fa-edit"></i>
                      </a>
                      <form method="POST" action="/domain/{{ $value->id }}" style='display:inline'>
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" style="display: inline;" class="btn btn-danger btn-sm" onclick="return '{{ $value->name }}' == prompt('Esta ação apaga o servidor. Confirme o nome do servidor a ser apagado:')" title="Apagar servidor">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
            <div class="text-center">
              {{ $list->render() }}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection