<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../Models/MailService.php";
require_once __DIR__ . "/../Models/Message.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class MessagesController{
    //ajouer un message à la base de données
    public function ajouterMessage(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error=[];
            if(!isset($_POST['nom']) || empty($_POST['nom'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un nom d'expediteur !"
                ];
                header("Location:index.php?page=contact");
            }
            if(!isset($_POST['email']) || empty($_POST['email'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un email d'expediteur !"
                ];
                header("Location:index.php?page=contact");
            }
            if(!isset($_POST['objet']) || empty($_POST['objet'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un objet de message!"
                ];
                header("Location:index.php?page=contact");
            }
            if(!isset($_POST['message']) || empty($_POST['message'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un message !"
                ];
                header("Location:index.php?page=contact");
            }
            // recuperation d'un message
            $message = new Message();
            $message->setNom(htmlspecialchars(strip_tags($_POST['nom'])));
            $message->setEmail(htmlspecialchars(strip_tags($_POST['email'])));
            $message->setObjet(htmlspecialchars(strip_tags($_POST['objet'])));
            $message->setMessage(htmlspecialchars(strip_tags($_POST['message'])));
            
            //ajout du message à la base de données
            if($message->newMessage($message->getNom(),$message->getEmail(),$message->getObjet(),$message->getMessage())){
                
                $mail= new PHPMailer();
                $mail->isSMTP();
                $mail->Host="smtp.gmail.com";
                $mail->SMTPAuth=true;
                $mail->Username=$message->getEmail();
                $mail->Password='nubq iewq xbsv rxop';
                $mail->SMTPSecure='tls';
                $mail->Port=587;
                
                $mail->setFrom($message->getEmail(),"Messages de contact");
                $mail->addAddress("arsenetekeu@gmail.com");
                $mail->isHTML(true);
                $mail->Subject=$message->getObjet();
                $mail->Body=$message->getMessage();
                if(!$mail->send()){
                    
                    $_SESSION['alert']=[
                        "type"=>"error",
                        "msg"=>"mail non envoyer !"
                    ];
                }else{
                    echo "arrive ici";
                    $_SESSION['alert']=[
                        "type"=>"success",
                        "msg"=>"mail envoyer !"
                    ];
                    $error[]=" mail envoyer !";
                   header("Location:views/contact.php");
                }
                
            }else{
                echo "arrive ici faux";
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"message non ajoter et mail non envoyer !"
                ];
                header("Location:index.php?page=contact");
            }
        }else{
            $_SESSION['alert']=[
                "type"=>"error",
                "msg"=>"methode d'envoie incorecte !"
            ];
            header("Location:index.php?page=accueil");
        }
    }


    // afficher la liste des messages
    public function afficherMessages(){
        $message = new Message();
        $messages = $message->getMessages();
        require __DIR__."/../views/admin/messages.php";
    }
    // afficher le message de l'id
    public function afficherMessage($id){
        $message = new Message(); 
        $message = $message->getMessageById($id);
        require __DIR__ . "/../views/admin/repondreMail.php";
    }

    //reponse aux mails par id
    public function repondreMessage($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isset($_POST['id']) || empty($_POST['id'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un id de message !"
                ];
                header("Location:index.php?page=contact/message");
            }
            if(!isset($_POST['email1']) || empty($_POST['email1'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un email d'expediteur !"
                ];
                header("Location:index.php?page=contact/message");
            }
            if(!isset($_POST['email']) || empty($_POST['email'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un email de destinateur !"
                ];
                header("Location:index.php?page=contact/message");
            }
            if(!isset($_POST['objet']) || empty($_POST['objet'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un objet de message!"
                ];
                header("Location:index.php?page=contact/message");
            }
            if(!isset($_POST['message']) || empty($_POST['message'])){
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"vous devez indiquez un message !"
                ];
                header("Location:index.php?page=contact/message");
            }
                $message = new Message();
                $message->setEmail(htmlspecialchars(strip_tags($_POST['email'])));
                $message->setObjet(htmlspecialchars(strip_tags($_POST['objet'])));
                $message->setMessage(htmlspecialchars(strip_tags($_POST['message'])));
                $email1=htmlspecialchars(strip_tags($_POST['email1']));
                $id=htmlspecialchars(strip_tags($_POST['id']));
            if($message->repondreMessages($id)){
                
                //envoie du mail
                $mail= new PHPMailer();
                $mail->isSMTP();
                $mail->Host="smtp.gmail.com";
                $mail->SMTPAuth=true;
                $mail->Username=$email1;
                $mail->Password='nubq iewq xbsv rxop';
                $mail->SMTPSecure='tls';
                $mail->Port=587;
                $mail->setFrom($email1,"systeme d'administration de ltsa");
                $mail->addAddress($message->getEmail());
                $mail->isHTML(true);
                $mail->Subject=$message->getObjet();
                $mail->Body=$message->getMessage();
                if(!$mail->send()){
                    
                    $_SESSION['alert']=[
                        "type"=>"success",
                        "msg"=>"mail envoyer !"
                    ];
                    header("Location:index.php?page=contact/message");
                    
                }else{
                    $_SESSION['alert']=[
                        "type"=>"error",
                        "msg"=>"mail non envoyer !"
                    ];
                    header("Location:index.php?page=contact/message");
                }
            }else{
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"methode d'envoie incorrecte !"
                ];
                header("Location:index.php?page=contact/message");
            }
        }
    }





}





?>