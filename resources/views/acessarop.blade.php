@extends('app')

@section('titulo')
    {{$lista_dados[0]->nome}}

@stop

@section('conteudo')
    <h1>{{ $lista_dados[0]->nome }} </h1>
    <div class="btn-group mr-2" role="group">
    <form class="md-auto .mt-7" action="/editaop" method="post">
        @csrf
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id_op" id="id_op" value="{{$lista_dados[0]->id_op}}">
        <button class="btn btn-info" role="button">Editar ✏</button>
    </form>
    </div>
    <div class="btn-group mr-2" role="group">
    <form action="/novaatividade" method="post">
        @csrf
        <input type="hidden" name="id_op" value="{{$lista_dados[0]->id_op}}">
        <input type="hidden" name="proposta" value="{{ $lista_dados[0]->proposta}}">
        <button class="btn btn-success text-white" role="button">Nova Atividade +</button>
    </form>
    </div>
    <div class="btn-group mr-2" role="group">
        <form class="md-auto .mt-7" onclick="excluirregistro()" method="post">
            @csrf
            <input type="hidden" id="id_registro" value="{{$lista_dados[0]->id_op}}">
            <input type="hidden" id="tabela" value="ops">
            <button class="btn btn-danger" role="button">Excluir </button>
        </form>
    </div>
    <div class="btn-group mr-2" role="group">
        <a class="btn btn-outline-secondary" href="./consultaop" role="button">Voltar 🔙</a>
    </div>
    <script>
        function alteraetapa(){
            var nova_etapa = (document.getElementById("etapa").value);
            var split_nova_etapa = nova_etapa.split("-");
            var nova_etapa_ordem = split_nova_etapa[0];
            var nova_etapa_nome = split_nova_etapa[1];
            var id_op = document.getElementById("id_op").value;
            $.ajax({
            url: '/atualizaetapaop',
            method: 'GET',
            data: {nova_etapa_ordem: nova_etapa_ordem, nova_etapa_nome: nova_etapa_nome, id_op: id_op},
                success:
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 3000),


            });
        }
    </script>
    <div class="btn-group mr-2 float-right" role="group">
        <select class="form-control" onchange="alteraetapa()" name="etapa" id="etapa">
            <?php

                $contador=count($proxima_etapa);
                for ($i=0; $i<$contador; $i++){
                    ?>
                    <option value="{{$proxima_etapa[$i]->ordem}}-{{$proxima_etapa[$i]->nome}}" id="nova_etapa">{{$proxima_etapa[$i]->nome}}</option>
                <?php }
            ?>
            <option selected>{{$lista_dados[0]->nome_fase_oportunidade}}</option>
        </select>
    </div>

    </br>
    <table class="table table-bordered mt-2">
        <tbody>
        <tr>
            <th scope="col" colspan="7" class="bg-dark text-white text-center"> Dados OP</th>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td colspan="2">{{ $lista_dados[0]->nome}}</td>
            <th colspan="2">OP</th>
            <td colspan="2">{{ $lista_dados[0]->proposta}}</td>
        </tr>
        <tr>
            <th scope="row">Cliente</th>
            <td colspan="2">{{ $lista_dados[0]->razao_social }}</td>
            <th colspan="2">Gerente Projeto</th>
            <td colspan="2">{{ $lista_gerente_projeto[0]->nome }}</td>
        </tr>
        <tr>
            <th>Comissão Parceiro</th>
            <td colspan="2">{{ $lista_dados[0]->comissao_parceiro }}</td>
            <th colspan="2">Número do Contrato</th>
            <td colspan="2">{{ $lista_dados[0]->numero_contrato }}</td>
        </tr>
        <tr>
            <th scope="row">Data Prevista do Aceite</th>
            <td colspan="2">{{ $lista_dados[0]->data_prevista_aceite }}</td>
            <th colspan="2" scope="row">Data de Entrega da Proposta</th>
            <td colspan="2">{{ $lista_dados[0]->data_entrega_proposta }}</td>
        </tr>
        <tr>
            <th>Chance de Negócio</th>
            <td colspan="2">{{ $lista_dados[0]->chance_negocio }}</td>
            <th colspan="2">Regional </th>
            <td colspan="2">{{ $lista_dados[0]->regional }}</td>
        </tr>
        <tr>
            <th scope="row">Implantador</th>
            <td colspan="2">{{ $lista_dados[0]->implantador }}</td>
            <th colspan="2">Vertical</th>
            <td colspan="2">{{ $lista_dados[0]->vertical }}</td>
        </tr>
        <tr>
            <th>Origem Contato</th>
            <td colspan="2">{{ $lista_dados[0]->origem_contato }}</td>
            <th scope="row" colspan="2">Parceiro na Venda</th>
            <td colspan="2">{{ $lista_dados[0]->parceiro_venda }}</td>
        </tr>
        <tr>
            <th>Tipo Parceiro</th>
            <td colspan="2">{{ $lista_dados[0]->tipo_parceiro }}</td>
            <th scope="row" colspan="2">Responsável pela Prospecção</th>
            <td colspan="2">{{ $lista_responsavel_prospeccao[0]->nome }}</td>
        </tr>
        <tr>
            <th>Parceiros</th>


            <td colspan="2">
                <?php
                $contador=count($nome_parceiros_array);
                for ($i=0; $i<$contador; $i++){
                  echo $i+1;
                  echo " - ".$nome_parceiros_array[$i];
                  echo "</br>";
                } ?>
            </td>
            <th scope="row">Tipo de Treinamento</th>
            <td colspan="2">{{ $lista_dados[0]->tipo_treinamento }}</td>
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

    <table class="table table-bordered mt-2">
        <tbody>
        <tr>
            <th scope="col" colspan="7" class="bg-dark text-white text-center"> Dados Faturamento</th>
        </tr>
        <tr>
            <th scope="row">Valor Setup</th>
            <td colspan="2">{{ $lista_dados[0]->valor_setup}}</td>
            <th colspan="2">Quantidade de Parcelas Setup</th>
            <td colspan="2">{{ $lista_dados[0]->qta_parcelas}}</td>
        </tr>
        <tr>
            <th scope="row">Número Contrato Setup</th>
            <td colspan="2">{{ $lista_dados[0]->numero_contrato_setup }}</td>
            <th colspan="2">Mensalidade</th>
            <td colspan="2">{{ $lista_dados[0]->mensalidade }}</td>
        </tr>
        <tr>
            <th>Número do Contrato Mensal</th>
            <td colspan="2">{{ $lista_dados[0]->num_contrato_mensal }}</td>
            <th colspan="2">Valor Anual</th>
            <td colspan="2">{{ $lista_dados[0]->valor_anual }}</td>
        </tr>
        <tr>
            <th scope="row">Número do Contrato Anual</th>
            <td colspan="2">{{ $lista_dados[0]->num_contrato_anual }}</td>
            <th colspan="2" scope="row">Previsão Receita Kbyte</th>
            <td colspan="2">{{ $lista_dados[0]->previsao_receita_kbyte }}</td>
        </tr>
        <tr>
            <th>Tipo Kbyte</th>
            <td colspan="2">{{ $lista_dados[0]->tipo_kbyte }}</td>
            <th colspan="2">Sub Faturamento </th>
            <td colspan="2">{{ $lista_dados[0]->sub_fat }}</td>
        </tr>
        <tr>
            <th scope="row">Número da Nota Fiscal</th>
            <td colspan="2">{{ $lista_dados[0]->n_nf }}</td>
            <th colspan="2">Especificação do itens de contrato, suporte e SLA</th>
            <td colspan="2">{{ $lista_dados[0]->itens_contrato }}</td>
        </tr>
        <tr>
            <th>Data do Faturamento</th>
            <td colspan="2">{{ $lista_dados[0]->data_fat }}</td>
            <th scope="row" colspan="2">Issue Orçamento</th>
            <td colspan="2">{{ $lista_dados[0]->issue_orcamento }}</td>
        </tr>
        </tbody>
    </table>
    <table class="table table-bordered mt-2">
        <tbody>
        <tr>
            <th scope="col" colspan="7" class="bg-dark text-white text-center"> Dados Implantação</th>
        </tr>
        <tr>
            <th scope="row">Contato Técnico</th>
            <td colspan="2">{{ $lista_dados[0]->contato_tecnico}}</td>
            <th colspan="2">Issue Projeto</th>
            <td colspan="2">{{ $lista_dados[0]->issue_projeto}}</td>
        </tr>
        <tr>
            <th scope="row">Issue Complementar</th>
            <td colspan="2">{{ $lista_dados[0]->issue_complementar }}</td>
            <th colspan="2">Software House</th>
            <td colspan="2">{{ $lista_dados[0]->software_house }}</td>
        </tr>
        <tr>
            <th>Analista de Implantação</th>
            <td colspan="2">{{ $lista_analista_implantacao[0]->nome}}</td>
            <th colspan="2">Inicio da Implantação</th>
            <td colspan="2">{{ $lista_dados[0]->inicio_implantacao }}</td>
        </tr>
        <tr>
            <th scope="row">Final da Implantação</th>
            <td colspan="2">{{ $lista_dados[0]->final_implantacao }}</td>
            <th colspan="2" scope="row">Data Disponibilidade Cliente</th>
            <td colspan="2">{{ $lista_dados[0]->data_disponibilidade }}</td>
        </tr>
        <tr>
            <th>Tipo de Implantação</th>
            <td colspan="2">{{ $lista_dados[0]->tipo_implantacao }}</td>
            <th colspan="2">Previsão da Entrega </th>
            <td colspan="2">{{ $lista_dados[0]->previsao_entrega }}</td>
        </tr>
        </tbody>
    </table>

    <div class="col align-self-center">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="7" class="bg-dark text-white text-center"> Atividades </th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Status</th>
                <th scope="col">Responsável</th>
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
                <td>{{$lista_atividades[$i]->nome}}</td>
                <td>{{$lista_atividades[$i]->status}}</td>
                <td>{{$lista_atividades[$i]->responsavel}}</td>
                <td>{{ date("d/m/Y H:i:s",strtotime($lista_atividades[$i]->created_at))}}</td>
                <form action="{{route('editaatividade')}}" method="post">
                    @csrf
                <input type="hidden" name="id_atividade" value="{{$lista_atividades[$i]->id_atividades}}">
                <input type="hidden" name="proposta" value="{{ $lista_dados[0]->proposta}}">
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
            <input type="hidden" name="id_registro" value="{{$lista_dados[0]->id_op}}">
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
                <input type="hidden" name="id_registro" value="{{$lista_dados[0]->id_op}}">
                <input type="hidden" name="tipo_registro" value="OP">
                <label class="custom-file-label" for="inputGroupFile01">Buscar Arquivo</label>
            </div>
        </div>
        <input type="submit" class="btn m-2" value="Enviar Anexo">
    </form>

@stop
