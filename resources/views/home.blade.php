@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="/saas/create">Projeto</a></li>
                        <li><a href="/domain">Domínio</a></li>
                        <li><a href="/template">Template</a></li>
                        <li><a href="/portainer_server">Servidor portainer</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
