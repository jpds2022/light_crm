@extends('app')

@section('titulo')
    OPs
@stop

@section('conteudo')

<div class='row container'>
    <div class='col-3'>
        <h1>OPs</h1>

    </div>
</div>
</br>
<form action="{{route('pesquisarop')}}">
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
        <span class="input-group-text" id="">OP</span>
    </div>
    <input type="text" class="form-control" name="op">
</div>
    <div class="input-group ml-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Nome OP</span>
        </div>
        <input type="text" class="form-control" name="nomeop">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Fase Oportunidade</span>
        </div>
        <select class="form-control" name="fase_oportunidade" id="">
            <option selected></option>
            <?php
            $contador=count($lista_status);

            if ($contador>1){
            for ($i=0; $i<$contador; $i++){
                ?>
            <option>{{$lista_status[$i]->nome}}</option>
            <?php   }
            }
            else{
                ?>
            <option>{{$lista_status[0]->nome}}</option>
                <?php
            }
            ?>
        </select>
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Produto</span>
        </div>
        <select class="form-control" name="produto" id="">
            <option selected></option>
            <?php
            $contador=count($lista_produtos);

            if ($contador>1){
            for ($i=0; $i<$contador; $i++){
                ?>
            <option>{{$lista_produtos[$i]->nome}}</option>
            <?php   }
            }
            else{
                ?>
            <option>{{$lista_produtos[0]->nome}}</option>
                <?php
            }
            ?>
        </select>
    </div>
    <input class="btn btn-info m-3" type="submit" value="Pesquisar">
    <a class="btn btn-outline-secondary m-3" href="./" role="button">Voltar</a>
</form>

<div class="col align-self-center">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">OP</th>
            <th scope="col">Razão Social</th>
            <th scope="col">Fase Oportunidade</th>
            <th scope="col">Produto</th>
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
            <td>{{$lista_dados[$i]->nomeop}}</td>
            <td>{{$lista_dados[$i]->proposta}}</td>
            <td>{{$lista_dados[$i]->razao_social}}</td>
            <td>{{$lista_dados[$i]->nome_fase_oportunidade}}</td>
            <td>{{$lista_dados[$i]->nomeproduto}}</td>
            <form class="col-md-auto .mt-7" method="post" action="/editaop">
                @csrf
                <input type="hidden" name="id_op" value="{{$lista_dados[$i]->id_op}}">
                <input type="hidden" name="acao" value="editar">
                <td><button class="btn btn-secondary" type="submit">✏</button></td>


            </form>
            <form class="col-md-auto .mt-7" method="post" action="/acessarop">
                @csrf
                <input type="hidden" name="id_op" value="{{$lista_dados[$i]->id_op}}">
                <input type="hidden" name="acao" value="acessar">
                <td><button class="btn btn-secondary" type="submit">➡</button></td>

            </form>

        </tr>


        <?php
    }
    ?>



</div>
@stop
