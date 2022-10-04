@extends('app')

@section('titulo')
Atividades
@stop

@section('conteudo')

<div class='row container'>
    <div class='col-3'>
        <h1>Atividades</h1>
    </div>
</div>
</br>
<form action="{{route('pesquisaatividade')}}">
    <div class="input-group m-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Status</span>
        </div>
        <select class="form-control" name="status">
            <option selected></option>
            <option>Iniciada</option>
            <option>Finalizada</option>
        </select>
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Número OP</span>
        </div>
        <input type="number" class="form-control" name="n_op">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Responsável</span>
        </div>
        <select name="responsavel">
            <option selected></option>
            <?php
            $contador=count($lista_funcionario);
            for ($i=0; $i<$contador; $i++){
                ?>
            <option>{{$lista_funcionario[$i]->nome}}</option>
            <?php

            }
            ?>
        </select>
    </div>
    <div class="input-group m-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">Nome</span>
        <input type="text" class="form-control" name="nome">
    </div>
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
            <th scope="col">Status</th>
            <th scope="col">Responsável</th>
            <th scope="col">OP</th>
            <th scope="col">Criado</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
        </thead>
        <?php
        $contador=count($lista_atividades);
        for ($i=0; $i<$contador; $i++){
            ?>
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$lista_atividades[$i]->nome_atividade}}</td>
            <td>{{$lista_atividades[$i]->status}}</td>
            <td>{{$lista_atividades[$i]->responsavel}}</td>
            <form action="{{route('acessarop')}}" method="post">
                @csrf
                <input type="hidden" name="id_op" value="{{$lista_atividades[$i]->id_op_atividade}}">
                <input type="hidden" name="acao" value="acessar">
                <td><button class="btn">{{$lista_atividades[$i]->proposta}} - {{$lista_atividades[$i]->nome_op}}</button></td>
            </form>
            <td>{{ date("d/m/Y H:i:s",strtotime($lista_atividades[$i]->atividade_criada))}}</td>
            <form action="{{route('editaatividade')}}" method="post">
                @csrf
                <input type="hidden" name="id_atividade" value="{{$lista_atividades[$i]->id_atividades}}">
                <td><button class="btn">✏</td>
            </form>
            <form onclick="excluirregistro()" method="post">
                @csrf
                <input type="hidden" name="id_registro" value="{{$lista_atividades[$i]->id_atividades}}">
                <input type="hidden" name="tabela" value="atividade">
                <td><button class="btn">❌</button></td>
            </form>
        </tr>
            <?php

        }
        ?>
        <tbody>



</div>
@stop
