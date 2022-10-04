@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Novo Funcionário</h2>
    </div>
<form class="col-md-auto .mt-7" method="post" action="{{route('cadfuncionario')}}">
    @csrf
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Tipo</label>
            <select class="form-control" name="tipo" id="exampleFormControlSelect2">
                <option>Tecnico</option>
                <option>Comercial</option>
                <option>Vendedor</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Descrição</label>
            <textarea type="text" class="form-control" name="descricao" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>
</form>
</div>
@stop
