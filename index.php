<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Teste Xmroot</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src='main.js'></script>
</head>
<body>
<div class="container mt-5">
  <form id="enviar_mensagem_form" class="mb-4">
    <div id="mensagem_espera" class="alert alert-warning" style="display: none;"></div>

    <div class="form-group">
      <label for="token">Token do Bot:</label>
      <input type="text" class="form-control" name="token" id="token" required>
    </div>

    <div class="form-group">
      <label for="id_telegram">ID do Telegram:</label>
      <input type="text" class="form-control" name="id_telegram" id="id_telegram" required>
    </div>

    <div class="form-group">
      <label for="mensagem">Mensagem:</label>
      <select class="form-control" name="mensagem" id="mensagem">
        <option value="Olá, tudo bem?">Olá, tudo bem?</option>
        <option value="Estou com fome!">Estou com fome!</option>
        <option value="Fui desenvolvido pelo Xmroot!">Fui desenvolvido pelo Xmroot!</option>
      </select>
    </div>

    <button type="button" class="btn btn-primary" onclick="enviarMensagem()">Enviar Mensagem</button>
  </form>

  <div id="resultado"></div>
</div>

<script>
var podeEnviarMensagem = true;

function contarTempo(tempo) {
  if (tempo > 0) {
    document.getElementById('mensagem_espera').style.display = 'block';
    document.getElementById('mensagem_espera').innerHTML = "Aguarde " + tempo + " segundo" + (tempo > 1 ? "s" : "");
    setTimeout(function() {
      contarTempo(tempo - 1);
    }, 1000); // Aguarda 1 segundo antes de chamar a função novamente
  } else {
    document.getElementById('mensagem_espera').style.display = 'none';
    podeEnviarMensagem = true;
  }
}

function enviarMensagem() {
  if (!podeEnviarMensagem) {
    return;
  }

  podeEnviarMensagem = false;
  var formData = new FormData(document.getElementById('enviar_mensagem_form'));

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'enviar_mensagem.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        document.getElementById('resultado').innerHTML = "<div class='alert alert-success'>Mensagem enviada com sucesso!</div>";
        contarTempo(5); // Inicia a contagem regressiva de 5 segundos
      } else {
        document.getElementById('resultado').innerHTML = "<div class='alert alert-danger'>Erro ao enviar a mensagem. O OpenSource não tem culpa dessa vez, pode ter sido azar mesmo!</div>";
      }
    }
  };
  xhr.send(formData);
}
</script>

</body>
</html>