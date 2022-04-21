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
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card bg-light text-dark">
                    <form method="post" enctype="multipart/form-data" action="{{ route('guardar') }}">
                    @csrf
                        <div class="card-header">
                            <h5 class="text-center fw-light p-1 m-0">Requerimento de Perícia Médica</h5>
                        </div>
                        <div class="card-body">
                            @if(session()->get('error'))
                            <div class="alert alert-danger m-0">
                                <h5 class="alert-heading">Erro ao criar requerimento.</h5>
                                {{ session()->get('error') }}
                            </div><br/>
                            @endif
                            <div class="row mb-3 justify-content-between">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label fw-normal" for="nomeCompleto">Nome Completo:</label>
                                    <input required class="form-control" name="nome" type="text" id="nomeCompleto" placeholder="Nome Completo do Servidor" maxlength="96">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label fw-normal" for="matricula">Matrícula (6 dígitos):</label>
                                    <input required class="form-control" id="matricula" name="matricula" type="text" placeholder="000.000" pattern=".{7,}" maxlength="7">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-between">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label fw-normal" for="lotacao">Local de Lotação:</label>
                                    <select required class="form-select" name="local_lotacao" id="lotacao">
                                        <option value="" selected>Selecione a Unidade Organizacional</option>
                                        <option value="Arquivo Público Municipal">Arquivo Público Municipal</option>
                                        <option value="Comissão Permanente de Licitação">Comissão Permanente de Licitação</option>
                                        <option value="Conselho Municipal de Assistência Social">Conselho Municipal de Assistência Social</option>
                                        <option value="Conselho Tutelar">Conselho Tutelar</option>
                                        <option value="Controladoria Geral do Município">Controladoria Geral do Município</option>
                                        <option value="Coordenadoria de Comunicação Social">Coordenadoria de Comunicação Social</option>
                                        <option value="Coordenadoria de Ordem Pública">Coordenadoria de Ordem Pública</option>
                                        <option value="Coordenadoria de Políticas para Mulheres">Coordenadoria de Políticas para Mulheres</option>
                                        <option value="Departamento de Compras">Departamento de Compras</option>
                                        <option value="Departamento de Contabilidade">Departamento de Contabilidade</option>
                                        <option value="Departamento de Cultura">Departamento de Cultura</option>
                                        <option value="Departamento de Defesa Civil">Departamento de Defesa Civil</option>
                                        <option value="Departamento de Dívida Ativa">Departamento de Dívida Ativa</option>
                                        <option value="Departamento de Material e Patrimônio">Departamento de Material e Patrimônio</option>
                                        <option value="Departamento de Orçamento e Finanças">Departamento de Orçamento e Finanças</option>
                                        <option value="Departamento de Pagamento">Departamento de Pagamento</option>
                                        <option value="Departamento de Planejamento e Análise Econômica">Departamento de Planejamento e Análise Econômica</option>
                                        <option value="Departamento de Projetos">Departamento de Projetos</option>
                                        <option value="Departamento de Recursos Humanos">Departamento de Recursos Humanos</option>
                                        <option value="Departamento de Serviços Públicos">Departamento de Serviços Públicos</option>
                                        <option value="Departamento de Trânsito">Departamento de Trânsito</option>
                                        <option value="Gabinete do Prefeito">Gabinete do Prefeito</option>
                                        <option value="Gabinete do Secretário de Governança">Gabinete do Secretário de Governança</option>
                                        <option value="Gabinete do Secretário de Infraestrutura, Mobilidade e Serviços Públicos">Gabinete do Secretário de Infraestrutura, Mobilidade e Serviços Públicos</option>
                                        <option value="Gabinete do Subsecretário de Obras">Gabinete do Subsecretário de Obras</option>
                                        <option value="Gabinete do Subsecretário de Trabalho, Desenvolvimento Econômico">Gabinete do Subsecretário de Trabalho, Desenvolvimento Econômico</option>
                                        <option value="Gabinete do Vice-Prefeito">Gabinete do Vice-Prefeito</option>
                                        <option value="Guarda Civil Municipal">Guarda Civil Municipal</option>
                                        <option value="Junta de Alistamento Militar">Junta de Alistamento Militar</option>
                                        <option value="PROCON - Órgão Municipal de Proteção, Orientação e Defesa do Consumidor">PROCON - Órgão Municipal de Proteção, Orientação e Defesa do Consumidor</option>
                                        <option value="Procuradoria Geral">Procuradoria Geral</option>
                                        <option value="Secretaria Municipal de Educação">Secretaria Municipal de Educação</option>
                                        <option value="Secretaria Municipal de Saúde">Secretaria Municipal de Saúde</option>
                                        <option value="Setor de Meio Ambiente">Setor de Meio Ambiente</option>
                                        <option value="Setor de Protocolo Geral">Setor de Protocolo Geral</option>
                                        <option value="Setor de Urbanismo">Setor de Urbanismo</option>
                                        <option value="Subsecretaria de Fazenda">Subsecretaria de Fazenda</option>
                                        <option value="Subsecretaria de Tecnologia da Informação">Subsecretaria de Tecnologia da Informação</option>
                                        <option value="Subsecretaria Municipal de Administração">Subsecretaria Municipal de Administração</option>
                                        <option value="Subsecretaria Municipal de Assistência Social">Subsecretaria Municipal de Assistência Social</option>
                                        <option value="Subsecretaria Municipal de Planejamento Estratégico e Gestão">Subsecretaria Municipal de Planejamento Estratégico e Gestão</option>
                                        <option value="Superintendência de Arrecadação Mercantil e Fiscalização">Superintendência de Arrecadação Mercantil e Fiscalização</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label fw-normal" for="horarioTrabalho">Horário de Trabalho no Município:</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input required class="form-control timepicker" name="trabalho_inicio" id="trabalho-inicio" type="text" placeholder="Início do Expediente" autocomplete="horario" style="background-color:#fff;" pattern=".{5,}" maxlength="5">
                                        </div>
                                        <div class="col-lg-6 mt-2 mt-lg-0">
                                            <input required class="form-control timepicker" name="trabalho_fim" id="trabalho-fim" type="text" placeholder="Fim do Expediente" autocomplete="horario" style="background-color:#fff;" pattern=".{5,}" maxlength="5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label fw-normal" for="data-inicio-atestado">Data Inicial do Atestado:</label>
                                    <input required class="form-control datepicker" name="dt_inicio_atestado" id="data-inicio-atestado" type="text" placeholder="dd/mm/aaaa" autocomplete="datainicial" style="background-color:#fff;" pattern=".{10,}" maxlength="10">
                                </div>
                                <div class="col-lg-6">
                                    <label for="email" class="form-label fw-normal">E-mail:</label>
                                    <input type="email" class="form-control" required="required" name="email" id="email" placeholder="E-mail para contato" maxlength="96">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label fw-normal">Imagem/Documento do Atestado Médico:
                                    <p style="font-size: 13px; color: red;" class="mb-0">* Certifique-se de que a foto/documento do atestado é legível.</p>
                                </label>
                                <p class="mb-2">
                                    <label for="documento_atestado">
                                        <a class="btn btn-primary text-light" type="button" role="button" aria-disabled="false">Adicionar Arquivo</a>
                                    </label>
                                    <input id="documento_atestado" class="form-control" name="documento_atestado[]" type="file" required multiple="multiple" style="visibility: hidden; position: absolute;" accept=".png, .jpg, .jpeg,image/*,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf">
                                </p>
                                <div id="erro-atestado" class="alert alert-danger mb-2" style="display: none;">
                                    <p class="m-0">Tipo de arquivo inválido, insira apenas imagem ou documento: <span id="atestado-invalido"></span></p>
                                </div>
                                <div id="erro-atestado-grande" class="alert alert-danger mb-2" style="display: none;">
                                    <p class="m-0">Arquivo ultrapassa o limite de tamanho permitido: <span id="atestado-grande"></span></p>
                                </div>
                                <p id="atestado-vermelho" style="font-size: 13px; color: red; display: none;" class="mb-2">* Atenção: Os arquivos destacados em vermelho não serão enviados.</p>
                                <p id="atestados-area">
                                    <span id="atestados-list">
                                        <span id="atestados-names"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <span>Possui outro vínculo, ou acumula matrícula em outro local?</span>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <div class="row">
                                            <div class="col-auto">
                                                <input class="form-check-input" type="radio" name="vinculo" id="nao" value="Não">
                                                <label class="form-check-label" for="nao">Não</label>
                                            </div>
                                            <div class="col-auto">
                                                <input required class="form-check-input" type="radio" name="vinculo" id="sim" value="Sim">
                                                <label class="form-check-label" for="sim">Sim</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3" style="display: none;" id="afastamento">
                                <label class="form-label fw-normal" for="documento_afastamento">Imagem/Documento do Comprovante de Afastamento:
                                    <p style="font-size: 13px; color: red;" class="mb-0">* Atenção: Caso o servidor possua outro vínculo ou acumule matrícula, incluir comprovante de afastamento.</p>
                                </label>
                                <p class="mb-2">
                                    <label for="documento_afastamento">
                                        <a class="btn btn-primary text-light" type="button" role="button" aria-disabled="false">Adicionar Arquivo</a>
                                    </label>
                                    <input id="documento_afastamento" class="form-control" name="documento_afastamento[]" type="file" multiple="multiple" style="visibility: hidden; position: absolute;" accept=".png, .jpg, .jpeg,image/*,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"> 
                                </p>
                                <div id="erro-afastamento" class="alert alert-danger mb-2" style="display: none;">
                                    <p class="m-0">Tipo de arquivo inválido, insira apenas imagem ou documento: <span id="afastamento-invalido"></span></p>
                                </div>
                                <div id="erro-afastamento-grande" class="alert alert-danger mb-2" style="display: none;">
                                    <p class="m-0">Arquivo ultrapassa o limite de tamanho permitido: <span id="afastamento-grande"></span></p>
                                </div>
                                <p id="afastamento-vermelho" style="font-size: 13px; color: red; display: none;" class="mb-2">* Atenção: Os arquivos destacados em vermelho não serão enviados.</p>
                                <p id="afastamentos-area">
                                    <span id="afastamentos-list">
                                        <span id="afastamentos-names"></span>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <input id="enviar" type="submit" class="btn btn-success" value="Enviar Requerimento">
                                </div>
                            </div>
                        </div>
                    </form>
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
    <div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleventclickLabel">Enviando requerimento, por favor aguarde.</h5>
            </div>
            <div class="modal-body">
                <center>
                    <div class="loader"></div>
                </center>
            </div>
          </div>
        </div>
    </div>
    {{-- Bootstrap Dependencies --}}
    <script src="{{ asset('js/bootstrap5.bundle.min.js') }}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- jQuery e jQueryUI Dependencies --}}
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- Datepicker e Timepicker --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        /* Datepicker Data Inicial do Atestado*/
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
        /* Timepicker Horário de Trabalho */
        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: '0',
            maxTime: '23:00',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>
    {{-- Condicional de Matrícula Acumulada --}}
    <script>
        const afastamentoDiv = document.querySelector('#afastamento');
        const afastamentoDoc = document.querySelector('#documento_afastamento');
        const vinculoSim = document.querySelector('#sim');
        const vinculoNao = document.querySelector('#nao');

        vinculoNao.addEventListener('click', () => {
            afastamentoDiv.style.display = "none";
            afastamentoDoc.removeAttribute('required');
            afastamentoDoc.value = "";
            let afastamentoSpans = document.querySelectorAll('#afastamentos-area > .file-block');
                for (let span of afastamentoSpans) {
                    span.remove();
            }
        })

        vinculoSim.addEventListener('click', () => {
            afastamentoDiv.style.display = "block"
            afastamentoDoc.setAttribute('required', 'required');
        })
    </script>
    {{-- Mask dos Inputs --}}
    <script src="{{ asset('js/vanillaMasker.min.js')}}"></script>
    {{-- Configurações do VMasker --}}
    <script>
        VMasker ($("#trabalho-inicio")).maskPattern("99:99");
        VMasker ($("#trabalho-fim")).maskPattern("99:99");
        VMasker ($("#data-inicio-atestado")).maskPattern("99/99/9999");
        VMasker ($("#matricula")).maskPattern("999.999");
    </script>
    {{-- Popup de carregamento após envio do formulário --}}
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            $("#modaleventclick").modal("show");
        });
    </script>
    {{-- Validação dos Inputs de Arquivo --}}
    <script>
        // Array com os tipos de arquivo aceitos.
        const fileTypes = ['image', 'png', 'jpg', 'jpeg', 'doc', 'docx', 'xml', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'pdf'];
        // Tamanho máximo de cada arquivo em bytes (1 MB = 1.000.000 bytes)
        const tamanhoMaximo = 10000000; // 10 MB

        // Input 1: Atestado Médico.
        const dtAtestado = new DataTransfer(); // Allows you to manipulate the files of the input file
        const atestadoInput = document.querySelector('#documento_atestado');
        const atestadosArea = document.querySelector('#atestados-area');
        const atestadoInvalido = document.querySelector('#atestado-invalido');
        const erroAtestado = document.querySelector('#erro-atestado');
        const atestadoVermelho = document.querySelector('#atestado-vermelho');
        const erroAtestadoGrande = document.querySelector('#erro-atestado-grande');
        const atestadoGrandeSpan = document.querySelector('#atestado-grande');

        atestadoInput.addEventListener('change', function(e) {
            // Limpa os nomes de arquivo do último input feito pelo usuário.
            let atestadosInvalidos = [];
            let verifyAtestados = null;
            atestadoInvalido.innerHTML = '';
            let atestadosGrandes = [];
            let atestadoGrande = null;
            atestadoGrandeSpan.innerHTML = '';

            // Nome do arquivo e botão de deletar.
            for(let i = 0; i < this.files.length; i++) {
                let fileBlock = document.createElement('span');
                fileBlock.classList.add('file-block');
                
                let fileName = document.createElement('span');
                fileName.classList.add('name');
                fileName.innerHTML = `${this.files.item(i).name}`;
                
                let fileDelete = document.createElement('span');
                fileDelete.classList.add('file-delete');
                fileDelete.innerHTML = '<span>X</span>';
                // Checa a validez do tipo do arquivo inserido.
                if (!fileTypes.some(el => this.files[i].type.includes(el))) {
                    // Caso exista um arquivo inválido, insere nome dos arquivos inválidos na array e atribui true para a presença de atestados inválidos.
                    atestadosInvalidos.push(this.files[i].name);
                    fileName.classList.add('text-danger');
                    fileDelete.classList.add('text-danger');
                    verifyAtestados = true;
                    atestadoVermelho.style.display = 'block';
                } else if (this.files[i].size > tamanhoMaximo) {
                    atestadosGrandes.push(this.files[i].name);
                    fileName.classList.add('text-danger');
                    fileDelete.classList.add('text-danger');
                    atestadoGrande = true;
                    atestadoVermelho.style.display = 'block';
                }

                fileBlock.append(fileDelete, fileName);
                atestadosArea.append(fileBlock);
            }

            // Checa a existência de atestados inválidos.
            if (atestadosInvalidos.length === 0) {
                // Caso todos os arquivos sejam válidos, esconde a mensagem de erro e atribui false para presença de atestados inválidos.
                erroAtestado.style.display = 'none';
                verifyAtestados = false;
            }

            // Checa a existência de atestados com tamanho maior que o permitido.
            if (atestadosGrandes.length === 0) {
                // Caso todos os arquivos sejam válidos, esconde a mensagem de erro e atribui false para presença de atestados inválidos.
                erroAtestadoGrande.style.display = 'none';
                atestadoGrande = false;
            }

            // Guarda os arquivos no objeto de DataTransfer.
            for (let file of this.files) {
                // Checa validez do tipo de arquivo antes de inserir.
                if (fileTypes.some(el => file.type.includes(el))) {
                    if (file.size < tamanhoMaximo) {
                        dtAtestado.items.add(file);
                    }
                }
            }

            // Checa o status de presença de arquivos inválidos.
            let i = 1; // Variável de controle da formatação.
            if (verifyAtestados) {
                // Caso existam arquivos inválidos, insere o nome de cada arquivo inválido no alerta de erro da view.
                for (let atestado of atestadosInvalidos) {
                    if (i < atestadosInvalidos.length) {
                        atestadoInvalido.append(`${atestado}, `);
                    } else {
                        atestadoInvalido.append(`${atestado}.`)
                    }
                    i++;
                }
                erroAtestado.style.display = 'block';
                this.value = '';
            }

            // Checa o status de presença de arquivos maiores que o tamanho máximo.
            let j = 1; // Variável de controle da formatação.
            if (atestadoGrande) {
                // Caso existam arquivos inválidos, insere o nome de cada arquivo inválido no alerta de erro da view.
                for (let atestado of atestadosGrandes) {
                    if (j < atestadosGrandes.length) {
                        atestadoGrandeSpan.append(`${atestado}, `);
                    } else {
                        atestadoGrandeSpan.append(`${atestado}.`)
                    }
                    j++;
                }
                erroAtestadoGrande.style.display = 'block';
                this.value = '';
            }

            // Atualiza os arquivos do input.
            atestadoInput.files = dtAtestado.files;
            // Atribui evento no botão de deletar arquivo.
            let deleteButtons = document.querySelectorAll('.file-delete');
            for (let button of deleteButtons) {
                button.addEventListener('click', function (e) {
                    let name = this.nextElementSibling.innerHTML;
                    // Remove o nome do arquivo da página.
                    this.parentElement.remove();
                    
                    for(let i = 0; i < dtAtestado.items.length; i++) {
                        if (name === dtAtestado.items[i].getAsFile().name) {
                            // Delete file on DataTransfer Object.
                            dtAtestado.items.remove(i);
                            continue;
                        }
                    }
                    atestadoInput.files = dtAtestado.files;
                });
            }
        });

        // Input 2: Comprovante de Afastamento.
        const dtAfastamento = new DataTransfer(); // Allows you to manipulate the files of the input file
        const afastamentoInput = document.querySelector('#documento_afastamento');
        const afastamentosArea = document.querySelector('#afastamentos-area');
        const afastamentoInvalido = document.querySelector('#afastamento-invalido');
        const erroAfastamento = document.querySelector('#erro-afastamento');
        const afastamentoVermelho = document.querySelector('#afastamento-vermelho');
        const erroAfastamentoGrande = document.querySelector('#erro-afastamento-grande');
        const afastamentoGrandeSpan = document.querySelector('#afastamento-grande');
        
        afastamentoInput.addEventListener('change', function(e) {
            // Limpa os nomes de arquivo do último input feito pelo usuário.
            let afastamentosInvalidos = [];
            let verifyAfastamentos = null;
            afastamentoInvalido.innerHTML = '';
            let afastamentosGrandes = [];
            let afastamentoGrande = null;
            afastamentoGrandeSpan.innerHTML = '';

            // Nome do arquivo e botão de deletar.
            for(let i = 0; i < this.files.length; i++) {
                let fileBlock = document.createElement('span');
                fileBlock.classList.add('file-block');
                
                let fileName = document.createElement('span');
                fileName.classList.add('name');
                fileName.innerHTML = `${this.files.item(i).name}`;
                
                let fileDelete = document.createElement('span');
                fileDelete.classList.add('file-delete');
                fileDelete.innerHTML = '<span>X</span>';
                // Checa a validez do tipo do arquivo inserido.
                if (!fileTypes.some(el => this.files[i].type.includes(el))) {
                    // Caso exista um arquivo inválido, insere nome dos arquivos inválidos na array e atribui true para a presença de atestados inválidos.
                    afastamentosInvalidos.push(this.files[i].name);
                    fileName.classList.add('text-danger');
                    fileDelete.classList.add('text-danger');
                    verifyAfastamentos = true;
                    afastamentoVermelho.style.display = 'block';
                } else if (this.files[i].size > tamanhoMaximo) {
                    afastamentosGrandes.push(this.files[i].name);
                    fileName.classList.add('text-danger');
                    fileDelete.classList.add('text-danger');
                    afastamentoGrande = true;
                    afastamentoVermelho.style.display = 'block';
                }

                fileBlock.append(fileDelete, fileName);
                afastamentosArea.append(fileBlock);
            }

            // Checa a existência de atestados inválidos.
            if (afastamentosInvalidos.length === 0) {
                // Caso todos os arquivos sejam válidos, esconde a mensagem de erro e atribui false para presença de atestados inválidos.
                erroAfastamento.style.display = 'none';
                verifyAfastamentos = false;
            }

            // Checa a existência de atestados com tamanho maior que o permitido.
            if (afastamentosGrandes.length === 0) {
                // Caso todos os arquivos sejam válidos, esconde a mensagem de erro e atribui false para presença de atestados inválidos.
                erroAfastamentoGrande.style.display = 'none';
                afastamentoGrande = false;
            }

            // Guarda os arquivos no objeto de DataTransfer.
            for (let file of this.files) {
                // Checa validez do tipo de arquivo antes de inserir.
                if (fileTypes.some(el => file.type.includes(el))) {
                    if (file.size < tamanhoMaximo) {
                        dtAfastamento.items.add(file);
                    }
                }
            }

            // Checa o status de presença de arquivos inválidos.
            let i = 1; // Variável de controle da formatação.
            if (verifyAfastamentos) {
                // Caso existam arquivos inválidos, insere o nome de cada arquivo inválido no alerta de erro da view.
                for (let afastamento of afastamentosInvalidos) {
                    if (i < afastamentosInvalidos.length) {
                        afastamentoInvalido.append(`${afastamento}, `);
                    } else {
                        afastamentoInvalido.append(`${afastamento}.`)
                    }
                    i++;
                }
                erroAfastamento.style.display = 'block';
                this.value = '';
            }

            // Checa o status de presença de arquivos maiores que o tamanho máximo.
            let j = 1; // Variável de controle da formatação.
            if (afastamentoGrande) {
                // Caso existam arquivos inválidos, insere o nome de cada arquivo inválido no alerta de erro da view.
                for (let afastamento of afastamentosGrandes) {
                    if (j < afastamentosGrandes.length) {
                        afastamentoGrandeSpan.append(`${afastamento}, `);
                    } else {
                        afastamentoGrandeSpan.append(`${afastamento}.`)
                    }
                    j++;
                }
                erroAfastamentoGrande.style.display = 'block';
                this.value = '';
            }

            // Atualiza os arquivos do input.
            afastamentoInput.files = dtAfastamento.files;
            // Atribui evento no botão de deletar arquivo.
            let deleteButtons = document.querySelectorAll('.file-delete');
            for (let button of deleteButtons) {
                button.addEventListener('click', function (e) {
                    let name = this.nextElementSibling.innerHTML;
                    // Remove o nome do arquivo da página.
                    this.parentElement.remove();
                    
                    for(let i = 0; i < dtAfastamento.items.length; i++) {
                        if (name === dtAfastamento.items[i].getAsFile().name) {
                            // Delete file on DataTransfer Object.
                            dtAfastamento.items.remove(i);
                            continue;
                        }
                    }
                    afastamentoInput.files = dtAfastamento.files;
                });
            }
        });
    </script>
</body>

</html>