@extends('app')

@section('titulo')
    Fluxo OP
@stop

@section('conteudo')

<div class='row container'>
    <div class='col-3'>
        <h1>Fluxo OP</h1>
    </div>
</div>
</br>
<form action="{{route('pesquisaetapa')}}">
    <div class="input-group m-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Nome</span>
        </div>
        <input type="text" class="form-control" name="nome">
    </div>
    <input class="btn btn-info m-3" type="submit" value="Pesquisar">
    <a class="btn btn-success" href="./novaetapa" role="button">Nova Etapa</a>
    <a class="btn btn-outline-secondary m-3" href="./" role="button">Voltar</a>
</form>


<div class="col align-self-center">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Ordem</th>
            <th scope="col">Qualquer Etapa pode Transitar</th>
            <th scope="col">Criado</th>
            <th scope="col">Atualizado</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $contador=count($lista_dados);

        for ($i=0; $i<$contador; $i++){


            ?>


        <tr>
            <th scope="row">{{$i+1}}</th>
            <td>{{$lista_dados[$i]->nome}}</td>
            <td>{{$lista_dados[$i]->ordem}}</td>
            <td>{{$lista_dados[$i]->qualquer_etapa}}</td>
                <?php date_default_timezone_set('America/Bahia') ?>
            <td>{{date("d/m/Y H:i:s",strtotime($lista_dados[$i]->created_at))}}</td>
            <td>{{date("d/m/Y H:i:s",strtotime($lista_dados[$i]->updated_at))}}</td>
            <form class="col-md-auto .mt-7" action="/editaetapa" method="post">
                @csrf
                <input type="hidden" name="id_fluxo_op" value="{{$lista_dados[$i]->id_fluxo_op}}">
                <td><button class="btn btn-secondary" type="submit">✏</button></td>
            </form>
            <form class="md-auto .mt-7" onclick="excluirregistro()" method="post">
                @csrf
                <input type="hidden" name="id_registro" value="{{$lista_dados[$i]->id_fluxo_op}}">
                <input type="hidden" name="tabela" value="fluxo_op">
                <td><button class="btn" role="button">❌ </button></td>
            </form>
        </tr>


        <?php
    }
    ?>



</div>
@stop
