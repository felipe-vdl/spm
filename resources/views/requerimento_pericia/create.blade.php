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
                    <form method="post" enctype="multipart/form-data" action="{{ route('requerimento_pericias.store') }}">
                    @csrf
                        <div class="card-header">
                                <h5 class="text-center fw-light p-1 m-0">Requerimento de Perícia Médica</h5>
                        </div>
                        <div class="card-body">
                            @if(session()->get('success'))
                            <div class="alert alert-success m-0">
                                <h5 class="alert-heading">Requerimento registrado com sucesso.</h5>
                                {{ session()->get('success') }}
                                <hr class="my-2">
                                <p class="mb-0">A resposta com o agendamento poderá se dar em até 48 horas úteis da solicitação.</p>
                            </div><br />
                            @endif
                            @if(session()->get('error'))
                            <div class="alert alert-danger m-0">
                                <h5 class="alert-heading">Erro ao criar requerimento.</h5>
                                {{ session()->get('error') }}
                            </div><br />
                            @endif
                            <div class="row mb-3 justify-content-between">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-normal" for="nomeCompleto">Nome Completo:</label>
                                    <input required class="form-control" name="nome" type="text" id="nomeCompleto" placeholder="Nome Completo do Servidor">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-normal" for="matricula">Matrícula:</label>
                                    <input required class="form-control" id="matricula" name="matricula" type="text" placeholder="Matrícula do Servidor">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-between">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-normal" for="lotacao">Local de Lotação:</label>
                                    <select required class="form-select" name="local_lotacao" id="lotacao">
                                        <option value="" selected>-- Unidade Organizacional --</option>
                                        <option value="Secretaria de Tecnologia da Informação">Secretaria de Tecnologia da Informação</option>
                                        <option value="Secretaria de Administração">Secretaria de Administração</option>
                                        <option value="Secretaria de Governança">Secretaria de Governança</option>
                                        <option value="Departamento de Perícias Médicas">Departamento de Perícias Médicas</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-normal" for="horarioTrabalho">Horário de Trabalho no Município:</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input required class="form-control timepicker" name="trabalho_inicio" id="horarioTrabalho" type="text" placeholder="Início do Expediente" autocomplete="horario" style="background-color:#fff;">
                                        </div>
                                        <div class="col-md-6 mt-2 mt-md-0">
                                            <input required class="form-control timepicker" name="trabalho_fim" id="horarioTrabalho" type="text" placeholder="Fim do Expediente" autocomplete="horario" style="background-color:#fff;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-normal" for="dataInicioAtestado">Data Inicial do Atestado:</label>
                                    <input required class="form-control datepicker" name="dt_inicio_atestado" id="dataInicioAtestado" type="text" placeholder="dd/mm/aaaa" autocomplete="datainicial" style="background-color:#fff;">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-normal">E-mail:</label>
                                    <input type="email" class="form-control" required="required" name="email" id="email" placeholder="E-mail para contato">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label fw-normal" for="documento_atestado">Foto/Documento do Atestado Médico:
                                    <p style="font-size: 13px; color: red;" class="mb-0">* Certifique-se de que a foto/documento do atestado é legível.</p>
                                </label>
                                <input class="form-control" multiple="multiple" id="documento_atestado" name="documento_atestado[]" accept=".png, .jpg, .jpeg,image/*,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf" type="file" required> 
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <span>Possui outro vínculo, ou acumula matrícula em outro local?</span>
                                    </div>
                                    <div class="col-12 col-md-6 mt-1 mt-md-0">
                                        <div class="row justify-around">
                                        <div class="col-2">
                                            <input class="form-check-input" type="radio" name="vinculo" id="nao" value="Não">
                                            <label class="form-check-label" for="nao">Não</label>
                                        </div>
                                        <div class="col-2">
                                            <input required class="form-check-input" type="radio" name="vinculo" id="sim" value="Sim">
                                            <label class="form-check-label" for="sim">Sim</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3" style="display: none;" id="afastamento">
                                <label class="form-label fw-normal" for="documento_afastamento">Foto/Documento do Comprovante de Afastamento:
                                    <p style="font-size: 13px; color: red;" class="mb-0">* Atenção: Caso o servidor possua outro vínculo ou acumule matrícula, incluir comprovante de afastamento.</p>
                                </label>
                                <input class="form-control" multiple="multiple" id="documento_afastamento" name="documento_afastamento[]" accept=".png, .jpg, .jpeg,image/*,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf" type="file"> 
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <input type="submit" class="btn btn-success" value="Enviar Requerimento">
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>
        $('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior',
            maxDate: '0'
        });

        $('.timepicker').timepicker({
            timeFormat: 'H:mm',
            interval: 60,
            minTime: '0',
            maxTime: '23:00',
            startTime: '0:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>
    <script>
        const afastamentoDiv = document.querySelector('#afastamento');
        const afastamentoDoc = document.querySelector('#documento_afastamento');
        const vinculoSim = document.querySelector('#sim');
        const vinculoNao = document.querySelector('#nao');

        vinculoNao.addEventListener('click', () => {
            afastamentoDiv.style.display = "none";
            afastamentoDoc.removeAttribute('required');
            afastamentoDoc.value = "";
        })

        vinculoSim.addEventListener('click', () => {
            afastamentoDiv.style.display = "block"
            afastamentoDoc.setAttribute('required', 'required');
        })
    </script>
</body>

</html>