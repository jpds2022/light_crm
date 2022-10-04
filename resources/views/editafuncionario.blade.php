@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">{{$lista_dados[0]->nome}}</h2>
    </div>
<form class="col-md-auto .mt-7" method="post" action="{{route('atualizafuncionario')}}">
    @csrf
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="{{$lista_dados[0]->nome}}" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Tipo</label>
            <select class="form-control" name="tipo" id="exampleFormControlSelect2">
                <option selected>{{$lista_dados[0]->tipo}}</option>
                <option>Tecnico</option>
                <option>Comercial</option>
                <option>Vendedor</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Descrição</label>
            <textarea type="text" class="form-control" name="descricao" rows="3">{{$lista_dados[0]->descricao}}</textarea>
        </div>
        <input type="hidden" name="id_funcionario" value="{{$lista_dados[0]->id_funcionario}}">
        <button type="submit" class="btn btn-primary">Atualizar</button>

    </div>
</form>
</div>

@stop
