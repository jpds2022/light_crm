@extends('app')

@section('titulo')
    Produtos
@stop

@section('conteudo')

<div class='row container'>
    <div class='col-3'>
        <h1>Produtos</h1>
    </div>
</div>
</br>
<form action="pesquisarproduto">
    <div class="input-group m-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Nome</span>
        </div>
        <input type="text" class="form-control" name="nome">
    </div>
    <input class="btn btn-info m-3" type="submit" value="Pesquisar">
    <a class="btn btn-success" href="./novoproduto" role="button">Novo Produto</a>
    <a class="btn btn-outline-secondary m-3" href="./" role="button">Voltar</a>
</form>


<div class="col align-self-center">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Oportunidades Vinculadas</th>
            <th scope="col">Descrição</th>
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
            <td>0</td>
            <td>{{$lista_dados[$i]->descricao}}</td>
                <?php date_default_timezone_set('America/Bahia') ?>
            <td>{{date("d/m/Y H:i:s",strtotime($lista_dados[$i]->created_at))}}</td>
            <td>{{date("d/m/Y H:i:s",strtotime($lista_dados[$i]->updated_at))}}</td>

            <form class="col-md-auto .mt-7" action="/editaproduto" method="post">
                @csrf
                <input type="hidden" name="id_produto" value="{{$lista_dados[$i]->id_produto}}">
                <td><button class="btn btn-secondary" type="submit">✏</button></td>
            </form>
            <form class="md-auto .mt-7" onclick="excluirregistro()" method="post">
                @csrf
                <input type="hidden" name="id_registro" value="{{$lista_dados[$i]->id_produto}}">
                <input type="hidden" name="tabela" value="produto">
                <td><button class="btn" role="button">❌ </button></td>
            </form>

        </tr>


        <?php
    }
    ?>



</div>
@stop
