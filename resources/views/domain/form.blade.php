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
    <label for="name" class="col-lg-3 col-md-3 col-sm-3 control-label">Domínio</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::text('name', null, ['class' => 'col-lg-9 col-md-9 col-sm-9']) }}
    </div>
</div>
<div class="row form-group">
    <label for="description" class="col-lg-3 col-md-3 col-sm-3 control-label">Descrição</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::text('description', null, ['class' => 'col-lg-12 col-md-12 col-sm-12']) }}
    </div>
</div>
<div class="row form-group">
    <label for="portainer_server_id" class="col-lg-3 col-md-3 col-sm-3 control-label">Manager</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::select('portainer_server_id', $portainer_servers, null, ['class' => 'col-lg-6 col-md-6 col-sm-6']) }}
    </div>
</div>
<div class="row form-group">
    <label for="template_id" class="col-lg-3 col-md-3 col-sm-3 control-label">Template</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::select('template_id', $templates, null, ['class' => 'col-lg-6 col-md-6 col-sm-6']) }}
    </div>
</div>
<div class="row form-group">
    <div class="col-lg-2 col-md-2 col-sm-2 offset-md-3 offset-sm-3 offset-md-3">
        <button type="submit" class="btn btn-primary btn-save btn-block" onclick="this.classList.add('btn-working')">Salvar</button>
    </div>
</div>