// DONE - Estilização do span com nome do arquivo e delete;
        // DONE - Filtro de tipo de arquivo inválido: Exibir alerta com nome dos arquivos inválidos/destacar em vermelho o span dos arquivos inválidos, remover eles do objeto do DataTransfer e atualiza o input.
        // - Filtro de tamanho de arquivo: 10MB (10485760 bytes).
        // Array com os tipos de arquivo aceitos.
        const fileTypes = ['image', 'png', 'jpg', 'jpeg', 'doc', 'docx', 'xml', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'pdf'];

        // Input 1: Atestado Médico.
        const dtAtestado = new DataTransfer(); // Allows you to manipulate the files of the input file
        const atestadoInput = document.querySelector('#documento_atestado');
        const atestadosArea = document.querySelector('#atestados-area');
        const atestadoInvalido = document.querySelector('#atestado-invalido');
        const erroAtestado = document.querySelector('#erro-atestado');
        const atestadoVermelho = document.querySelector('#atestado-vermelho');

        atestadoInput.addEventListener('change', function(e) {
            let atestadosInvalidos = [];
            let verifyAtestados = null;
            atestadoInvalido.innerHTML = '';

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

            // Guarda os arquivos no objeto de DataTransfer.
            for (let file of this.files) {
                // Checa validez do tipo de arquivo antes de inserir.
                if (fileTypes.some(el => file.type.includes(el))) {
                    dtAtestado.items.add(file);
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

            // Atualizar os arquivos do input.
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

        afastamentoInput.addEventListener('change', function(e) {
            let afastamentosInvalidos = [];
            let verifyAfastamentos = null;
            afastamentoInvalido.innerHTML = '';

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

            // Guarda os arquivos no objeto de DataTransfer.
            for (let file of this.files) {
                // Checa validez do tipo de arquivo antes de inserir.
                if (fileTypes.some(el => file.type.includes(el))) {
                    dtAfastamento.items.add(file);
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

            // Atualizar os arquivos do input.
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