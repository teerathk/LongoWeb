<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/3/2017
 * Time: 4:13 PM
 */

/*You got a new task at Longo Corporation. You can see this by loging into customer portal from <a href="'.$baseLoc.'">here</a>.*/

if (!isset($_SESSION)) {
   session_start();
}

$baseProto = isset($_SERVER['HTTPS']) ? "https://" : "http://";
$baseHost = $_SERVER['HTTP_HOST'];
$baseURI = $_SERVER['REQUEST_URI'];
$baseLoc = $baseProto . $baseHost;

$toJohn = "jseplak@gmail.com";
$toLongo = 'longocorporation@gmail.com';

$adminEmail = "Longo <$toLongo>";
//$adminEmail .= ", John <$toJohn>";
$adminEmail .= ", Plego <arazzak@plego.com>";
$adminEmail .= ", Mike Levigne <mlevigne25@gmail.com>";

$emailHeader = '<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Longo Corporation</title>
    <!-- Define Charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

    <style type="text/css">
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        p, h1, h2, h3, h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        html {
            width: 100%;
        }

        table {
            font-size: 14px;
            border: 0;
        }

        /* ----------- responsivity ----------- */
        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .header-bg {
                width: 440px !important;
                height: 10px !important;
            }

            .main-header {
                line-height: 28px !important;
            }

            .main-subheader {
                line-height: 28px !important;
            }

            .container-middle {
                width: 420px !important;
            }

            .mainContent {
                width: 400px !important;
            }

            .main-image {
                width: 400px !important;
                height: auto !important;
            }

            .banner {
                width: 400px !important;
                height: auto !important;
            }

            /*------ sections ---------*/
            .section-item {
                width: 400px !important;
            }

            .section-img {
                width: 400px !important;
                height: auto !important;
            }

            /*------- prefooter ------*/
            .prefooter-header {
                padding: 0 10px !important;
                line-height: 24px !important;
            }

            .prefooter-subheader {
                padding: 0 10px !important;
                line-height: 24px !important;
            }

            /*------- footer ------*/
            .top-bottom-bg {
                width: 420px !important;
                height: auto !important;
            }
        }

        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .header-bg {
                width: 280px !important;
                height: 10px !important;
            }

            .top-header-left {
                width: 260px !important;
                text-align: center !important;
            }

            .top-header-right {
                width: 260px !important;
            }

            .main-header {
                line-height: 28px !important;
                text-align: center !important;
            }

            .main-subheader {
                line-height: 28px !important;
                text-align: center !important;
            }

            /*------- header ----------*/
            .logo {
                width: 260px !important;
            }

            .nav {
                width: 260px !important;
            }

            .container {
                width: 397px !important;
            }

            .container-middle {
                width: 260px !important;
            }

            .mainContent {
                width: 240px !important;
            }

            .main-image {
                width: 240px !important;
                height: auto !important;
            }

            .banner {
                width: 240px !important;
                height: auto !important;
            }

            /*------ sections ---------*/
            .section-item {
                width: 240px !important;
            }

            .section-img {
                width: 240px !important;
                height: auto !important;
            }

            /*------- prefooter ------*/
            .prefooter-header {
                padding: 0 10px !important;
                line-height: 28px !important;
            }

            .prefooter-subheader {
                padding: 0 10px !important;
                line-height: 28px !important;
            }

            /*------- footer ------*/
            .top-bottom-bg {
                width: 260px !important;
                height: auto !important;
            }

            table.container-middle img {
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 384px) {
            .container {
                width: 367px !important;
            }

        }

        @media only screen and (max-width: 375px) {
            .container {
                width: 358px !important;
            }
        }

        @media only screen and (max-width: 320px) {
            .container {
                width: 303px !important;
            }
        }

        ::selection {
            background: #ff2f2f; /* WebKit/Blink Browsers */
        }

        ::-moz-selection {
            background: #ff2f2f; /* Gecko Browsers */
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            /* Tables
				parameters: width, alignment, padding */
            table[class=scale] {
                width: 100% !important;
            }

            table[class=scale-300] {
                width: 100% !important;
                height: 300px !important;
            }

            table[class=scale-90] {
                width: 90% !important;
            }

            /* Td */
            td[class=scale-left] {
                width: 100% !important;
                text-align: left !important;
            }

            td[class=scale-height] {
                height: 70px !important;
            }

            td[class=scale-left-bottom] {
                width: 100% !important;
                text-align: left !important;
                padding-bottom: 24px !important;
            }

            td[class=scale-left-top] {
                width: 100% !important;
                text-align: left !important;
                padding-top: 24px !important;
            }

            td[class=scale-left-all] {
                width: 100% !important;
                text-align: left !important;
                padding-top: 24px !important;
                padding-bottom: 24px !important;
            }

            td[class=scale-center] {
                width: 100% !important;
                text-align: center !important;
            }

            td[class=scale-center-both] {
                width: 100% !important;
                text-align: center !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            td[class=scale-center-bottom] {
                width: 100% !important;
                text-align: center !important;
                padding-bottom: 24px !important;
            }

            td[class=scale-center-top] {
                width: 100% !important;
                text-align: center !important;
                padding-top: 24px !important;
            }

            td[class=scale-center-all] {
                width: 100% !important;
                text-align: center !important;
                padding-top: 24px !important;
                padding-bottom: 24px !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            td[class=scale-right] {
                width: 100% !important;
                text-align: right !important;
            }

            td[class=scale-right-bottom] {
                width: 100% !important;
                text-align: right !important;
                padding-bottom: 24px !important;
            }

            td[class=scale-right-top] {
                width: 100% !important;
                text-align: right !important;
                padding-top: 24px !important;
            }

            td[class=scale-right-all] {
                width: 100% !important;
                text-align: right !important;
                padding-top: 24px !important;
                padding-bottom: 24px !important;
            }

            td[class=scale-center-bottom-both] {
                width: 100% !important;
                text-align: center !important;
                padding-bottom: 24px !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            td[class=scale-center-top-both] {
                width: 100% !important;
                text-align: center !important;
                padding-top: 24px !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            td[class=reset] {
                height: 0px !important;
            }

            td[class=scale-center-topextra] {
                width: 100% !important;
                text-align: center !important;
                padding-top: 84px !important;
            }

            img[class="reset"] {
                display: inline !important;
            }

            img[class="scale-inline"] {
                display: inline !important;
            }
        }
    </style>
</head>
<body style="margin-top: 0; margin-bottom: 0; background: #FFFFFF; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">

<!-- Header -->
<!---------   top header   ------------>
<table border="0" width="620" cellpadding="0" cellspacing="0" align="center" class="container">
    <tr>
        <td height="35" mc:edit="copy1">&nbsp;</td>
    </tr>
    <tr bgcolor="3598da">
        <td height="5"></td>
    </tr>

    <!--------- Header  ---------->
    <tr>
        <td>
            <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="container-middle">
                <tr>
                    <td>
                        <table border="0" align="center" cellpadding="0" cellspacing="0"
                               style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="nav">
                            <tr>
                                <td align="center"><a href="' . $baseLoc . '"><img src="' . $baseLoc . '/images/logoLongoCorp.jpg"></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- Intro -->
<table align="center" border="0" cellpadding="0" cellspacing="0" class="scale" data-thumb="#" width="100%" mc:variant="Intro8386" mc:repeatable="Intro8386">
    <tr>
        <td>
            <table width="620" align="center" border="0" cellpadding="0" cellspacing="0" class="scale"
                   style="background-color: #FFFFFF; color:#000000 !important;">
                <tr>
                    <td height="50" mc:edit="space">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center">';

$emailFooter = '</td>
                </tr>
                <tr>
                    <td height="50" valign="bottom">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="scale-90" width="550">
                            <tr>
                                <td height="1" style="background-color: #E8E8E8"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>';

include_once "db.php";

// Clean post/get
function cleanInput($value)
{
   $link = new db();
   $link = $link->connect();
   //if the variable is an array, recurse into it
   if (is_array($value)) {
      //for each element in the array...
      foreach ($value as $key => $val) {
         //...clean the content of each variable in the array
         $value[$key] = cleanInput($val);
      }

      //return clean array
      return $value;
   } else {
      $clData = mysqli_real_escape_string($link, strip_tags(trim($value)));

      return $clData;
   }
}

// Add job email template
function addJobEmailTempToLongo($data)
{
   global $baseLoc;
   global $emailHeader;
   global $emailFooter;
   $body = $emailHeader . '
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="scale-90" width="490">
                                <td align="left"
                                    style="font-family: \'source_sans_proregular\', Helvetica, Arial, sans-serif; text-align: left; font-size: 16px; color: #000; line-height: normal;"
                                    mc:edit="copy4">
                                        <p>A new Job has been added by "' . $data['customer']['name'] . '". Please log in the Admin Portal to view Customers Job Information</p><br>
                                        <p>Thank you</p>
                                        <p>Longo Construction Admin</p><br>
                                    </td>
                                </tr>
                            </table>';
   $body .= $emailFooter;
   return $body;
}

// send email to Longo and User on job add
function emailToLongoOnJobAdd($data)
{
   $userID = array('id' => $data['userID']);
   $cid = array('id' => $data['cid']);
   $db = new db();
   $userInfo = $db->from('cusers')->where($userID)->results();
   $db = new db();
   $customerInfo = $db->from('ccustomers')->where($cid)->results();

   $emailData = array();
   $emailData['job'] = $data;
   $emailData['user'] = $userInfo[0];
   $emailData['customer'] = $customerInfo[0];

   global $adminEmail;
   global $baseLoc;

   if ($baseLoc == "https://longocorporation.com") {
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Longo Web Portal <longocorporation@gmail.com>' . "\r\n" . 'Reply-To: longocorporation@gmail.com \r\n' . 'X-Mailer: PHP/' . phpversion();

      $adminEmail .= ", Dev <mustafeez@plego.com>";

      $body = addJobEmailTempToLongo($emailData);
      $emailStatus = mail($adminEmail, 'Longo Customer added a new job.', $body, $headers);
      if ($emailStatus) {
         return true;
      } else {
         return false;
      }
   }

   require_once "../vendor/autoload.php";
   $mail = new PHPMailer;

   //Enable SMTP debugging.
   //$mail->SMTPDebug = 4;

   //Set PHPMailer to use SMTP.
   $mail->isSMTP();
   $mail->Host = "smtp.gmail.com";

   //Set this to true if SMTP host requires authentication to send email
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = "tls";
   $mail->Port = 587;

   $mail->Username = "plegotech@plego.com";
   $mail->Password = "binaural";

   $mail->From = "plegotech@plego.com";
   //$mail->From     = $data['Email'];
   $mail->FromName = "Longo Web Portal";

   //$mail->addAddress( "Mtfz@msn.com", "Dev" );
   $mail->addAddress("Mustafeez@plego.com", "Developer");
   //$mail->addAddress( $userInfo[0]['emailAddress'], $userInfo[0]['lastName'] . ", " . $userInfo[0]['firstName'] );
   //$mail->addAddress( $adminEmail, "Admin" );

   /*$mail->addCustomHeader('MIME-Version: 1.0');
   $mail->addCustomHeader('Content-type: text/html; charset=iso-8859-1');
   $mail->addCustomHeader('X-Mailer: PHP/' . phpversion());*/


   $mail->isHTML(true);

   $mail->Subject = "Longo Customer added a new job.";
   $mail->Body = addJobEmailTempToLongo($emailData);

   $mail->AltBody = $data['Message'];

   //echo "<pre>";
   if (!$mail->send()) {
      //return false;
   } else {
      //return true;
   }
}


// Approved job email template
function approveJobEmailTempToLongo($data)
{
   global $baseLoc;
   global $emailHeader;
   global $emailFooter;
   $body = $emailHeader . '
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="scale-90" width="490">
                                <td align="left"
                                    style="font-family: \'source_sans_proregular\', Helvetica, Arial, sans-serif; text-align: left; font-size: 16px; color: #000; line-height: normal;"
                                    mc:edit="copy4">
                                        <p>A Job has been approved by "' . $data['customer']['name'] . '". Please log in the Admin Portal to view Customers Job Information</p><br>
                                        <p>Thank you</p>
                                        <p>Longo Construction Admin</p><br>
                                    </td>
                                </tr>
                            </table>';
   $body .= $emailFooter;

   return $body;
}

// send email to Longo and User on job Approved
function emailToLongoOnJobApproved($data)
{
   $userID['id'] = $data['userID'];
   $cid['id'] = $data['cid'];
   $db = new db();
   $userInfo = $db->from('cusers')->where($userID)->results();
   $db = new db();
   $customerInfo = $db->from('ccustomers')->where($cid)->results();
   $emailData['job'] = $data;
   $emailData['user'] = $userInfo[0];
   $emailData['customer'] = $customerInfo[0];

   global $adminEmail;
   global $baseLoc;

   if ($baseLoc == "https://longocorporation.com") {
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Longo Web Portal <longocorporation@gmail.com>' . "\r\n" . 'Reply-To: longocorporation@gmail.com \r\n' . 'X-Mailer: PHP/' . phpversion();

      $adminEmail .= ", Dev <mustafeez@plego.com>";

      $body = approveJobEmailTempToLongo($emailData);
      $emailStatus = mail($adminEmail, 'Longo Customer has approved a job', $body, $headers);
      if ($emailStatus) {
         return true;
      } else {
         return false;
      }
   }


   require_once "../vendor/autoload.php";
   $mail = new PHPMailer;

   //Enable SMTP debugging.
   //$mail->SMTPDebug = 4;

   //Set PHPMailer to use SMTP.
   $mail->isSMTP();
   $mail->Host = "smtp.gmail.com";

   //Set this to true if SMTP host requires authentication to send email
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = "tls";
   $mail->Port = 587;

   $mail->Username = "plegotech@plego.com";
   $mail->Password = "binaural";

   $mail->From = "plegotech@plego.com";
   //$mail->From     = $data['Email'];
   $mail->FromName = "Longo Web Portal";

   //$mail->addAddress( "Mtfz@msn.com", "Dev" );
   $mail->addAddress("Mustafeez@plego.com", "Developer");
   //$mail->addAddress( $userInfo[0]['emailAddress'], $userInfo[0]['lastName'] . ", " . $userInfo[0]['firstName'] );
   $mail->addAddress($adminEmail, "Admin");

   /*$mail->addCustomHeader('MIME-Version: 1.0');
   $mail->addCustomHeader('Content-type: text/html; charset=iso-8859-1');
   $mail->addCustomHeader('X-Mailer: PHP/' . phpversion());*/


   $mail->isHTML(true);

   $mail->Subject = "Longo Customer has approved a job";
   $mail->Body = approveJobEmailTempToLongo($emailData);

   $mail->AltBody = $data['Message'];

   //echo "<pre>";
   if (!$mail->send()) {
      //return false;
   } else {
      //return true;
   }
}


// Contact longo email template
function contactLongo($data)
{
   global $baseLoc;
   global $emailHeader;
   global $emailFooter;
   $body = $emailHeader . '
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="scale-90" width="490">
                                <tr>
                                    <td align="center"
                                        style="font-family: \'source_sans_prosemibold\', Helvetica, Arial, sans-serif; font-size: 22px; color: #FFFFFF;"
                                        mc:edit="copy3"> Message Details
                                    </td>
                                </tr>
                                <tr>
                                    <td height="15" valign="bottom">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="30">
                                            <tr>
                                                <td height="3" style="background-color: #FFFFFF; border-radius: 3px"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" mc:edit="space">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left"
                                    style="font-family: \'source_sans_proregular\', Helvetica, Arial, sans-serif; text-align: left; font-size: 16px; color: #000; line-height: normal;"
                                    mc:edit="copy4">
                                        <table>
                                            <tr>
                                                <th>Name:</th>
                                                <td>' . $data['Name'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>' . $data['Email'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Phone:</th>
                                                <td>' . $data['Phone'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Message:</th>
                                                <td>' . $data['Message'] . '</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
   $body .= $emailFooter;
   return $body;
}

// send email
function sendEmailToLongo($data)
{
   global $adminEmail;

   global $adminEmail;
   global $baseLoc;

   if ($baseLoc == "https://longocorporation.com") {
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Longo Web Portal <longocorporation@gmail.com>' . "\r\n" . 'Reply-To: longocorporation@gmail.com \r\n' . 'X-Mailer: PHP/' . phpversion();

      $adminEmail .= ", Dev <mustafeez@plego.com>";

      $body = contactLongo($data);
      $emailStatus = mail($adminEmail, 'Longo Customer sent you an email', $body, $headers);
      if ($emailStatus) {
         return true;
      } else {
         return false;
      }
   }

   require_once "../vendor/autoload.php";

   $mail = new PHPMailer;

   //Enable SMTP debugging.
   //$mail->SMTPDebug = 4;

   //Set PHPMailer to use SMTP.
   $mail->isSMTP();
   $mail->Host = "smtp.gmail.com";

   //Set this to true if SMTP host requires authentication to send email
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = "tls";
   $mail->Port = 587;

   $mail->Username = "plegotech@plego.com";
   $mail->Password = "binaural";

   //$mail->From = "plegotech@plego.com";
   $mail->From = $data['Email'];
   $mail->FromName = $data['Name'];

   $mail->addAddress("Mtfz@msn.com", "Dev");
   $mail->addAddress("Mustafeez@plego.com", "Developer");
   $mail->addAddress($adminEmail, "Admin");

   /*$mail->addCustomHeader('MIME-Version: 1.0');
   $mail->addCustomHeader('Content-type: text/html; charset=iso-8859-1');
   $mail->addCustomHeader('X-Mailer: PHP/' . phpversion());*/


   $mail->isHTML(true);

   $mail->Subject = "Longo Customer sent you an email";
   $mail->Body = contactLongo($data);

   $mail->AltBody = $data['Message'];

   //echo "<pre>";
   if (!$mail->send()) {
      return false;
   } else {
      return true;
   }
}


// Add customer email template
function addUserEmailTemp($data)
{
   global $baseLoc;
   global $emailHeader;
   global $emailFooter;
   $body = $emailHeader . '
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="scale-90" width="490">
                                <tr>
                                    <td align="center"
                                        style="font-family: \'source_sans_prosemibold\', Helvetica, Arial, sans-serif; font-size: 22px; color: #FFFFFF;"
                                        mc:edit="copy3"> A user has been added in customer portal.
                                    </td>
                                </tr>
                                <tr>
                                    <td height="15" valign="bottom">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="30">
                                            <tr>
                                                <td height="3" style="background-color: #FFFFFF; border-radius: 3px"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" mc:edit="space">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center"
                                        style="font-family: \'source_sans_proregular\', Helvetica, Arial, sans-serif; font-size: 14px; color: #FFFFFF; line-height: 28px;"
                                        mc:edit="copy4">
                                        <table>
                                            <tr>
                                                <th>User Name:</th>
                                                <td>' . $data['username'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Password:</th>
                                                <td>' . $data['password'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>First Name:</th>
                                                <td>' . $data['firstName'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Last Name:</th>
                                                <td>' . $data['lastName'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Email Address:</th>
                                                <td>' . $data['emailAddress'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Phone:</th>
                                                <td>' . $data['phone'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>User Role:</th>
                                                <td>' . $data['role'] . '</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
   $body .= $emailFooter;
   return $body;
}

// send email to Longo on user add
function addUserEmail($data)
{
   $emailData = $data;

   global $adminEmail;
   global $baseLoc;

   if ($baseLoc == "https://longocorporation.com") {
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Longo Web Portal <longocorporation@gmail.com>' . "\r\n" . 'Reply-To: longocorporation@gmail.com \r\n' . 'X-Mailer: PHP/' . phpversion();

      $adminEmail .= ", Dev <mustafeez@plego.com>";

      $body = addUserEmailTemp($emailData);

      $emailStatus = mail($adminEmail, 'A user has been added in Longo Customer', $body, $headers);
      if ($emailStatus) {
         return true;
      } else {
         return false;
      }
   }

   require_once "../vendor/autoload.php";
   $mail = new PHPMailer;

   //Enable SMTP debugging.
   //$mail->SMTPDebug = 4;

   //Set PHPMailer to use SMTP.
   $mail->isSMTP();
   $mail->Host = "smtp.gmail.com";

   //Set this to true if SMTP host requires authentication to send email
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = "tls";
   $mail->Port = 587;

   $mail->Username = "plegotech@plego.com";
   $mail->Password = "binaural";

   $mail->From = "plegotech@plego.com";
   //$mail->From     = $data['Email'];
   $mail->FromName = "Longo Web Portal";

   $mail->addAddress("Mtfz@msn.com", "Dev");
   $mail->addAddress("Mustafeez@plego.com", "Developer");
   $mail->addAddress($adminEmail, "Admin");

   /*$mail->addCustomHeader('MIME-Version: 1.0');
   $mail->addCustomHeader('Content-type: text/html; charset=iso-8859-1');
   $mail->addCustomHeader('X-Mailer: PHP/' . phpversion());*/


   $mail->isHTML(true);

   $mail->Subject = "Longo Customer sent you an email";
   $mail->Body = addUserEmailTemp($emailData);

   $mail->AltBody = $data['Message'];

   //echo "<pre>";
   if (!$mail->send()) {
      //return false;
   } else {
      //return true;
   }
}

// Add customer email template
function addUserEmailTempForUser($data)
{
   global $baseLoc;
   global $emailHeader;
   global $emailFooter;
   $body = $emailHeader . '<table align="center" border="0" cellpadding="0" cellspacing="0" class="scale-90" width="490">
                                <tr>
                                    <td align="left"
                                    style="font-family: \'source_sans_proregular\', Helvetica, Arial, sans-serif; text-align: left; font-size: 16px; color: #000; line-height: normal;"
                                    mc:edit="copy4">
                                        <table>
                                            <tr>
                                                <th>User Name:</th>
                                                <td>' . $data['username'] . '</td>
                                            </tr>
                                            <tr>
                                                <th>Password:</th>
                                                <td>' . $data['password'] . '</td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <p>You can login by using the user name and password provided above. Click <a href="' . $baseLoc . '/jobs/">here</a> to login now.</p>
                                    </td>
                                </tr>
                            </table>';
   $body .= $emailFooter;

   return $body;
}

// send email to Longo on user add
function addUserEmailToUser($data)
{
   $emailData = $data;


   global $adminEmail;
   global $baseLoc;

   if ($baseLoc == "https://longocorporation.com") {
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Longo Web Portal <longocorporation@gmail.com>' . "\r\n" . 'Reply-To: longocorporation@gmail.com \r\n' . 'X-Mailer: PHP/' . phpversion();

      $adminEmail = $data['lastName'] . ", " . $data['firstName'] . "<" . $data['emailAddress'] . ">";
      $adminEmail .= ", Dev <mustafeez@plego.com>";

      $body = addUserEmailTempForUser($emailData);
      $emailStatus = mail($adminEmail, 'You have been added in Longo Customer', $body, $headers);
      if ($emailStatus) {
         return true;
      } else {
         return false;
      }
   }


   require_once "../vendor/autoload.php";
   $mail = new PHPMailer;

   //Enable SMTP debugging.
   //$mail->SMTPDebug = 4;

   //Set PHPMailer to use SMTP.
   $mail->isSMTP();
   $mail->Host = "smtp.gmail.com";

   //Set this to true if SMTP host requires authentication to send email
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = "tls";
   $mail->Port = 587;

   $mail->Username = "plegotech@plego.com";
   $mail->Password = "binaural";

   $mail->From = "plegotech@plego.com";
   //$mail->From     = $data['Email'];
   $mail->FromName = "Longo Web Portal";

   //$mail->addAddress( "Mtfz@msn.com", "Dev" );
   $mail->addAddress("Mustafeez@plego.com", "Developer");
   $mail->addAddress($data['emailAddress'], $data['lastName'] . ", " . $data['firstName']);
   //$mail->addAddress( $adminEmail, "Admin" );

   /*$mail->addCustomHeader('MIME-Version: 1.0');
   $mail->addCustomHeader('Content-type: text/html; charset=iso-8859-1');
   $mail->addCustomHeader('X-Mailer: PHP/' . phpversion());*/


   $mail->isHTML(true);

   $mail->Subject = "You have been added in Longo Customer";
   $mail->Body = addUserEmailTempForUser($emailData);

   $mail->AltBody = $data['Message'];

   //echo "<pre>";
   if (!$mail->send()) {
      //return false;
   } else {
      //return true;
   }
}








// Login function
function login($data)
{
   $db = new db();
   //$db->setDebug('yes');
   $where = array(
      'username' => $data['userName'],
      'password' => $data['password'],
   );

   $chk = $db->from('cusers')->where($where)->results();

   if (!$chk) {
      echo json_encode(array("error" => "ID or Password incorrect."));
   } else {
      $_SESSION['userId'] = $chk[0]['id'];
      $_SESSION['cid'] = $chk[0]['cid'];
      $_SESSION['userName'] = $chk[0]['username'];
      $_SESSION['userRole'] = $chk[0]['role'];
      $_SESSION['firstName'] = $chk[0]['firstName'];
      $_SESSION['lastName'] = $chk[0]['lastName'];

      $cid = array('id' => $chk[0]['cid']);
      $db2 = new db();
      $customerInfo = $db2->from('ccustomers')->where($cid)->results();
      $_SESSION['cName'] = $customerInfo[0]['name'];
      $_SESSION['cLogo'] = $customerInfo[0]['c_logo'];
      //$_SESSION['debug']     = $customerInfo;

      $chk['debug'] = $_SESSION;
      echo json_encode($chk);
   }
}

// Fetch states
function getStates()
{
   $db = new db();
   //$db->setDebug('yes');
   $db->from('cstates')->json();
   /*$states = $db->from( 'cstates2' )->json();
   if (!$states){
      echo json_encode( [ "error" => "Something went wrong" ] );
   }
   else {
      echo $states;
   }*/
}

// Get jobs
function getJobs($data = null)
{
   $db = new db();
   //$db->setDebug('yes');

   $where = array("is_archived" => 0);
   switch ($_SESSION['userRole']) {
      case "user"     :
         //$where = [ "userID" => $_SESSION['userId'] ];
         //$where = array( "cid" => $_SESSION['cid'] );
         $where['cid'] = $_SESSION['cid'];
         break;
      case "cadmin"   :
         $where['cid'] = $_SESSION['cid'];
         //$where = array( "cid" => $_SESSION['cid'] );
         break;
      case "admin"   :
         $where['cid'] = $data['cid'];
         //$where = array( "cid" => $data['cid'] );
         break;
   }

   $db->from('cjobs')->where($where)->orderBy('id DESC')->json();
   //echo json_encode( $states );
}

// Get archived jobs
function getArchivedJobs($data = null)
{
   $db = new db();
   //$db->setDebug('yes');

   $where = array("is_archived" => 1);
   switch ($_SESSION['userRole']) {
      case "user"     :
         //$where = [ "userID" => $_SESSION['userId'] ];
         //$where = array( "cid" => $_SESSION['cid'] );
         $where['cid'] = $_SESSION['cid'];
         break;
      case "cadmin"   :
         $where['cid'] = $_SESSION['cid'];
         //$where = array( "cid" => $_SESSION['cid'] );
         break;
      case "admin"   :
         $where['cid'] = $data['cid'];
         //$where = array( "cid" => $data['cid'] );
         break;
   }

   $db->from('cjobs')->where($where)->orderBy('id DESC')->json();
   //echo json_encode( $states );
}

// Get User's jobs
function getUJobs($data = null)
{
   $db = new db();
   //$db->setDebug('yes');

   $where = array("userID" => $data['id'], /*"is_archived" => 0*/);
   $qResp = $db->from('cjobs')->where($where)->orderBy('id DESC')->json();
   return $qResp;
   //return "abc:";
   //echo json_encode( $states );
}

// Add job
function addJob($dataRcvd)
{
   $data = $dataRcvd['postData'];
   $fileData = $dataRcvd['fileData'];

   if (isset($fileData['job_file']['name'])) {
      $ext = pathinfo($fileData['job_file']['name'], PATHINFO_EXTENSION);
      $fileName = date("Ymd_His") . "." . $ext;

      $moveStatus = move_uploaded_file($fileData['job_file']['tmp_name'], '../uploads/' . $fileName);
      if ($moveStatus) {
         $data['job_file'] = $fileName;
      }
   }

   $db = new db();
   //$db->setDebug('yes');
   $db->create('cjobs')->values($data)->json();

   emailToLongoOnJobAdd($data);
}

// Delete job
function remJob($dataRcvd)
{
   $jobID = $dataRcvd['jid'];

   $db = new db();
   //$db->setDebug('yes');
   $qResp = $db->delete()->from('cjobs')->where('id = ' . $jobID)->results();

   if (!isset($qResp['error'])) {
      $resp[] = $qResp;
      $resp['success'] = "Job deleted successfully!";
      echo json_encode($resp);
   } else {
      echo json_encode($qResp);
   }
}

// Update job
function updateJob($dataRcvd)
{
   $data = $dataRcvd['postData'];
   $fileData = $dataRcvd['fileData'];

   $id = array('id' => $data['id']);
   unset($data['id']);

   $db = new db();
   //$db->setDebug('yes');
   $chkStatus = $db->from('cjobs')->where($id)->results();

   if ($_SESSION['userRole'] == "admin"
      || $_SESSION['userRole'] == "cadmin"
      || $chkStatus[0]['userID'] == $_SESSION['userId']) {

      // Customer admin can only change the job status
      if ($_SESSION['userRole'] == "cadmin" AND $chkStatus[0]['userID'] != $_SESSION['userId']) {

         $updData = array('status' => $data['status']);

         $db = new db();
         //$db->setDebug('yes');
         $updQ = $db->update('cjobs')->set($updData)->where($id)->results();

         $resp = array("status" => "success", "resp" => $updQ);
         echo json_encode($resp);
         exit();
      }

      if (isset($fileData['job_file']['name'])) {
         $ext = pathinfo($fileData['job_file']['name'], PATHINFO_EXTENSION);
         $fileName = date("Ymd_His") . "." . $ext;

         $moveStatus = move_uploaded_file($fileData['job_file']['tmp_name'], '../uploads/' . $fileName);
         if ($moveStatus) {
            $data['job_file'] = $fileName;

            // Delete old file
            if (!empty($chkStatus[0]['job_file'])) {
               unlink('../uploads/' . $chkStatus[0]['job_file']);
            }
         }
      }

      $db = new db();
      //$db->setDebug('yes');
      $updQ = $db->update('cjobs')->set($data)->where($id)->results();

      // send email to longo on job approve
      if (($data['status'] == 'approved') AND ($data['status'] != $chkStatus[0]['status'])) {
         $db = new db();
         //$db->setDebug('yes');
         $userID = $db->from('cjobs')->where($id)->results();
         $userID = $userID[0];
         $data['userID'] = $userID['userID'];
         $data['cid'] = $userID['cid'];
         emailToLongoOnJobApproved($data);
      }
      $resp = array("status" => "success", "resp" => $updQ);
      echo json_encode($resp);
   } else {
      $resp = array("status" => "error", "msg" => "You don't have permission to edit this job.");
      echo json_encode($resp);
   }
}

// Switch job
function switchJobs($dataRcvd)
{
   $id = array('userID' => $dataRcvd['id']);
   $targUserID = $dataRcvd['targUserID'];
   $updData = array('userID' => $targUserID);

   $db = new db();
   //$db->setDebug('yes');
   $qResp = $db->update('cjobs')->set($updData)->where($id)->results();

   if (!isset($qResp['error'])) {
      $resp[] = $qResp;
      $resp['success'] = "Jobs updated successfully!";
      echo json_encode($resp);
   } else {
      echo json_encode($qResp);
   }
}


// Get customers
function getCustomers()
{
   $db = new db();
   //$db->setDebug('yes');

   if ($_SESSION['userRole'] != "admin") {
      echo json_encode(array("error" => "You don't have permission to view customers."));
      exit();
   }

   $db->from('ccustomers')->orderBy('id DESC')->json();
}

// Add Customer
function addCustomer($dataRcvd)
{
   /*print_r($dataRcvd);
   exit();*/

   if ($_SESSION['userRole'] != "admin") {
      echo json_encode(array("error" => "You don't have permission to add customers."));
      exit();
   }

   $data = $dataRcvd['postData'];
   $fileData = $dataRcvd['fileData'];

   if (!empty($data['id'])) {
      $id = array('id' => $data['id']);
      unset($data['id']);

      $name = "`name`='" . $data['name'] . "' AND id != '" . $id['id'] . "'";

      $db = new db();
      //$db->setDebug('yes');
      $chkName = $db->from('ccustomers')->where($name)->results();

      if ($chkName) {
         $error['error'] = "Customer with this name already exists.";
         //$error['debug'] = $chkName;
         echo json_encode($error);
         exit();
      }

      if (isset($fileData['c_logo']['name'])) {
         $ext = pathinfo($fileData['c_logo']['name'], PATHINFO_EXTENSION);
         $fileName = date("Ymd_His") . "." . $ext;

         move_uploaded_file($fileData['c_logo']['tmp_name'], '../images/' . $fileName);
         $data['c_logo'] = $fileName;
      }

      $db = new db();
      //$db->setDebug('yes');
      $data['updated_by'] = $_SESSION['userId'];
      $qResp = $db->update('ccustomers')->set($data)->where($id)->results();
      if (!isset($qResp['error'])) {
         $resp[] = $qResp;
         $resp['success'] = "Customer updated successfully";
         echo json_encode($resp);
      } else {
         echo json_encode($qResp);
      }
   } else {
      unset($data['id']);

      $db = new db();
      //$db->setDebug('yes');
      $name = array("`name`" => $data['name']);
      $chkName = $db->from('ccustomers')->where($name)->results();

      if ($chkName) {
         $error['error'] = "Customer with this name already exists.";
         //$error['debug'] = $chkName;
         echo json_encode($error);
         exit();
      }

      if (isset($fileData['c_logo']['name'])) {
         $ext = pathinfo($fileData['c_logo']['name'], PATHINFO_EXTENSION);
         $fileName = date("Ymd_His") . "." . $ext;

         move_uploaded_file($fileData['c_logo']['tmp_name'], '../images/' . $fileName);
         $data['c_logo'] = $fileName;
      }

      $db = new db();
      //$db->setDebug('yes');
      $data['created_by'] = $_SESSION['userId'];
      $qResp = $db->create('ccustomers')->values($data)->results();
      if (!isset($qResp['error'])) {
         $resp[] = $qResp;
         $resp['success'] = "Customer has been added successfully";
         echo json_encode($resp);
      } else {
         echo json_encode($qResp);
      }
   }
}

// Get users
function getUsers($data)
{
   $db = new db();
   //$db->setDebug('yes');

   if ($_SESSION['userRole'] != "admin") {
      echo json_encode(array("error" => "You don't have permission for this action."));
      exit();
   }

   if (!empty($data['cid'])) {
      $db->from("cusers")->where($data)->json();
   } else {
      echo json_encode(array("error" => "CID cannot be empty"));
   }
}

// Get user details
function getUser($data)
{
   $db = new db();
   //$db->setDebug('yes');

   if ($_SESSION['userRole'] != "admin") {
      echo json_encode(array("error" => "You don't have permission for this action."));
      exit();
   }

   if (!empty($data['id'])) {
      $db->from("cusers")->where($data)->json();
   } else {
      echo json_encode(array("error" => "ID cannot be empty"));
   }
}

// Add User
function addUser($data)
{

   if ($_SESSION['userRole'] == "user") {
      echo json_encode(array("error" => "You don't have permission for this action."));
      exit();
   }

   $confirmPass = $data['c_password'];
   unset($data['c_password']);

   if (!empty($data['id'])) {
      $id = array('id' => $data['id']);
      unset($data['id']);
      unset($data['cid']);
      $error = array();


      $db = new db();
      //$db->setDebug('yes');
      $email = "`emailAddress`='" . $data['emailAddress'] . "' AND id != '" . $id['id'] . "'";
      $chkEmail = $db->from('cusers')->where($email)->results();

      $db = new db();
      //$db->setDebug('yes');
      $name = "`username`='" . $data['username'] . "' AND id != '" . $id['id'] . "'";
      $chkName = $db->from('cusers')->where($name)->results();

      if ($data['password'] != $confirmPass) {
         $error['error']['c_password'] = "Password does not matched.";
      }
      if ($chkEmail) {
         $error['error']['emailAddress'] = "Customer with this email already exists.";
      }
      if ($chkName) {
         $error['error']['username'] = "Customer with this user name already exists.";
      }

      if (count($error) > 0) {
         echo json_encode($error);
         exit();
      }

      $db = new db();
      //$db->setDebug('yes');
      $data['updated_by'] = $_SESSION['userId'];
      $qResp = $db->update('cusers')->set($data)->where($id)->results();
      if (!isset($qResp['error'])) {
         $resp[] = $qResp;
         $resp['success'] = "User updated successfully!";
         echo json_encode($resp);
      } else {
         echo json_encode(array("error" => $qResp));
      }
   } else {
      unset($data['id']);
      $error = array();

      $db = new db();
      //$db->setDebug('yes');
      $email["`emailAddress`"] = $data['emailAddress'];
      $chkEmail = $db->from('cusers')->where($email)->results();

      $db = new db();
      //$db->setDebug('yes');
      $name["`username`"] = $data['username'];
      $chkName = $db->from('cusers')->where($name)->results();

      if ($data['password'] != $confirmPass) {
         $error['error']['c_password'] = "Password does not matched.";
      }
      if ($chkEmail) {
         $error['error']['emailAddress'] = "Customer with this email already exists.";
      }
      if ($chkName) {
         $error['error']['username'] = "Customer with this user name already exists.";
      }

      if (count($error) > 0) {
         echo json_encode($error);
         exit();
      }

      $db = new db();
      //$db->setDebug('yes');
      $data['created_by'] = $_SESSION['userId'];
      $qResp = $db->create('cusers')->values($data)->results();
      if (!isset($qResp['error'])) {
         $resp[] = $qResp;
         $resp['success'] = "User has been added successfully!";
         echo json_encode($resp);
      } else {
         echo json_encode(array("error" => $qResp));
         exit();
      }
      //addUserEmail($data);
      addUserEmailToUser($data);
   }
}

// Delete User
function remUser($dataRcvd)
{
   $userID = $dataRcvd['id'];

   $db = new db();
   //$db->setDebug('yes');
   $qResp = $db->delete()->from('cusers')->where('id = ' . $userID)->results();

   if (!isset($qResp['error'])) {
      $resp[] = $qResp;
      $resp['success'] = "User deleted successfully!";
      echo json_encode($resp);
   } else {
      echo json_encode($qResp);
   }
}
