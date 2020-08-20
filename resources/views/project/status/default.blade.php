@extends('layouts.app')
@section('content')
<div class="page-status">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>Projeto {{ $object['Name'] }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm text-center col-status">
                                <h1>{{ $template->name }}</h1>
                                <h2>🌐</h2>
                                <div>
                                    Endereço: <a style="color: #00a5d6" target="_blank" href="https://{{ $object['Env'][0]['value'] }}">https://{{ $object['Env'][0]['value'] }}</a>
                                </div>
                                <div>Status: </div>
                                <progress style="margin: 0px auto" id="progressBar" max="100"></progress>
                                <div id="progressTxt">Verificando a instalação. Aguarde...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var xmlhttp = new XMLHttpRequest();
    var progress = 0;
    var url = "{{ $object['Env'][0]['value'] }}";

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            response = JSON.parse(this.responseText).status;
            progressTxt = document.getElementById("progressTxt");
            progressTxt.innerHTML = 'Disponível';
            progressBar = document.getElementById("progressBar");
            progressBar.value = progress = response;
        }
    };

    progressCheck = setInterval(function() {
        xmlhttp.open("GET", `https://${url}/`, true);
        xmlhttp.send();
    }, 3000)
</script>
@endsection
