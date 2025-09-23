<?php
// CONFIGURAÇÃO DO DESTINO
$destinatario = "guilhermepomacercena@gmail.com"; // <-- coloca teu e-mail aqui

// PEGA OS DADOS DO FORMULÁRIO
$nome     = $_POST['nome'] ?? '';
$email    = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$assunto  = $_POST['assunto'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

// MONTA O CORPO DO EMAIL
$assuntoEmail = "Contato do site - $assunto";
$corpo = "
Nova mensagem recebida no site Mercado Solidário:

Nome: $nome
E-mail: $email
Telefone: $telefone
Assunto: $assunto

Mensagem:
$mensagem
";

$cabecalhos  = "From: $nome <$email>\r\n";
$cabecalhos .= "Reply-To: $email\r\n";
$cabecalhos .= "X-Mailer: PHP/" . phpversion();

// ENVIA
if (mail($destinatario, $assuntoEmail, $corpo, $cabecalhos)) {
    echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='contato.html';</script>";
} else {
    echo "<script>alert('Erro ao enviar mensagem.'); window.location.href='contato.html';</script>";
}
?>