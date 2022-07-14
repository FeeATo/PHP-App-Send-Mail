<?php   

    require "./bibliotecas/PHPMailer/Exception.php";
    require "./bibliotecas/PHPMailer/OAuth.php";
    require "./bibliotecas/PHPMailer/PHPMailer.php";
    require "./bibliotecas/PHPMailer/POP3.php";
    require "./bibliotecas/PHPMailer/SMTP.php";

    //configurando namespaces -> importando as classes PHPMailer e Exception
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = array('código_status' => null, 'descricao_status' => '');

        public function __construct($para, $assunto, $mensagem){
            $this->para = $para;
            $this->assunto = $assunto;
            $this->mensagem = $mensagem;
        }
        
        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function mensagemValida(){
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }

            return true;
        }

        
    }

    $mensagem = new Mensagem($_POST['para'], $_POST['assunto'], $_POST['mensagem']);
    
    if(!$mensagem->mensagemValida()){
        echo 'Mensagem inválida';
        header('Location:index.php?erro=campos_vazios');
    } 

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '';    // <- colocar email de teste aqui                //SMTP username
        $mail->Password   = '';    // <- colocar senha de teste aqui                      //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('tests_miguelalotateles@outlook.com', 'Remetente');
        $mail->addAddress($mensagem->__get('para'));  //-> adiciona um destinatário. Pode colocar quantos métodos addAdress quiser   //Add a recipient
        //$mail->addAddress('webcompleto2@gmail.com', 'Destinatário');
        //$mail->addReplyTo('info@example.com', 'Information'); //caso o destinatário responda, enviar a resposta para outro remetente
        //$mail->addCC('cc@example.com'); //adiciona destnatário de cópia
        //$mail->addBCC('bcc@example.com'); //adiciona destinatário de cópia oculto
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject =  $mensagem->__get('assunto');
        $mail->Body    = $mensagem->__get('mensagem');
        $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo desta mensagem';

        $mail->send();

        $mensagem->status['codigo_status'] = 1;
        $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';
        
    } catch (Exception $e) {

        $mensagem->status['codigo_status'] = 2;
        $mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. <br> Detalhes do erro: <span class="text-danger">' . $mail->ErrorInfo . '</span>';
        
    }

?>

<html>
    <head>
        <meta charset="utf-8" />
    	<title>App Mail Send</title>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

            <div class="row">
                <div class="col-md-12">

                    <? if($mensagem->status['codigo_status'] == 1) { ?>

                        <div class="container">
                            <h1 class="display-4 text-success">Sucesso</h1>
                            <p><?= $mensagem->status['descricao_status'] ?></p>
                            <a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
                        </div>

                    <? } ?>

                    <? if($mensagem->status['codigo_status'] == 2) { ?>

                        <div class="container">
                            <h1 class="display-4 text-danger">Ops!</h1>
                            <p><?= $mensagem->status['descricao_status'] ?></p>
                            <a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>
                        </div>

                    <? } ?>



                </div>
            </div>
        </div>
    </body>
</html>