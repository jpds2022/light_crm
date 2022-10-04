@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Nova Etapa</h2>
    </div>
<form class="col-md-auto .mt-7" method="post" action="{{route('cadetapa')}}">
    @csrf
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Ordem da Etapa</label>
            <input type="number" class="form-control" name="ordem">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Qualquer Etapa pode Transitar</label>
            <select class="form-control" name="qualquer_etapa" id="exampleFormControlSelect2">
                <option>Sim</option>
                <option selected>Nao</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>
</form>
</div>
@stop
