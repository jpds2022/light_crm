@extends('app')

@section('conteudo')
   <div class="container">
    <div class="">
    <h2 class="center mt-4">Novo Contato</h2>
        <p>Conta: {{$lista_dados[0]->razao_social}}</p>
        <p>ID: {{$lista_dados[0]->id_conta}}</p>
    </div>
<form class="col-md-auto .mt-7" method="post" action="/novocontato">
    @csrf
    <input type="hidden" name="id_conta" value="{{$lista_dados[0]->id_conta}}">
    <div class="col align-self-center">
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Telefone 1</label>
            <input type="text" class="form-control" name="telefone1" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Telefone 2</label>
            <input type="text" class="form-control" name="telefone2" aria-describedby="emailHelp" value="" required>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">e-Mail</label>
            <input type="text" class="form-control" name="email1" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">e-Mail Alternativo</label>
            <input type="text" class="form-control" name="email2" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Nivel Tomada de Decisão</label>
            <select class="form-control" name="nivel_tomada_decisao" id="exampleFormControlSelect2">
                <option>Nível Societário</option>
                <option>Nível Gerencial</option>
                <option>Nível de Coordenação</option>
                <option>Nível de Operação</option>
                <option>Nível Estagiário / Trainee</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Trativa do Contato</label>
            <select class="form-control" name="tratativa_contato" id="exampleFormControlSelect2">
                <option>Feminino</option>
                <option>Masculino</option>
                <option>Não Informado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Decisor?</label>
            <select class="form-control" name="decisor" id="exampleFormControlSelect2">
                <option>Não</option>
                <option>Sim</option>
                <option>Não Informado</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Linkedin</label>
            <input type="text" class="form-control" name="linkedin" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Parceiro Comercial?</label>
            <select class="form-control" name="parceiro_comercial" id="exampleFormControlSelect2">
                <option>Não</option>
                <option>Sim</option>
                <option>Não Informado</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleInputEmail1">Informações Adicionais do Contato</label>
            <textarea type="text" class="form-control" name="info_add" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>
</form>
</div>
@stop
