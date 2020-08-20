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
    <label for="description" class="col-lg-3 col-md-3 col-sm-3 control-label">Descrição</label>
    <div class="col-lg-6 col-md-6 col-sm-6">
    {{ Form::text('description', null, ['class' => 'col-lg-12 col-md-12 col-sm-12']) }}
    </div>
</div>
<fieldset>
    <legend>Repository info</legend>
    <div class="row form-group">
        <label for="repository_url" class="col-lg-3 col-md-3 col-sm-3 control-label">Repository URL</label>
        <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::text('repository_url', null, ['class' => 'col-lg-12 col-md-12 col-sm-12']) }}
        </div>
    </div>
    <div class="row form-group">
        <label for="repository_reference_name" class="col-lg-3 col-md-3 col-sm-3 control-label">Reference Name</label>
        <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::text('repository_reference_name', null, ['class' => 'col-lg-6 col-md-6 col-sm-6']) }}
        </div>
    </div>
    <div class="row form-group">
        <label for="compose_file" class="col-lg-3 col-md-3 col-sm-3 control-label">Compose file</label>
        <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::text('compose_file', null, ['class' => 'col-lg-9 col-md-9 col-sm-9']) }}
        </div>
    </div>
    <div class="row form-group">
        <label for="repository_authentication" class="col-lg-3 col-md-3 col-sm-3 control-label">Need authentication?</label>
        <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::checkbox('repository_authentication') }}
        </div>
    </div>
    <div class="row form-group">
        <label for="repository_reference_name" class="col-lg-3 col-md-3 col-sm-3 control-label">User Name</label>
        <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::text('repository_username', null, ['class' => 'col-lg-6 col-md-6 col-sm-6']) }}
        </div>
    </div>
    <div class="row form-group">
        <label for="repository_reference_name" class="col-lg-3 col-md-3 col-sm-3 control-label">Password</label>
        <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::password('repository_password', null, ['class' => 'col-lg-6 col-md-6 col-sm-6']) }}
        </div>
    </div>
</fieldset>
<div class="row form-group">
    <div class="col-lg-2 col-md-2 col-sm-2 offset-md-3 offset-sm-3 offset-md-3">
        <button type="submit" class="btn btn-primary btn-save btn-block" onclick="this.classList.add('btn-working')">Salvar</button>
    </div>
</div>