@extends('app')

@section('titulo')
    Contatos

@stop

@section('conteudo')
    <div class='row container'>
        <div class='col-3'>
            <h1>Contatos</h1>
        </div>
    </div>
    </br>
    <form action="{{route('pesquisarcontato')}}">
        <div class="input-group m-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">Nome</span>
            </div>
            <input type="text" class="form-control" name="nome">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">Razão Social</span>
            </div>
            <input type="text" class="form-control" name="razao_social">
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
                <th scope="col">Telefone 1</th>
                <th scope="col">Razão Social</th>
                <th scope="col">e-Mail</th>
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
                <td>{{$lista_dados[$i]->nome}}</td>
                <td>{{$lista_dados[$i]->ctelefone1}}</td>
                <td>{{$lista_dados[$i]->razao_social}}</td>
                <td>{{$lista_dados[$i]->email}}</td>
                <form class="col-md-auto .mt-7" method="post" action="/editacontato">
                    @csrf
                    <input type="hidden" name="id_contato" value="{{$lista_dados[$i]->id_contato}}">
                    <td><button class="btn btn-secondary" type="submit">✏</button></td>

                </form>
                <form class="col-md-auto .mt-7" method="post" action="/acessarcontato">
                    @csrf
                    <input type="hidden" name="id_contato" value="{{$lista_dados[$i]->id_contato}}">
                    <td><button class="btn btn-secondary" type="submit">➡</button></td>

                </form>

            </tr>


            <?php
        }
        ?>



    </div>



@stop
