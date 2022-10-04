@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">{{$lista_dados[0]->nome}}</h2>
    </div>
<form class="col-md-auto .mt-7" method="post" action="atualizaproduto">
    @csrf
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome do Produto</label>
            <input type="text" class="form-control" name="nome_produto" value="{{$lista_dados[0]->nome}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Descrição do Produto</label>
            <textarea type="text" class="form-control" name="descricao_produto" rows="3" required>{{$lista_dados[0]->descricao}}</textarea>
        </div>
        <input type="hidden" value="{{$lista_dados[0]->id_produto}}" name="id_produto">
        <button type="submit" class="btn btn-primary">Atualizar</button>

    </div>
</form>
</div>
@stop
