@extends('app')

@section('titulo')
    Contas
@stop

@section('conteudo')

<div class='row container'>
    <div class='col-3'>
        <h1>Contas</h1>

    </div>
</div>
</br>
<form action="{{route('pesquisarconta')}}">
<div class="input-group m-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">Razão Social</span>
    </div>
    <input type="text" class="form-control" name="razao_social">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">CNPJ</span>
    </div>
    <input type="text" class="form-control" name="cnpj">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">UF</span>
    </div>
    <input type="text" class="form-control" name="uf">
</div>
    <input class="btn btn-info m-3" type="submit" value="Pesquisar">
    <a class="btn btn-success" href="./novaconta" role="button">Nova Conta</a>
    <a class="btn btn-outline-secondary m-3" href="./" role="button">Voltar</a>
</form>

<div class="col align-self-center">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Razão Social</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Cidade</th>
            <th scope="col">UF</th>
            <th scope="col">Editar</th>
            <th scope="col">Acessar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $contador=count($lista_dados);

        for ($i=0; $i<$contador; $i++){


            ?>


        <tr>
            <th scope="row">{{$i+1}}</th>
            <td>{{$lista_dados[$i]->razao_social}}</td>
            <td>{{$lista_dados[$i]->cnpj}}</td>
            <td>{{$lista_dados[$i]->cidade}}</td>
            <td>{{$lista_dados[$i]->uf}}</td>
            <form class="col-md-auto .mt-7" action="/editaempresa">
                <input type="hidden" name="id_conta" value="{{$lista_dados[$i]->id_conta}}">
                <td><button class="btn btn-secondary" type="submit">✏</button></td>


            </form>
            <form class="col-md-auto .mt-7" action="/acessarempresa">
                <input type="hidden" name="id_conta" value="{{$lista_dados[$i]->id_conta}}">
                <td><button class="btn btn-secondary" type="submit">➡</button></td>

            </form>

        </tr>


        <?php
    }
    ?>



</div>
@stop
