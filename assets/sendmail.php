<?php
session_start();

error_reporting(E_ERROR | E_PARSE);

header('Content-Type: text/plain; charset=utf-8');

$url = "../index.php";

$statusMsg = '';
$msgClass = 'errordiv';
$email = $_REQUEST['to'];
$name = "";
$fromEmail = $_REQUEST["from"];
$fromName = "";
$subject = $_REQUEST['title'];
$messages = $_REQUEST['message'];
$uploadedFile = "";

$headers = "From: $fromName"." <".$fromEmail.">"; 
$htmlContent = ' 
    <p>'. $messages .'</p> 
'; 

// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  

      if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
      {
         $statusMsg = 'Please enter your valid email.';
         header("location:{$url}?statusMsg={$statusMsg}");
         exit;
      }else{
               if($_FILES['attachment'])
               {
                  $file = $_FILES['attachment']['name'];
                  $targetFilePath = $_SERVER['DOCUMENT_ROOT'] . '/sendmail/assets/img/'.$file;
        
                  if (move_uploaded_file($_FILES['attachment']['tmp_name'], $targetFilePath)) {
                     $uploadedFile = $targetFilePath;
                  }

                  $message .= "--{$mime_boundary}\n"; 
                  $fp =    @fopen($file,"rb"); 
                  $data =  @fread($fp,filesize($file)); 
           
                  @fclose($fp); 
                  $data = chunk_split(base64_encode($data)); 
                  $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
                              "Content-Description: ".basename($file)."\n" . 
                              "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
                              "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
               }

               $message .= "--{$mime_boundary}--"; 
               $returnpath = "-f" . $from; 

               $send = @mail($email, $subject, $message, $headers, $returnpath);

            if($send)
            {
             $statusMsg = "Email sent successfully";
             header("location:{$url}?statusMsg={$statusMsg}");
             exit;

            }else{
             $statusMsg = 'Could not send email';
             header("location:{$url}?statusMsg={$statusMsg}");
             exit;
            }
      }
    
    header("location:{$url}?statusMsg={$statusMsg}");
    exit;
?>