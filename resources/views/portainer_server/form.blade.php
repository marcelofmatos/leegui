@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row form-group">
    <label for="name" class="col-lg-3 col-md-3 col-sm-3 control-label">Nome</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::text('name', null, ['class' => 'col-lg-9 col-md-9 col-sm-9']) }}
    </div>
</div>
<div class="row form-group">
    <label for="url" class="col-lg-3 col-md-3 col-sm-3 control-label">Portainer URL</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::text('url', null, ['class' => 'col-lg-12 col-md-12 col-sm-12']) }}
    </div>
</div>
<div class="row form-group">
    <label for="monitor_url" class="col-lg-3 col-md-3 col-sm-3 control-label">Monitor URL</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::text('monitor_url', null, ['class' => 'col-lg-12 col-md-12 col-sm-12']) }}
    </div>
</div>
<div class="row form-group">
    <label for="logs_url" class="col-lg-3 col-md-3 col-sm-3 control-label">Logs URL</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::text('logs_url', null, ['class' => 'col-lg-12 col-md-12 col-sm-12']) }}
    </div>
</div>
<div class="row form-group">
    <label for="swarm_id" class="col-lg-3 col-md-3 col-sm-3 control-label">Swarm ID</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::text('swarm_id', null, ['class' => 'col-lg-9 col-md-9 col-sm-9']) }}
    </div>
</div>
<div class="row form-group">
    <label for="auth_user" class="col-lg-3 col-md-3 col-sm-3 control-label">Portainer Usuário</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::text('auth_user') }}
    </div>
</div>
<div class="row form-group">
    <label for="auth_password" class="col-lg-3 col-md-3 col-sm-3 control-label">Portainer Senha</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::password('auth_password') }}
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-2 col-md-2 col-sm-2 offset-md-3 offset-sm-3 offset-md-3">
        <button type="submit" class="btn btn-primary btn-save btn-block" onclick="this.classList.add('btn-working')">Salvar</button>
    </div>
</div>