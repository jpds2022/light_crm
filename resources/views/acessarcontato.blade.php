@extends('app')

@section('titulo')
    {{$lista_dados[0]->nome}}

@stop

@section('conteudo')

    <h1>{{ $lista_dados[0]->nome }} </h1>
    <div class="btn-group mr-2" role="group">
    <form class="md-auto .mt-7" method="post" action="/editacontato">
        @csrf
        <input type="hidden" name="id_contato" value="{{$lista_dados[0]->id_contato}}">
        <button class="btn btn-info" role="button">Editar ✏</button>
    </form>
    </div>
    <div class="btn-group mr-2" role="group">
        <form class="md-auto .mt-7" onclick="excluirregistro()" method="post">
            @csrf
            <input type="hidden" id="id_registro" name="id_contato" value="{{$lista_dados[0]->id_contato}}">
            <input type="hidden" id="tabela" name="tabela" value="contato">
            <button class="btn btn-danger" role="button">Excluir </button>
        </form>
    </div>
    <div class="btn-group mr-2" role="group">
            <a class="btn btn-outline-secondary" href="/acessarempresa?id_conta={{$lista_dados[0]->id_conta}}" role="button">Voltar 🔙</a>
    </div>
    </br>
    <table class="table table-bordered mt-2">
        <tbody>
        <tr>
            <th scope="col" colspan="7" class="bg-dark text-white text-center"> Dados Cadastrais</th>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td colspan="2">{{ $lista_dados[0]->nome }}</td>
            <th colspan="2">Conta</th>
            <td colspan="2"><a href="acessarempresa?id_conta={{$lista_dados[0]->id_conta}}">{{ $lista_dados[0]->razao_social }}</a></td>
        </tr>
        <tr>
            <th scope="row">Telefone 1</th>
            <td colspan="2">{{ $lista_dados[0]->ctelefone1 }}</td>
            <th colspan="2">Telefone 2</th>
            <td colspan="2">{{ $lista_dados[0]->ctelefone2 }}</td>
        </tr>
        <tr>
            <th>e-Mail</th>
            <td colspan="2">{{ $lista_dados[0]->email }}</td>
            <th colspan="2">e-Mail Alternativo</th>
            <td colspan="2">{{ $lista_dados[0]->email2 }}</td>
        </tr>
        <tr>
            <th scope="row">Nível Tomada de Decisão</th>
            <td colspan="2">{{ $lista_dados[0]->nivel_tomada_decisao }}</td>
            <th colspan="2" scope="row">Tratativa do Contato</th>
            <td colspan="2">{{ $lista_dados[0]->tratativa_contato }}</td>
        </tr>
        <tr>
            <th>Decisor?</th>
            <td colspan="2">{{ $lista_dados[0]->decisor }}</td>
            <th colspan="2">Linkedin </th>
            <td colspan="2">{{ $lista_dados[0]->linkedin }}</td>
        </tr>
        <tr>
            <th scope="row">Parceiro Comercial</th>
            <td colspan="2">{{ $lista_dados[0]->parceiro_comercial }}</td>
            <th colspan="2">Informações Adicionais do Contato</th>
            <td colspan="2">{{ $lista_dados[0]->info_add }}</td>
        </tr>
        </tbody>
    </table>

@stop
