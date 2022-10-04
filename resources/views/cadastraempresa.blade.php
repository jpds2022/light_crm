@extends('app')

@section('titulo')
    Contas
@stop

@section('conteudo')

    <div class="container">
        <div class="">
            <h1 class="center mt-4">Nova Conta</h1>
        </div>
        <form name="formulario" class="col-md-auto .mt-7" action="{{ route('buscacnpj') }}" onSubmit="return validaCNPJ(this);">
            <div class="col align-self-center">
                <div class="form-group mt-4">
                    <label for="exampleInputEmail1">Digite o CNPJ</label>
                    <input type="number" minlength="14" maxlength="14" class="form-control" name="CNPJ" aria-describedby="emailHelp" placeholder="CNPJ" required>
                    <small id="emailHelp" class="form-text text-muted">Não inserir separadores (. / - )</small>
                </div>
                <input type="hidden" name="acao" value="cadastrar">
                <button type="submit" class="btn btn-primary">Avançar</button>
            </div>
        </form>
    </div>
@stop


