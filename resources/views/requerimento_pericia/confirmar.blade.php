<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimento de Perícia Médica</title>
    <!-- Bootstrap 5.1.3 -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- Custom --}}
    <link rel="stylesheet" href="{{ asset('css/inputstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="" crossorigin="anonymous">
    {{-- <link href="{{ asset('css/fontsicons.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    {{-- jquery-datepicker --}}
    <link rel="stylesheet" href="{{ asset('css/basejquery-ui.css') }}">
    {{-- jquery-timepicker --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
    <style>
        .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
        }
        
        /* Safari */
        @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
        }
        
        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }

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
        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <div class="card bg-light text-dark">
                    {{-- <form method="post" action="{{ route('requerimento_pericias.confirmacao', ['protocolo' => 1]) }}"> --}}
                    {{-- @csrf --}}
                    {{-- @method('PATCH') --}}
                    <form method="post" action="{{ url('requerimento_pericias/confirma') }}">
                            @csrf
                        <div class="card-header">
                                <h5 class="text-center fw-light p-1 m-0">Confirmação de Requerimento</h5>
                        </div>
                        <div class="card-body">
                            @if(session()->get('success'))
                            <div class="alert alert-success m-0">
                                <h5 class="alert-heading">Requerimento confirmado com sucesso.</h5>
                                <hr class="my-2">
                                {{ session()->get('success') }}
                            </div><br/>
                            @endif
                            @if(session()->get('error'))
                            <div class="alert alert-danger m-0">
                                <h5 class="alert-heading">Erro ao tentar confirmar o requerimento.</h5>
                                <hr class="my-2">
                                {{ session()->get('error') }}
                            </div><br/>
                            @endif
                            @if(session()->get('confirmado'))
                            <div class="alert alert-info m-0">
                                <h5 class="alert-heading">Este requerimento já foi confirmado.</h5>
                                <hr class="my-2">
                                {{ session()->get('confirmado') }}
                            </div><br/>
                            @endif
                            @if(session()->get('recusado'))
                            <div class="alert alert-danger m-0">
                                <h5 class="alert-heading">Este requerimento foi recusado.</h5>
                                <hr class="my-2">
                                {{ session()->get('recusado') }}
                            </div><br/>
                            @endif
                            @if(session()->get('analise'))
                            <div class="alert alert-warning m-0">
                                <h5 class="alert-heading">Este requerimento ainda está em análise.</h5>
                                <hr class="my-2">
                                {{ session()->get('analise') }}
                            </div><br/>
                            @endif
                            <div class="row mb-3 justify-content-between">
                                <div class="auto">
                                    <label class="form-label fw-normal" for="protocolo">Protocolo do Requerimento</label>
                                    <input required class="form-control" name="protocolo" type="text" id="protocolo" placeholder="Código do Protocolo" pattern=".{12,}" maxlength="12">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="form-label fw-normal">Marque a opção desejada:</label>
                                <div class="input-group">
                                    <input type="radio" class="btn-check" name="reagendar" id="confirmar" value="0" required>
                                    <label class="btn btn-outline-success" for="confirmar">Confirmar Presença</label>
                                    <input type="radio" class="btn-check" name="reagendar" id="reagendar" value="1">
                                    <label class="btn btn-outline-danger" for="reagendar">Solicitar Reagendamento</label>
                                </div>
                            </div>
                            <div id="justificativa" class="row mb-3" style="display: none;">
                                <label for="" class="form-label fw-normal">Justificativa:</label>
                                <div class="input-group">
                                    <input type="text" name="justificativa_reagenda" id="justificativa-input" class="form-control" placeholder="Escreva a justificativa para o reagendamento." maxlength="250">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <input id="enviar" type="submit" class="btn btn-success" value="Enviar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaleventclickLabel">Enviando, por favor aguarde.</h5>
                </div>
                 
                <div class="modal-body">
                    <center>
                        <div class="loader"></div>
                    </center>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/bootstrap5.bundle.min.js') }}" integrity="" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
    <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script>
        const radioConfirmar = document.querySelector('#confirmar');
        const radioReagendar = document.querySelector('#reagendar');
        const justificativaDiv = document.querySelector('#justificativa');
        const justificativaInput = document.querySelector('#justificativa-input');

        radioConfirmar.addEventListener('click', () => {
            justificativaDiv.style.display = "none";
            justificativaInput.removeAttribute('required');
            justificativaInput.value = "";
        });

        radioReagendar.addEventListener('click', () => {
            justificativaDiv.style.display = "block";
            justificativaInput.setAttribute('required', 'required');
        });
    </script>
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            $("#modaleventclick").modal("show");
        });
    </script>
</body>

</html>