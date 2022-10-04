@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Nova Conta</h2>
    </div>
<form class="col-md-auto .mt-7" action="{{ route('cadempresa') }}">
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">CNPJ</label>
            <input type="number" minlength="14" maxlength="14" class="form-control" name="CNPJ" aria-describedby="emailHelp" value="{{$cnpj}}" required>
            <small id="emailHelp" class="form-text text-muted">Não inserir separadores (. / - )</small>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome Fantasia</label>
            <input type="text" class="form-control" name="nome_fantasia" aria-describedby="emailHelp" value="{{$nome_fantasia}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Razão Social</label>
            <input type="text" class="form-control" name="razao_social" aria-describedby="emailHelp" value="{{$razao_social}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Inscrição Estadual</label>
            <input type="number" class="form-control" name="IE" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Observações</label>
            <input type="text" class="form-control" name="observacoes" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Oportunidades Trabalhadas</label>
            <select multiple class="form-control" name="oportunidades_trabalhadas[]" id="exampleFormControlSelect2">
                <option>Financeiro</option>
                <option>Logística</option>
                <option>Mercantil</option>
                <option>Varejo</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">CNAE</label>
            <input type="number" class="form-control" name="cnae" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Tipo de Conta</label>
            <select multiple class="form-control" name="tipo_conta[]" id="exampleFormControlSelect2">
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
            <input type="text" class="form-control" name="telefone1" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Telefone 2</label>
            <input type="text" class="form-control" name="telefone2" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Website</label>
            <input type="text" class="form-control" name="website" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Número de Funcionários</label>
            <select class="form-control" name="nfuncionarios">
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
            <input type="text" class="form-control" name="endereco" aria-describedby="emailHelp" value="{{$endereco}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Cidade</label>
            <input type="text" class="form-control" name="cidade" aria-describedby="emailHelp" value="{{$cidade}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">UF</label>
            <input type="text" class="form-control" name="uf" aria-describedby="emailHelp" value="{{$uf}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">CEP</label>
            <input type="text" class="form-control" name="cep" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">País</label>
            <input type="text" class="form-control" name="pais" aria-describedby="emailHelp" value="{{$pais}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Ramo de Atividade</label>
            <input type="text" class="form-control" name="ramo_atividade" aria-describedby="emailHelp">
        </div>
        <?php
        if ($acao==="editar"){

       ?>
        <input type="hidden" name="acao" value="editar">
        <button type="submit" class="btn btn-primary mt-4 mb-5">Atualizar</button>
        <?php  } if($acao==="cadastrar") {  ?>
        <input type="hidden" name="acao" value="cadastrar">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <?php } ?>

    </div>
</form>
</div>
@stop
