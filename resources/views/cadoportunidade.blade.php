@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Nova Oportunidade</h2>
    </div>
       <p>Conta: {{$nome_conta}}</p>
<form class="col-md-auto .mt-7" method="post" action="/cadastrarop">
    @csrf
    <div class="col align-self-center">
        <input type="hidden" name="id_conta" value="{{$id_conta}}">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Número OP</label>
            <input type="text" readonly class="form-control-plaintext" class="form-control" name="numero_op" aria-describedby="emailHelp" value="{{$ultima_op}}" required>
        </div>
        <div class="form-group">
            <label>Parceiro(s)</label>
            <select multiple class="form-control m-1" id="parceiros_selecionados" name="parceiros[]">

            </select>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Buscar Parceiro(s)
        </button>
        <button type="button" class="btn btn-close-white" onclick="limparparceiros()">
            Limpar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buscar Parceiros</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <script>
                        function pesquisacontas(){
                            var razao_social = (document.getElementById("razao_social").value);
                            var cnpj = (document.getElementById("cnpj").value);
                            var select_parceiro = document.getElementById("parceiros");
                            var options_parceiro = document.querySelector("#opcaoparceiro");

                            if (options_parceiro !== null){
                                var opcoes = document.getElementsByClassName("opcaoparceiro");
                                while(opcoes.length > 0){
                                    opcoes[0].parentNode.removeChild(opcoes[0]);
                                }
                            }

                            $.ajax({
                                url: '/pesquisaparceiroop',
                                method: 'GET',
                                data: {razao_social: razao_social, cnpj: cnpj},
                                success: function(result) {
                                    var contador = Object.keys(result).length;
                                    for (i = 0; i < contador; i++){
                                        var option = document.createElement("option");
                                        option.setAttribute('class','opcaoparceiro');
                                        option.value = result[i]['id_conta'];
                                        option.text = result[i]['razao_social'];
                                        option.id = 'opcaoparceiro'
                                        parceiros.appendChild(option);
                                    }
                                }
                            });
                        }
                        function selecionaparceiro(){
                            var parceiroselecionado = document.getElementsByClassName("opcaoparceiro");
                            var contador = parceiroselecionado.length;
                            var voltar = document.getElementById("botao_voltar");
                            for (i = 0; i<contador; i++){

                                if (parceiroselecionado[i].selected == true){
                                    var option = document.createElement("option");
                                    option.setAttribute("selected","");
                                    option.setAttribute("class","parceiro_selecionado");
                                    option.value = parceiroselecionado[i].value;
                                    option.text = parceiroselecionado[i].text;
                                    parceiros_selecionados.appendChild(option);
                                }
                            }
                            voltar.click();

                        }
                        function limparparceiros(){
                            var opcoes = document.getElementsByClassName("parceiro_selecionado");
                            while(opcoes.length > 0){
                                    opcoes[0].parentNode.removeChild(opcoes[0]);
                            }

                        }
                    </script>
                    <div class="modal-body">
                        <form action="">
                            <div class="input-group m-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Razão Social</span>
                                </div>
                                <input type="text" class="form-control" id="razao_social" name="razao_social">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CNPJ</span>
                                </div>
                                <input type="text" class="form-control" id="cnpj" name="cnpj">
                            </div>
                            <button class="btn btn-info m-1" onclick="pesquisacontas()" type="button">Pesquisar</button>
                        </form>
                        <div class="form-group">
                            <select multiple class="form-control m-1" id="parceiros">

                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="botao_voltar" data-dismiss="modal">Voltar</button>
                        <button type="button" class="btn btn-primary" onclick="selecionaparceiro()">Selecionar</button>
                    </div>
                </div>
            </div>
        </div>
        </br>
        </br>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Produto</label>
            <select class="form-control" name="produto" id="exampleFormControlSelect2">
                <?php
                $contador=count($lista_produtos);

                if ($contador>1){
                for ($i=0; $i<$contador; $i++){
                    ?>
                <option value="{{$lista_produtos[$i]->id_produto}}">{{$lista_produtos[$i]->nome}}</option>
                <?php   }
                }
                else{
                    ?>
                <option value="{{$lista_produtos[0]->id_produto}}">{{$lista_produtos[0]->nome}}</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Gerente Projeto</label>
            <select class="form-control" name="gerente_projeto" id="exampleFormControlSelect2">
                <?php
                $contador=count($lista_tecnicos);

                if ($contador>1){
                for ($i=0; $i<$contador; $i++){
                 ?>
                    <option value="{{$lista_tecnicos[$i]->id_funcionario}}">{{$lista_tecnicos[$i]->nome}}</option>
                <?php   }
                }
                else{
                    ?>
                    <option value="{{$lista_tecnicos[0]->id_funcionario}}">{{$lista_tecnicos[0]->nome}}</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Comissão Parceiro</label>
            <input type="number" class="form-control" name="comissao_parceiro" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Número Contrato</label>
            <input type="number" class="form-control" name="numero_contrato" aria-describedby="emailHelp" value="" required>
        </div>

        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Data Previsão do Aceite</label>
            <input type="date" class="form-control" name="data_prevista_aceite" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Data de Entrega da Proposta</label>
            <input type="date" class="form-control" name="data_entrega_proposta" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Descrição Técnica Resumida</label>
            <textarea type="text" class="form-control" name="descricao_tecnica" rows="4" aria-describedby="emailHelp"></textarea>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Chance de Negócio</label>
            <input type="text" class="form-control" name="chance_negocio" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Regional</label>
            <input type="text" class="form-control" name="regional" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Implantador</label>
            <select class="form-control" name="implantador" id="exampleFormControlSelect2">
                <option>Empresa</option>
                <option>Parceiro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Vertical</label>
            <select class="form-control" name="vertical" id="exampleFormControlSelect2">
                <option>Financeiro</option>
                <option>Logística</option>
                <option>Mercantil</option>
                <option>Varejo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Empresa Responsável pelo Faturamento</label>
            <select class="form-control" name="empresa_resp_fat" id="exampleFormControlSelect2">
                <option>Empresa</option>
                <option>Parceiro</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Origem do Contato</label>
            <input type="text" class="form-control" name="origem_contato" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Parceiro na Venda</label>
            <input type="text" class="form-control" name="parceiro_venda" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Tipo Parceiro</label>
            <input type="text" class="form-control" name="tipo_parceiro" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Responsável Pela Prospecção</label>
            <select class="form-control" name="prospeccao" id="exampleFormControlSelect2">
                <?php
                $contador=count($lista_comercial);

                if ($contador>1){
                for ($i=0; $i<$contador; $i++){
                    ?>
                <option value="{{$lista_comercial[$i]->id_funcionario}}">{{$lista_comercial[$i]->nome}}</option>
                <?php   }
                }
                else{
                    ?>
                <option value="{{$lista_comercial[0]->id_funcionario}}">{{$lista_comercial[0]->nome}}</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Tipo de Treinamto</label>
            <select class="form-control" name="tipo_treinamento" id="exampleFormControlSelect2">
                <option>Remoto</option>
                <option>Presencial</option>
            </select>
        </div>
        <h3 class="m-3">Informações de Faturamento</h3>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Valor Setup</label>
            <input type="number" class="form-control" name="valor_setup" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Quantidade Parcelas Setup</label>
            <input type="number" class="form-control" name="qta_parcelas" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Número Contrato Setup</label>
            <input type="number" class="form-control" name="numero_contrato_setup" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Mensalidade</label>
            <input type="number" class="form-control" name="mensalidade" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Número Contrato Mensal</label>
            <input type="number" class="form-control" name="num_contrato_mensal" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Valor Anual</label>
            <input type="number" class="form-control" name="valor_anual" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Número Contrato Anual</label>
            <input type="number" class="form-control" name="num_contrato_anual" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Previsão Receita Kbyte</label>
            <input type="text" class="form-control" name="previsao_receita_kbyte" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Tipo Kbyte</label>
            <input type="text" class="form-control" name="tipo_kbyte" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Sub Faturamento</label>
            <input type="text" class="form-control" name="sub_fat" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Número Nota Fiscal</label>
            <input type="number" class="form-control" name="n_nf" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Especificação do itens de contrato, suporte e SLA</label>
            <textarea type="text" class="form-control" name="itens_contrato" rows="4" aria-describedby="emailHelp"></textarea>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Data do Faturamento</label>
            <input type="date" class="form-control" name="data_faturamento" aria-describedby="emailHelp" required>
        </div>
        <h3 class="m-3">Implantação</h3>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Contato Técnico</label>
            <textarea type="text" class="form-control" name="contato_tecnico" rows="3" aria-describedby="emailHelp"></textarea>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Issue Orçamento</label>
            <input type="text" class="form-control" name="issue_orcamento" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Issue Projeto</label>
            <input type="text" class="form-control" name="issue_projeto" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Issue Complementar</label>
            <input type="text" class="form-control" name="issue_complementar" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Software House</label>
            <input type="text" class="form-control" name="software_house" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Analista de Implantação</label>
            <select class="form-control" name="analista_implantacao" id="exampleFormControlSelect2">
                <?php
                $contador=count($lista_tecnicos);

                if ($contador>1){
                for ($i=0; $i<$contador; $i++){
                    ?>
                <option value="{{$lista_tecnicos[$i]->id_funcionario}}">{{$lista_tecnicos[$i]->nome}}</option>
                <?php   }
                }
                else{
                    ?>
                <option value="{{$lista_tecnicos[0]->id_funcionario}}">{{$lista_tecnicos[0]->nome}}</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Inicio da Implantação</label>
            <input type="date" class="form-control" name="inicio_implantacao" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Final da Implantação</label>
            <input type="date" class="form-control" name="final_implantacao" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Data Previsão da Entrega</label>
            <input type="date" class="form-control" name="previsao_entrega" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Data Disponibilidade Cliente</label>
            <input type="date" class="form-control" name="data_disponibilidade" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>


    </div>
</form>
</div>
@stop
