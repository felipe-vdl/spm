<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimento de Perícia Médica</title>
    <!-- Bootstrap 5.1.3 -->
    <link href="{{ asset('css/bootstrap5.min.css') }}" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/inputstyle.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body class="bg-white" style="font-family: 'Roboto', sans-serif;">
    <nav class="navbar navbar-light bg-light shadow-sm mb-3">
        <div class="container">
                <img src="{{ asset('assets/logo.png') }}" height='70vh' alt="Logotipo Prefeitura de Mesquita">
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                        @if(session()->get('success'))
                        <div id="success" class="alert alert-success m-0">
                            <h5 class="alert-heading">{{ session()->get('success') }}</h5>
                            <p class="mb-0">O protocolo do seu requerimento será informado por e-mail, fique atento e <strong>VERIFIQUE SUA CAIXA DE SPAM</strong>.</p>
                            <hr class="my-2">
                            <p class="mb-0">A resposta com o agendamento poderá se dar em até 48 horas úteis da solicitação.</p>
                        </div>
                        @endif
                        @if(session()->get('confirmado'))
                        <div class="alert alert-success m-0">
                            <h5 class="alert-heading">Requerimento confirmado com sucesso.</h5>
                            <hr class="my-2">
                            {{ session()->get('confirmado') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <footer class="row justify-content-center mt-3 mt-lg-4 mb-3 mb-lg-0 border-top">
            <div class="col-auto text-center mt-3 mt-lg-5">
                <p class="fw-normal lh-0 mb-1" style="font-size: 17px;"><i class="fab fa-free-code-camp"></i> Equipe de Desenvolvimento de Sistemas</p>
                <p class="fw-light lh-0 mb-0" style="font-size: 14px;"> Subsecretaria de Tecnologia da Informação - Prefeitura Municipal de Mesquita - RJ </p>
                <p class="fw-light lh-0 mb-0" style="font-size: 14px;"> Rua Arthur Oliveira Vecchi, 120 - Centro - Mesquita - RJ - CEP: 26553-080</p>
            </div>
        </footer>
    </div>
    {{-- Bootstrap Dependencies --}}
    <script src="{{ asset('js/bootstrap5.bundle.min.js') }}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>