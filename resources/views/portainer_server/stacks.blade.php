@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
              <h2>{{ $object->name }} Stacks</h2>
          </div>
          <div class="card-body">
            <div class="text-right">
              registros: {{ count($list) }}
            </div>
            <table class="table table-bordered table-hover">
              <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th class="text-center">
                  <a href="{{route('stack.create')}}" class="btn btn-success btn-sm" title="Criar nova stack">
                    <i class="fa fa-plus"></i>
                  </a>
                </th>
              </tr>
              <?php $no=1; ?>
              @foreach ($list as $key => $value)
                <tr>
                  <td>{{ $value['Name'] }}</td>
                  <td>
                  @if(isset($value['Env'][0]) && $value['Env'][0]['name']=='WEBSERVER_FQDN')
                    <a target="_blank" href="https://{{ $value['Env'][0]['value'] }}">{{ $value['Env'][0]['value'] }}</a>
                  @endif
                  </td>
                  <td class="text-nowrap text-center">
                    <a class="btn btn-info btn-sm" target="_blank" href="{{ $object->url }}/#/stacks/{{ $value['Name'] }}?id={{ $value['Id'] }}" title="Abrir stack no Portainer">
                      <i class="fa fa-cog"></i>
                    </a>
                    <a class="btn btn-info btn-sm" target="_blank" href="/saas/status/{{ $object->id }}/{{ $value['Id'] }}" title="Verificar status">
                      <i class="fa fa-check"></i>
                    </a>
                    <form method="POST" action="/portainer_server/{{ $object->id }}/stack/{{ $value['Id'] }}/delete" style='display:inline'>
                      @csrf
                      <input name="_method" type="hidden" value="DELETE">
                      <button type="submit" style="display: inline;" class="btn btn-danger btn-sm" onclick="return '{{ $value['Name'] }}' == prompt('Apagar stack? Esta ação apaga os containers e não apaga os volumes. Confirme o nome da stack a ser apagada:')" title="Apagar stack">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection