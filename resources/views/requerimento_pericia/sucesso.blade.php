<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimento de Perícia Médica</title>
    <!-- Bootstrap 5.1.3 -->
    <link href="{{ asset('css/bootstrap5.min.css') }}" rel="stylesheet" integrity="" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" integrity="" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/inputstyle.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app4.1.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="" crossorigin="anonymous">
    <style>
      body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body class="bg-white" style="font-family: 'Roboto', sans-serif;">
    <nav class="navbar navbar-light bg-light shadow-sm mb-3">
        <div class="container">
                <img src="{{ asset('assets/logo.png') }}" height='70vh' alt="Logotipo Prefeitura de Mesquita">
        </div>
    </nav>

    <div class="container mt-3 mb-5">
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
    </div>
    <footer class="footer back-roxo">
      <div class="container-fluid">
        <nav>
            <a style="padding-left: 30px">
              <b> ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, EQUIPE DE DESENVOLVIMENTO DE SISTEMAS
                    
              </b>
            </a>
          
         
            <a style="padding-left: 30px">
              <b><i class="fab fa-free-code-camp"></i> SUBSECRETARIA DA TECNOLOGIA DA INFORMAÇÃO - PREFEITURA MUNICIPAL DE MESQUITA - RJ</b>
            </a>
     
          
            <a style="padding-left: 30px">
              <b>RUA ARTHUR OLIVEIRA VECCHI, 120 - CENTRO - MESQUITA - RJ - CEP: 26553-080</b>
            </a>
            
            <a class="text-white" style="text-decoration: none; padding-left: 30px" href="https://lgpd.mesquita.rj.gov.br/?page_id=43" target="_blank">
              <b>POLÍTICA DE PRIVACIDADE</b>
            </a>
        </nav>
      </div>
  </footer>
    {{-- Bootstrap Dependencies --}}
    <script src="{{ asset('js/bootstrap5.bundle.min.js') }}" integrity="" crossorigin="anonymous"></script>
</body>

</html>