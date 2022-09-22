<?php
require 'php/template.php';
$title = 'Longo Corporation - Contact Us';
$description = 'This is the description';
$keywords = 'These are the keywords';
printHead($title, $description, $keywords);
printHeader();

if(isset($_POST['Name'])){


$comment = stripslashes(nl2br(trim($_POST['Message'])));

$name = trim($_POST['Name']);
$email = trim($_POST['Email']);
//$message = htmlspecialchars_decode(trim($_POST['Message']));
$phone = trim($_POST['Phone']);


$toJohn = "jseplak@gmail.com";
$toLongo = 'longocorporation@gmail.com';


$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: longocorporation.com<longocorporation@gmail.com>' . "\r\n" . 'Reply-To: longocorporation@gmail.com \r\n' . 'X-Mailer: PHP/' . phpversion();



$b = time() + 3600;
$timeSent = date("F j, Y g:i a", $b);

$body = "<br>";
$body .= "Below are the details of the message<br><br>";
$body .= "<div style='background-color:#c0c0c0;padding-left:15px;color: #555555;font-family: Arial,Tahoma,Verdana,sans-serif;padding:10px;border-radius:10px;box-shadow: 0 2px 2px #000000;'>";
$body .= "<span style='width:150px;font-weight:bold;color:#000000;display: inline-block;'>Sender name:</span>" . $name . "<br>";
$body .= "<span style='width:150px;font-weight:bold;color:#000000;display: inline-block;'>Sender Email: </span>" . $email . "<br>";
$body .= "<span style='width:150px;font-weight:bold;color:#000000;display: inline-block;'>Sender Phone Number: </span>" . $phone . "<br>";

$body .= "<span style='width: 150px; font-weight: bold; color: rgb(0, 0, 0); height: 150px;'>Message: </span><br>" . $comment . "<br><br>";
$body .= "</div>";

//print $body;
if (!$comment == '') {

mail($toJohn, 'Message from Your website', $body, $headers);
mail($toLongo,'Message From Your Website', $body, $headers);
$messageSent = TRUE;
}




}


?>  

<!--==============================content================================-->
<section id="content">
    <div class="container_12">	
        <div class="grid_12">
            <div class="pad-0 border-1">
                <h2 class="top-1 p0">Contact Us</h2>
                <p class="p2">Do you have a question or comment? Feel free to give us a call, or fill in the form below to send us an email. We will get back to you as soon as possible.  </p>
            </div>
            <?php
             if(isset($messageSent)){
                 print '<h2 class="messageSent">Your Message has been sent.  You will recieve a response back shortly</h2>';
             }
            ?>
            <div class="wrap pad-3">
                <div class="block-5">
                    
                    <dl>
                        <!--<dt>8901 Marmora Road,<br>Glasgow, D04 89GR.</dt>
                        <dd><span>Freephone: </span>+1 555 555 5555</dd>-->
                        <dd><span>Telephone: </span>708-214-9975</dd>
                        <dd><span>E-mail: </span><a href="#" class="link">longocorporation@gmail.com</a></dd>
                    </dl> 
                </div>
                <div class="block-6">
                    <h3>Send a Message</h3>
                    <form id="form" name="form" method="post" action="contact.php" >
                        <fieldset>
                            <label><input type="text" value="Name" name="Name" onBlur="if(this.value=='') this.value='Name'" onFocus="if(this.value =='Name' ) this.value=''"></label>
                            <label><input type="text" value="Email" name="Email" onBlur="if(this.value=='') this.value='Email'" onFocus="if(this.value =='Email' ) this.value=''"></label>
                            <label><input type="text" value="Phone" name="Phone" onBlur="if(this.value=='') this.value='Phone'" onFocus="if(this.value =='Phone' ) this.value=''"></label>
                            <label><textarea name="Message" onBlur="if(this.value==''){this.value='Message'}" onFocus="if(this.value=='Message'){this.value=''}">Message</textarea></label>
                            <div class="btns"><a href="#" class="button">Clear</a><a href="#" class="button" onClick="document.getElementById('form').submit()">Send</a></div>
                        </fieldset>  
                    </form> 
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</section> 
<?php printFooter(); ?>