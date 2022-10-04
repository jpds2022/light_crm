@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Editar Conta</h2>
        <p>ID Conta: {{$lista_dados[0]->id_conta}}</p>
    </div>
       <div class="btn-group mr-2" role="group">
           <a class="btn btn-outline-secondary" href="/acessarempresa?id_conta={{$lista_dados[0]->id_conta}}" role="button">Voltar 🔙</a>
       </div>
<form class="col-md-auto .mt-7" action="{{ route('atualizaempresa') }}">
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">CNPJ</label>
            <input type="number" minlength="14" maxlength="14" class="form-control" name="CNPJ" aria-describedby="emailHelp" value="{{$lista_dados[0]->cnpj}}" required>
            <small id="emailHelp" class="form-text text-muted">Não inserir separadores (. / - )</small>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome Fantasia</label>
            <input type="text" class="form-control" name="nome_fantasia" aria-describedby="emailHelp" value="{{$lista_dados[0]->nome_fantasia}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Razão Social</label>
            <input type="text" class="form-control" name="razao_social" aria-describedby="emailHelp" value="{{$lista_dados[0]->razao_social}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Inscrição Estadual</label>
            <input type="text" class="form-control" name="IE" aria-describedby="emailHelp" value="{{$lista_dados[0]->ie}}">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Observações</label>
            <input type="text" class="form-control" name="observacoes" aria-describedby="emailHelp" value="{{$lista_dados[0]->observacoes}}" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Oportunidades Trabalhadas</label>
            <select multiple class="form-control" name="oportunidades_trabalhadas[]" id="exampleFormControlSelect2">
                <?php
                    $op_trabalhadas=json_decode($lista_dados[0]->oportunidades_trabalhadas);

                    if ($op_trabalhadas > 1){
                        $contador=count($op_trabalhadas);
                        for ($i=0; $i<$contador; $i++){?>
                        <option selected>{{$op_trabalhadas[$i]}}</option>
                        <?php
                        }
                    }
                    else{ ?>
                        <option selected>{{$op_trabalhadas[0]}}</option>
                    <?php
                    }
                ?>
                <option>Financeiro</option>
                <option>Logística</option>
                <option>Mercantil</option>
                <option>Varejo</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">CNAE</label>
            <input type="text" class="form-control" name="cnae" aria-describedby="emailHelp" value="{{$lista_dados[0]->cnae}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Tipo de Conta</label>
            <select multiple class="form-control" name="tipo_conta[]" id="exampleFormControlSelect2">
                <?php
                $tipo_conta=json_decode($lista_dados[0]->tipo_conta);
                if ($tipo_conta > 1){
                    $contador=count($tipo_conta);
                    for ($i=0; $i<$contador; $i++){?>
                    <option selected>{{$tipo_conta[$i]}}</option>
                    <?php
                }
                }
                else{ ?>
                <option selected>{{$tipo_conta[0]}}</option>
                    <?php
                }
                ?>
                <option>Concorrente</option>
                <option>Cliente HUB</option>
                <option>Cliente Parceiro</option>
                <option>Prospect</option>
                <option>Representante</option>
                <option>Parceiro Comercial</option>
                <option>Fornecedor</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Telefone 1</label>
            <input type="text" class="form-control" name="telefone1" aria-describedby="emailHelp" value="{{$lista_dados[0]->telefone1}}">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Telefone 2</label>
            <input type="text" class="form-control" name="telefone2" aria-describedby="emailHelp" value="{{$lista_dados[0]->telefone2}}">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Website</label>
            <input type="text" class="form-control" name="website" aria-describedby="emailHelp" value="{{$lista_dados[0]->website}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Número de Funcionários</label>
            <select class="form-control" name="nfuncionarios">
                <option selected>{{$lista_dados[0]->n_funcionario}}</option>
                <option>0-10</option>
                <option>10-20</option>
                <option>20-50</option>
                <option>50-100</option>
                <option>100-200</option>
                <option>200-500</option>
                <option>500-1000</option>
                <option>500-1000</option>
                <option>> 1000</option>
                <option>> 2000</option>
                <option>> 5000</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Endereço</label>
            <input type="text" class="form-control" name="endereco" aria-describedby="emailHelp" value="{{$lista_dados[0]->endereco}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Cidade</label>
            <input type="text" class="form-control" name="cidade" aria-describedby="emailHelp" value="{{$lista_dados[0]->cidade}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">UF</label>
            <input type="text" class="form-control" name="uf" aria-describedby="emailHelp" value="{{$lista_dados[0]->uf}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">CEP</label>
            <input type="text" class="form-control" name="cep" aria-describedby="emailHelp" value="{{$lista_dados[0]->cep}}">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Ramo de Atividade</label>
            <input type="text" class="form-control" name="ramo_atividade" aria-describedby="emailHelp" value="{{$lista_dados[0]->ramo_atividade}}">
        </div>

        <input type="hidden" name="id_conta" value="{{$lista_dados[0]->id_conta}}">
        <button type="submit" class="btn btn-primary mt-4 mb-5">Atualizar</button>

    </div>
</form>
</div>
@stop
