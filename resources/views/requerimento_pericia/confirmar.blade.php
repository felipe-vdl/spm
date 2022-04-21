<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimento de Perícia Médica</title>
    <!-- Bootstrap 5.1.3 -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    {{-- jquery-datepicker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- jquery-timepicker --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
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
    </style>
</head>

<body class="bg-white" style="font-family: 'Roboto', sans-serif;">
    <nav class="navbar navbar-light bg-light shadow-sm mb-3">
        <div class="container">
                <img src="{{ asset('assets/logo.png') }}" height='70vh' alt="Logotipo Prefeitura de Mesquita">
        </div>
    </nav>

    <div class="container mt-3">
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
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <input id="enviar" type="submit" class="btn btn-success" value="Confirmar Requerimento">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="row justify-content-center mt-3 mt-md-4 mb-3 mb-md-0 border-top">
            <div class="col-auto text-center mt-3 mt-md-5">
                <p class="fw-normal lh-0 mb-1" style="font-size: 17px;"><i class="fab fa-free-code-camp"></i> Equipe de Desenvolvimento de Sistemas</p>
                <p class="fw-light lh-0 mb-0" style="font-size: 14px;"> Subsecretaria de Tecnologia da Informação - Prefeitura Municipal de Mesquita - RJ </p>
                <p class="fw-light lh-0 mb-0" style="font-size: 14px;"> Rua Arthur Oliveira Vecchi, 120 - Centro - Mesquita - RJ - CEP: 26553-080</p>
            </div>
        </footer>
        <div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaleventclickLabel">Confirmando requerimento, por favor aguarde.</h5>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            $("#modaleventclick").modal("show");
        });
    </script>
</body>

</html>