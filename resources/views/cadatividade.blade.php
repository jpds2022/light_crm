@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Nova Atividade</h2>
        <p>OP: {{$proposta}}</p>
    </div>
<form class="col-md-auto .mt-7" method="post" action="{{route('cadatividade')}}">
    @csrf
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Responsável</label>
            <select class="form-control" name="responsavel" id="exampleFormControlSelect2">
           <?php
            $contador=count($lista_funcionario);
            for ($i=0; $i<$contador; $i++){
                ?>
                <option>{{$lista_funcionario[$i]->nome}}</option>
            <?php
            }
            ?>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Descrição</label>
            <textarea type="text" class="form-control" name="descricao" rows="4" aria-describedby="emailHelp"></textarea>
        </div>

        <input type="hidden" name="id_op" value="{{$id_op}}">
        <input type="hidden" name="proposta" value="{{$proposta}}">
        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>
</form>
</div>
@stop
