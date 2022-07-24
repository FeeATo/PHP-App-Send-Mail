# App Send Mail

Projeto de uma aplicação que envia e-mails com o destinatário, assunto e corpo do texto que desejar. Utilizando a biblioteca PHPMailer e linguagem PHP. Front-end com Bootstrap.

### Instruções 

Para rodar esta aplicação PHP, é preciso colocar a pasta *app_send_email-protected-files* fora do diretório público do seu servidor HTTP (fora do htdocs do XAMPP, por exemplo) e colocar a pasta *app_send_email* no diretório público do seu servidor HTTP. Estando separados por apenas um nível. <br>
 **Isto é**: 
- *C:\\<seu_servidor_http>\\<seu_diretório_público>\\**app_send_email*** 
- *C:\\<seu_servidor_http>\\**app_send_email-protected-files***
            
Também é preciso colocar as credenciais de seu e-mail de teste em: *app_send_email-protected-files/processa_envio.php* nas linhas: <br> 59 (*$mail->Username = '**\<seu_email>**';*), 60 (*$mail->Password = '**\<sua_senha>**';*) e 65 (*$mail->setFrom('**\<seu_email>**', 'Remetente');*).

Por experiência própria, recomendo criar um e-mail de testes *hotmail*, pois a microsoft permite o login por aplicações não confiáveis. Atualmente o Google não permite mais o login por aplicações não confiáveis, não existe mais a opção para permitir este tipo de ação.

Você pode entrar em contato comigo em: "miguelteles2002@gmail.com", caso haja algum problema. 🙂

