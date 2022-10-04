@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Novo Produto</h2>
    </div>
<form class="col-md-auto .mt-7" method="post" action="{{route('cadproduto')}}">
    @csrf
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome do Produto</label>
            <input type="text" class="form-control" name="nome_produto" value="" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Descrição do Produto</label>
            <textarea type="text" class="form-control" name="descricao_produto" rows="3" value="" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>
</form>
</div>
@stop
