@extends('app')

@section('titulo')
    Funcionarios
@stop

@section('conteudo')

<div class='row container'>
    <div class='col-3'>
        <h1>Funcionários</h1>
    </div>
</div>
</br>
<form action="{{route('pesquisafuncionario')}}">
    <div class="input-group m-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Nome</span>
        </div>
        <input type="text" class="form-control" name="nome">
    </div>
    <input class="btn btn-info m-3" type="submit" value="Pesquisar">
    <a class="btn btn-success" href="./novofuncionario" role="button">Novo Funcionário</a>
    <a class="btn btn-outline-secondary m-3" href="./" role="button">Voltar</a>
</form>


<div class="col align-self-center">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col">Tipo</th>
            <th scope="col">Criado</th>
            <th scope="col">Atualizado</th>
            <th scope="col">Editar</th>
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
            <td>{{$lista_dados[$i]->descricao}}</td>
            <td>{{$lista_dados[$i]->tipo}}</td>
                <?php date_default_timezone_set('America/Bahia') ?>
            <td>{{date("d/m/Y H:i:s",strtotime($lista_dados[$i]->created_at))}}</td>
            <td>{{date("d/m/Y H:i:s",strtotime($lista_dados[$i]->updated_at))}}</td>
            <form class="col-md-auto .mt-7" action="/editafuncionario" method="post">
                @csrf
                <input type="hidden" name="id_funcionario" value="{{$lista_dados[$i]->id_funcionario}}">
                <td><button class="btn btn-secondary" type="submit">✏</button></td>
            </form>
        </tr>


        <?php
    }
    ?>



</div>
@stop
