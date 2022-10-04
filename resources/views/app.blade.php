<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>@yield('titulo')</title>
    <script>
        function excluirregistro() {
            var tabela = document.getElementById("tabela").value;
            var id_registro = document.getElementById("id_registro").value;

            var resultado = confirm("Esta ação não tem reversão, o registro terá seus dados excluídos permanentemente. Tem certeza que deseja continuar?");

            if (resultado == true){
                $.ajax({
                    url: '/excluir_registro',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {tabela: tabela, id_registro: id_registro},
                    success:
                        alert(tabela+' excluido(a)')

                });

            }
        }
    </script>
</head>
<body class="bg-light">


<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
    <img src="https://servidorarquivoscrm.000webhostapp.com/logo2lightcrm.png" height="30" width="80">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="./">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./contas">Contas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./contatos">Contatos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./consultaop">OPs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./atividades">Atividades</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Configurações
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item bg-dark text-white" href="./funcionarios">Funcionários</a>
                    <a class="dropdown-item bg-dark text-white" href="./produtos">Produtos</a>
                    <a class="dropdown-item bg-dark text-white" href="./consultafluxoop">Fluxo de Etapas OP</a>
                    <a class="dropdown-item bg-dark text-white" href="./register">Cadastrar Usuário</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
</br>
    @yield('conteudo')
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

