<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $id_telegram = $_POST["id_telegram"];
    $mensagem = $_POST["mensagem"];

    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $data = array(
        "chat_id" => $id_telegram,
        "text" => $mensagem,
    );

    // Inicializa o manipulador cURL
    $ch = curl_init();

    // Configura as opções do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Executa a requisição
    $resultado = curl_exec($ch);

    // Fecha o manipulador cURL
    curl_close($ch);

    // Verifica o resultado da requisição
    if ($resultado) {
        echo "<span style='color: green;'>Mensagem enviada com sucesso!</span>";
    } else {
        echo "<span style='color: red;'>Erro ao enviar a mensagem. O OpenSource não tem culpa dessa vez, pode ter sido azar mesmo!</span>";
    }
}
?>
