@extends('app')

@section('titulo')
    {{$lista_dados[0]->nome_fantasia}}

@stop

@section('conteudo')
    <h1>{{ $lista_dados[0]->nome_fantasia }} </h1>
    <div class="btn-group mr-2" role="group">
    <form class="md-auto .mt-7" action="/editaempresa">
        <input type="hidden" name="id_conta" value="{{$lista_dados[0]->id_conta}}">
        <button class="btn btn-info" role="button">Editar ✏</button>
    </form>
    </div>
    <div class="btn-group mr-2" role="group">
    <form action="/cadcontato">
        <input type="hidden" name="id_conta" value="{{$lista_dados[0]->id_conta}}">
        <button class="btn btn-success text-white" role="button">Novo Contato +</button>
    </form>
    </div>
    <div class="btn-group mr-2" role="group">
    <form action="/novaop">
        <input type="hidden" name="id_conta" value="{{$lista_dados[0]->id_conta}}">
        <button class="btn btn-success text-white" role="button">Nova OP +</button>
    </form>
    </div>
    <div class="btn-group mr-2" role="group">
        <a class="btn btn-outline-secondary" href="./contas" role="button">Voltar 🔙</a>
    </div>

    </br>
    <table class="table table-bordered mt-2">
        <tbody>
        <tr>
            <th scope="col" colspan="7" class="bg-dark text-white text-center"> Dados Cadastrais</th>
        </tr>
        <tr>
            <th scope="row">Razão Social</th>
            <td colspan="2">{{ $lista_dados[0]->razao_social }}</td>
            <th colspan="2">Nome Fantasia</th>
            <td colspan="2">{{ $lista_dados[0]->nome_fantasia }}</td>
        </tr>
        <tr>
            <th scope="row">CNPJ</th>
            <td colspan="2">{{ $lista_dados[0]->cnpj }}</td>
            <th colspan="2">I.E</th>
            <td colspan="2">{{ $lista_dados[0]->ie }}</td>
        </tr>
        <tr>
            <th>CNAE</th>
            <td colspan="2">{{ $lista_dados[0]->cnae }}</td>
            <th colspan="2">Ramo de Atividade</th>
            <td colspan="2">{{ $lista_dados[0]->ramo_atividade }}</td>
        </tr>
        <tr>
            <?php
            $oportunidades_trabalhadas=$lista_dados[0]->oportunidades_trabalhadas;
            $oportunidades_trabalhadas_replace=str_replace(array("[","]",'"')," ",$oportunidades_trabalhadas);
            $tipo_conta=$lista_dados[0]->tipo_conta;
            $tipo_conta_replace=str_replace(array("[","]",'"')," ",$tipo_conta);
        ?>
            <th scope="row">Oportunidades Trabalhadas</th>
            <td colspan="2">{{ $oportunidades_trabalhadas_replace }}</td>
            <th colspan="2" scope="row">Tipo de Conta</th>
            <td colspan="2">{{ $tipo_conta_replace }}</td>
        </tr>
        <tr>
            <th>Telefone 1</th>
            <td colspan="2">{{ $lista_dados[0]->telefone1 }}</td>
            <th colspan="2">Telefone 2 </th>
            <td colspan="2">{{ $lista_dados[0]->telefone2 }}</td>
        </tr>
        <tr>
            <th scope="row">Website</th>
            <td colspan="2"><a href="{{ $lista_dados[0]->website }}">{{ $lista_dados[0]->website }}</a></td>
            <th colspan="2">Número de Funcionários</th>
            <td colspan="2">{{ $lista_dados[0]->n_funcionario }}</td>
        </tr>
        <tr>
            <th>Endereço</th>
            <td colspan="2">{{ $lista_dados[0]->endereco }}</td>
            <th scope="row" colspan="2">Cidade</th>
            <td colspan="2">{{ $lista_dados[0]->cidade }}</td>
        </tr>
        <tr>
            <th>CEP</th>
            <td colspan="2">{{ $lista_dados[0]->cep }}</td>
            <th scope="row" colspan="2">UF</th>
            <td colspan="2">{{ $lista_dados[0]->uf }}</td>
        </tr>
        <tr>
            <th scope="row">Observações</th>
            <td colspan="5">{{ $lista_dados[0]->observacoes }}</td>
        </tr>
        <tr>
            <?php date_default_timezone_set('America/Bahia') ?>
            <th>Data de Criação</th>
            <td colspan="2">{{ date("d/m/Y H:i:s",strtotime($lista_dados[0]->created_at))}}</td>
            <th colspan="2">Data de Atualização</th>
            <td colspan="2">{{ date("d/m/Y H:i:s",strtotime($lista_dados[0]->updated_at))}}</td>

        </tr>
        </tbody>
    </table>

    <div class="col align-self-center">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="7" class="bg-dark text-white text-center"> Contatos </th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone 1</th>
                <th scope="col">Telefone 2</th>
                <th scope="col">e-Mail</th>
                <th scope="col">Editar</th>
                <th scope="col">Acessar</th>
            </tr>
            </thead>
            <tbody>
            <?php


            $contador=count($lista_dados_contato);

            for ($i=0; $i<$contador; $i++){


                ?>


            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$lista_dados_contato[$i]->nome}}</td>
                <td>{{$lista_dados_contato[$i]->telefone1}}</td>
                <td>{{$lista_dados_contato[$i]->telefone2}}</td>
                <td>{{$lista_dados_contato[$i]->email}}</td>
                <form class="col-md-auto .mt-7" method="post" action="/editacontato">
                    @csrf
                    <input type="hidden" name="id_contato" value="{{$lista_dados_contato[$i]->id_contato}}">
                    <td><button class="btn btn-secondary" type="submit">✏</button></td>

                </form>
                <form class="col-md-auto .mt-7" method="post" action="/acessarcontato">
                    @csrf
                    <input type="hidden" name="id_contato" value="{{$lista_dados_contato[$i]->id_contato}}">
                    <td><button class="btn btn-secondary" type="submit">➡</button></td>

                </form>

            </tr>


            <?php
        }
        ?>



    </div>
    <div class="col align-self-center">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="7" class="bg-dark text-white text-center"> OPs </th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Proposta</th>
                <th scope="col">Valor Setup</th>
                <th scope="col">Mensalidade</th>
                <th scope="col">Editar</th>
                <th scope="col">Acessar</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $contador=count($lista_dados_op);

            if ($contador>0){
            for ($i=0; $i<$contador; $i++){


                ?>


            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$lista_dados_op[$i]->nome}}</td>
                <td>{{$lista_dados_op[$i]->proposta}}</td>
                <td>{{$lista_dados_op[$i]->valor_setup}}</td>
                <td>{{$lista_dados_op[$i]->mensalidade}}</td>
                <form class="col-md-auto .mt-7" method="post" action="/acessarop">
                    @csrf
                    <input type="hidden" name="id_op" value="{{$lista_dados_op[$i]->id_op}}">
                    <input type="hidden" name="acao" value="editar">
                    <td><button class="btn btn-secondary" type="submit">✏</button></td>

                </form>
                <form class="col-md-auto .mt-7" method="post" action="/acessarop">
                    @csrf
                    <input type="hidden" name="id_op" value="{{$lista_dados_op[$i]->id_op}}">
                    <input type="hidden" name="acao" value="acessar">
                    <td><button class="btn btn-secondary" type="submit">➡</button></td>

                </form>

            </tr>


            <?php
        }
                    }

        ?>



    </div>
    <div class="col align-self-center">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="7" class="bg-dark text-white text-center"> Anexos </th>
            </tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col"></th>
            <th scope="col">Baixar</th>
            </tr>
            </thead>
            <?php
            $contador=count($anexos);
            for ($i=0; $i<$contador; $i++){
                $nome_arquivo=explode('/',$anexos[$i]);
                ?>
            </tr>
            <td>{{$i+1}}</td>
            <td>{{$nome_arquivo[5]}}</td>
            <td></td>
            <form action="./baixararquivo" method="post">
                @csrf
                <input type="hidden" name="nome_arquivo" value="{{$nome_arquivo[5]}}">
                <input type="hidden" name="id_registro" value="{{$lista_dados[0]->id_conta}}">
                <td><button class="btn" type="submit">⬇</button></td>
            </form>
            </tr>
                <?php
            }
            ?>
            <tbody>
    </div>

    <form action="./anexar" method="post" enctype="multipart/form-data">
        @csrf
        <h3> Anexar Arquivos</h3>
        <div class="input-group m-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Anexo</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="anexo">
                <input type="hidden" name="id_registro" value="{{$lista_dados[0]->id_conta}}">
                <input type="hidden" name="tipo_registro" value="conta">
                <label class="custom-file-label" for="inputGroupFile01">Buscar Arquivo</label>
            </div>
        </div>
        <input type="submit" class="btn m-2" value="Enviar Anexo">
    </form>


@stop
