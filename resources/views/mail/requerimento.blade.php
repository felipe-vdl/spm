
@if ($requerimento->status === 0)
<p>Olá {{ substr($requerimento->nome, 0, strpos($requerimento->nome, ' ')) }}, o seu requerimento foi criado com sucesso e será analisado pelo nosso departamento.</p>
<p>Aguarde a resposta com o seu agendamento (poderá se dar em até 48 horas úteis da sua solicitação), fique atento e por favor verifique a sua caixa de spam periodicamente.</p>
<p><b>Protocolo do seu requerimento:</b> {{ $requerimento->protocolo }}</p>

@elseif ($requerimento->status === 1)
<p>Olá {{ substr($requerimento->nome, 0, strpos($requerimento->nome, ' ')) }}, o seu requerimento foi recusado após a análise.</p>
        @if ($requerimento->motivo_recusa == "Documento Ilegível")
        <ul>
            <li><b>Motivo de Recusa:</b> {{ $requerimento->motivo_recusa }}</li>
            <li><b>Este é o protocolo do seu requerimento:</b> {{ $requerimento->protocolo }}</li>
        </ul>
        <p>Por favor, faça um novo requerimento e certifique-se de que os documentos inseridos estão legíveis.</p>
        @elseif ($requerimento->motivo_recusa == "Prazo Expirado")
            <ul>
                <li><b>Motivo de Recusa:</b> {{ $requerimento->motivo_recusa }}</li>
                <li><b>Este é o protocolo do seu requerimento:</b> {{ $requerimento->protocolo }}</li>
            </ul>
            <p>O servidor interessado deve soliticar o agendamento no prazo de 2 (dois) dias úteis.</p>
        @else
            <ul>
                <li><b>Motivo de Recusa:</b> {{$requerimento->motivo_recusa}}</li>
                <li><b>Este é o protocolo do seu requerimento:</b> {{$requerimento->protocolo}}</li>
            </ul>
        @endif

@else
<p>Olá {{ substr($requerimento->nome, 0, strpos($requerimento->nome, ' ')) }}, o seu requerimento foi agendado com sucesso.</p>

<p>Por favor, confirme o recebimento deste e-mail inserindo o seu protocolo em nossa <a target="_blank" rel="noopener noreferrer" href="https://periciamedica.mesquita.rj.gov.br/confirmar">página de confirmação</a>, e siga as demais instruções deste e-mail.</p>


<b>Página de Confirmação:</b> https://periciamedica.mesquita.rj.gov.br/confirmar

<h3 style="margin-bottom: 5px;">Requerimento</h3>
<ul style="margin-top: 0;">
    <li><b>Protocolo do seu requerimento:</b> {{ $requerimento->protocolo }}</li>
    @if($requerimento->observacao)
    <li><b>Observação do avaliador:</b> {{ $requerimento->observacao }}
    @endif
    <li><b>Direcionamento:</b> {{ $requerimento->direcionamento }}</li>
    <li><b>Data/Hora agendada:</b> {{ date('d/m/Y', strtotime($requerimento->data_agenda)) }} às {{ $requerimento->hora_agenda }} horas.</li>
    <li><b>Endereço:</b> Subsecretaria de Administração (segundo andar) — Prefeitura Municipal de Mesquita.
        <ul>
            <li>
                Rua Arthur Oliveira Vechi, 120 - Centro, Mesquita - RJ
            </li>
        </ul>
    </li>
</ul>

<p>* Atenção: Para confirmar a presença no dia e horário agendado o servidor precisa confirmar o recebimento deste e-mail, inserindo o protocolo do agendamento em nossa <a target="_blank" rel="noopener noreferrer" href="https://periciamedica.mesquita.rj.gov.br/confirmar">página de confirmação</a>.</p>

<p>I - No dia e no horário agendado o servidor deverá estar munido do atestado do médico assistente ou odontológico original, contendo informações que constatem a incapacidade laborativa do servidor, conforme preconiza a resolução do Conselho Federal de Medicina nº 1851/2008 (D.O.U. 18/08/2008);</p>

<p>II - Trazer laudos e exames complementares;</p>

<p>III - Prescrição médica que comprovem tratamento medicamentoso e, caso o servidor tenha acompanhamento fisioterápico, fonoaudiólogo, psicoterápico comprovando a regularidade e o tratamento do servidor;</p>

<p>IV - Caso necessário a prorrogação da licença médica, o servidor terá que trazer nova documentação médica que fundamente a decisão pericial, cabendo ao perito a deliberação técnica acerca da renovação da licença ou readaptação.</p>
@endif