@extends('app')

@section('titulo')
    SEJA BEM VINDO
@stop
<?php date_default_timezone_set('America/Bahia');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>
@section('conteudo')
    <h1 class="text-center">Bem Vindo</h1>
    <p class="text-center"><?php echo utf8_encode(ucfirst(gmstrftime('%A, %d de %B de %Y')))?></p>
    <div class='row container'>

    </div>



@stop
