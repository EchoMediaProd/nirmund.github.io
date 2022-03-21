<?php

$response = array("status" => "ERROR", "toast" => "", "data" => "");
extract($_POST);
if(filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

    $mail_subject = "Nirmund - New Contact Mail";
    $mail_to = 'anup@nirmund.org'; // anup@nirmund.org RECEIPENT_EMAIL_ADDRESS
    
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Nirmund<info@nirmund.xyz>\r\n"; // FROM_ADDRESSS
    $headers .= "X-Sender: <http://nirmund.xyz> \n"; // WEBSITE URL
    
    $mailBody = '
    <html>
    <head>
    <title>Contact email from Nirmund</title>
    </head>
        <body>
            <div style="background:#868686;padding:32px 0px;margin:0px">                
                <div style="max-width:600px;margin:auto;font-family:Arial,sans-serif">                    
                    <div style="margin-bottom:16px;color:#000;font-size:16px;overflow:hidden;border:1px solid rgba(33,61,101,0.38);border-radius:3px">                       
                        <div style="background:#bababa;text-align:center;padding:16px 0">
                            <div>
                            </div><img src="https://creativeshell.com/nirmund/images/logo-main.png" alt="Logo" style="vertical-align:middle">
                        </div>
                        <div style="background:#fff;padding:16px 32px">
                            <p style="margin:16px 0;line-height:1.3">
                                Contact Information:
                                <hr>
                                <br>                          
                                <br>First name: '.$first_name.'                         
                                <br>Last name: '.$last_name.'
                                <br>Phone no.: '.$user_mobile.'
                                <br>Email address: '.$user_email.'
                                <br>Message: '.$user_query.'
                                <br>
                                <br>
                                <hr>                          
                            </p>                            
                        </div>                        
                    </div>                    
                </div>                
            </div>
        </body>
    </html>';
    $sendMail = @mail($mail_to,$mail_subject,$mailBody,$headers);

    if($sendMail) {
        $response["status"] = "SUCCESS";      
        $response["toast"] = "<p class='alert alert-success'> Your query has been submitted successfully. We shall get back to you soon. Please check SPAM mail.</p>";
    } else {      
        $response["toast"] = "<p class='alert alert-danger'> Ooops! Unable to submit your query right now.</p>";
    }
}
else {    
    $response["toast"] = "<p class='alert alert-danger'> Ooops! Invalid inputs. </p>";
}

echo json_encode($response);  
exit;

?>