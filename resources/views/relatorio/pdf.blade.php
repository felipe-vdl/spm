<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Relatório</title>
<style type="text/css">
@page {
	margin: 0.5cm;
	margin-top: 50px; 
	margin-bottom: 110px;
}
body {
    font-family: sans-serif;
    font-size:15px;
	 margin: 2.5cm 0;
	 text-align: justify;
}
#header { 
	position: fixed; 
	top: -30px; 
	left: 0px; 
	right: 0px;  
	height: 50px; }
#footer {
	position: fixed;
	left: 0;
	right: 0;
	color: #000000;
	font-size: 0.9em;
}
#footer {
  bottom: -20px;
}
#header table {
}

table {
  font-family: arial, sans-serif;
  font-size: 12px;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 5px;
}
/* #footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
} */
#header td {
}
/* #footer td {
  padding: 0;
	width: 10%;
} */
.page-footer {
  text-align: center;
}
hr {
  page-break-after: always;
  border: 0;
}
/* table.separate {
  border-collapse: separate;
  border-spacing: 20pt;
  
} */
/* td{
    padding: 4px;
} */
.container{
	 justify-content: flex-start;
}
.semsopimagem {
  margin-top: 1cm;
  height: 260px !important;
  width: 260px !important;
}
.Imangemsemsop{
  margin: 0 auto !important;
}
.page-number {
  text-align: center;
}
.page-number:before {
  content: "Página " counter(page);
}
#watermark { position: fixed; bottom: 150px; width: 650px; height: 600px; opacity: .1; }
</style>
</head>

	<body>
    <header>
      <div id="watermark"><img src="{{ asset("img/lgo2.png") }}" height="120%" width="110%"></div>
      
      <div id="header">
        <table>
          <tr>
            <center><img src="{{ asset("img/logo.png") }}" height="250%" width="50%"/></center>
          </tr>
        </table>
      </div>
      <br>
      <h3 style="text-align:center;"><u>RELATÓRIO DE REQUERIMENTOS AGENDADOS</u></h3>
      <h3 style="text-align:center;"><u>{{$dataInt}}</u></h3>
    </header>

    <main>
      <div>
        <table style="width: 100%;">
          <tr>
            <th>Nº</th>
            <th>Nome</th>
            <th>Matrícula</th>
            <th>E-mail</th>
            <th>Direcionamento</th>
            <th>Protocolo</th>
            <th>Agendamento</th>
            <th>Presença</th>
          </tr>

          @foreach ($relatorio as $item)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$item->nome}}</td>
              <td>{{$item->matricula}}</td>
              <td>{{$item->email}}</td>
              <td>{{$item->direcionamento}}</td>
              <td>{{$item->protocolo}}</td>
              <td>
                {{substr(date('d/m/Y H:i', strtotime($item->data_agenda)), 0, 10).' às '.$item->hora_agenda.' horas'}}
                {{-- @if ($item->status == 4)
                  {{substr(date('d/m/Y H:i', strtotime($item->data_agenda)), 0, 10).' às '.$item->hora_agenda.' horas'}}
                @elseif($item->status == 1)
                  Recusado
                @endif   --}}
              
              </td>
              <td>
              @if ($item->presenca == 0)
              <a>Ausente</a>
              @elseif ($item->presenca == 1)
              <a>Presente</a>
              @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </main>
    <footer id="footer" class="page-footer"><div class="page-number"></div></footer>
	</body>
</html>
