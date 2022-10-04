@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Editar Etapa</h2>
    </div>
<form class="col-md-auto .mt-7" method="post" action="{{route('atualizaetapafluxoop')}}">
    @csrf
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="{{$lista_dados[0]->nome}}" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Ordem da Etapa</label>
            <input type="number" class="form-control" name="ordem" value="{{$lista_dados[0]->ordem}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Qualquer Etapa pode Transitar</label>
            <select class="form-control" name="qualquer_etapa" id="exampleFormControlSelect2">
                <option selected>{{$lista_dados[0]->qualquer_etapa}}</option>
                <option>Sim</option>
                <option>Nao</option>
            </select>
        </div>
        <input type="hidden" name="id_fluxo_op" value="{{$lista_dados[0]->id_fluxo_op}}">
        <button type="submit" class="btn btn-primary">Atualizar</button>

    </div>
</form>
</div>
@stop
