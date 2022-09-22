<?php

require 'php/mysqli.php';
require('php/fpdf182/fpdf.php');

if(isset($_GET['action']) || isset($_POST['action'])) {

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = $_POST['action'];
    }

    switch ($action) {
        case 'deleteImage':
            deleteImage($_POST['site'], $_POST['image']);
            break;
        case 'homeSiteCheck':
            homeSiteCheck();
            break;
        case 'homeSiteComments':
            homeSiteComments();
            break;
        case 'upload_images':
            uploadImages();
            break;
        case 'postChecklist':
            print postChecklist();
            break;
        case 'submitHomeSiteCheckList':
            $pdf = new FPDF();
            submitHomeSiteCheckList($pdf);
            break;
        default:
            echo 'Unknown request.';
    }
}

function deleteImage($site, $name)
{
    $mysqli = connection();

    $sql = "SELECT site_images FROM homesites WHERE id = '$site'";
    $site_images = $mysqli->query($sql);

    $site_images = $site_images->fetch_assoc();
    $site_images = json_decode($site_images['site_images']);

    $del[] = $name;

    $site_images = array_diff($site_images, $del);
    $images = json_encode($site_images);
    $update = "update homesites set site_images = '$images' where id = '$site'";

    $mysqli->query($update);
    return;
}

function homeSiteComments()
{
    $id         = $_POST['id'];
    $comments   = $_POST['comments'];
    // Count total files

    $mysqli = connection();
    $update = "insert into site_comments (`site`, `comment`) values ('$id', '$comments');";
    $mysqli->query($update);
    die;
}

function uploadImages()
{
    $id     = $_POST['id'];
    $mysqli = connection();
    // Count total files
    $countfiles = count($_FILES['files']['name']);

    // Upload directory
    $upload_location = "images/uploads/";

    // To store uploaded files path
    $files_arr = array();

    $sql = "SELECT site_images FROM homesites WHERE id = '$id'";
    $site_images = $mysqli->query($sql);

    $site_images = $site_images->fetch_assoc();
    $site_images = json_decode($site_images['site_images']);

    // Loop all files
    for($index = 0; $index < $countfiles; $index++){

        if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){
            // File name
            $filename = time().$_FILES['files']['name'][$index];

            // File path
            $path = $upload_location.   $filename;

            // Upload file
            if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
                $files_arr[] = $path;
                $db_names[] = $filename;
            }
        }
    }

    if(count($db_names)) {
        if($site_images) {
            $db_names = array_merge($site_images, $db_names);
        }
        $images = json_encode($db_names);
        $update = "update homesites set site_images = '$images' where id = '$id'";
        $mysqli->query($update);
    }

    echo json_encode($db_names);
    die;
}

function homeSiteCheck()
{
    $mysqli = connection();

    $homesite = $_GET['home_site'];
    $category = $_GET['category'];

    $sql = "select * from homesites where homesite = '$homesite' and category = '$category' order by homesite desc limit 1";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $homesite_id = $row['id'];
        $submission  = $row['submission'];
        $site_images  = $row['site_images'];

        $sql        = "select check_id from homesitechecks where homesite = '$homesite_id'";
        $result     = $mysqli->query($sql);
        //$rows       = $result->fetch_assoc();
        
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $sql        = "select comment, DATE_FORMAT(DATE_ADD(created_at, INTERVAL 1 HOUR), '%m/%d/%Y %h:%i %p') as created_at from site_comments where site = '$homesite_id'";
        $result     = $mysqli->query($sql);
        //$rows       = $result->fetch_assoc();

        $rows_comment = array();
        while ($row = $result->fetch_assoc()) {
            $rows_comment[] = $row;
        }

        echo json_encode(array(
            'homesite'      => $homesite_id,
            'checks'        => $rows,
            'rows_comment'        => $rows_comment,
            'submission'    => $submission,
            'site_images'    => $site_images,
        ));

        return;
    } else {
        $date = date('Y-m-d');
        $sql = "insert into homesites (`homesite`, `category`, `submission`) values ('$homesite', '$category', '$date')";
        $mysqli->query($sql);

        echo json_encode(array(
            'homesite'  => $mysqli->insert_id
        ));
        return;
    }
}

function postChecklist()
{
    $check_list_item    = $_GET['checkbox'];
    $home_site          = $_GET['home_site'];
    $process            = $_GET['process'];

    if($process == 'add') {
        $sql = "insert into homesitechecks (`homesite`, `check_id`) values ('$home_site', '$check_list_item')";
    } else {
        $sql = "delete from homesitechecks where homesite = '$home_site' and check_id = '$check_list_item'";
    }

    $mysqli = connection();
    $mysqli->query($sql);
    
    $date = date('Y-m-d');
    
    $update = "UPDATE homesites set submission = '$date' where id = '$home_site'";
    $mysqli->query($update);
    
    return true;
}

function submitHomeSiteCheckList($pdf)
{
    $name           = $_GET['name'];
    $home_site      = $_GET['home_site'];
    $submission     = $_GET['submission'];
    $crew_leader    = $_GET['crew_leader'];
    $category       = $_GET['category'];
    $mysqli         = connection();

    $update = "update homesites set crew_leader = '$crew_leader',  submission = '$submission' where id = '$home_site'";
    $mysqli->query($update);

    $sql = "SELECT `check_id`, `check_text` FROM `homesitechecks`";
    $sql .= "INNER JOIN `checklist` on `checklist`.`id` = `homesitechecks`.`check_id` WHERE";
    $sql .= " `homesitechecks`.`homesite` = '$home_site'";

    $result                 = $mysqli->query($sql);
        
    $checked_checks = array();
    while ($checked_check = $result->fetch_assoc()) {
        $checked_checks[] = $checked_check;
    }

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,strtoupper($name));
    $pdf->Ln();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,10,'Completed');
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $done = array();
    foreach ($checked_checks as $key => $value) {
        $pdf->Cell(40,10,$key + 1 . ". " .$value['check_text']);
        $done[] = $value['check_id'];
        $pdf->Ln(5);
    }
    $done_ids = "('";
    $done = implode("', '", $done);
    $done_ids .= $done . "')";

    $not_done = "select * from checklist where id not in $done_ids and category = '$category'";
    $remaining = $mysqli->query($not_done);

    $checked_checks = array();
    while ($not_checked_check = $remaining->fetch_assoc()) {
        $not_checked_checks[] = $not_checked_check;
    }

    $pdf->SetFont('Arial','B',14);
    $pdf->Ln();
    $pdf->Cell(40,10,'Remaining');
    $pdf->Ln();

    $pdf->SetFont('Arial','',12);

    if(count($not_checked_checks) < 1) {
        $pdf->Cell(40,10, "N/A");
        $pdf->Ln(5);
    } else {
        foreach ($not_checked_checks as $key => $value) {
            $pdf->Cell(40,10,$key + 1 . ". " .$value['check_text']);
            $pdf->Ln(5);
        }
    }

    $pdf->Ln();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Crew Member');
    $pdf->Cell(40,10, 'Submitted', '', '', 'R');
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,$crew_leader);
    $pdf->Cell(40,10, date("m-d-y", strtotime($submission)), '', '', 'R');
    $pdf->Output('F', 'pdf/homesite'.$home_site.'.pdf');



//Instantiation and passing `true` enables exceptions
//    $mailHello = new PHPMailer(true);
    sendEmailToChecklistAdmin($home_site);
}

function sendEmailToChecklistAdmin($home_site)
{
    // Recipient
    $to = 'longocorporation@gmail.com, longpawllc2@gmail.com';
    //$to = 'rehan@plego.com, waqar@plego.com';
    //$to = 'amin@plego.com, waqar@plego.com, saad@plego.com, rehan@plego.com';

    // Sender
    $from = 'admin@longocorporation.com';
    $fromName = 'Longo Corporation';

    // Email subject
    $subject = 'Checklist Form Submission';

    // Attachment file
    $file = "pdf/homesite".$home_site.".pdf";

    // Email body content
    $htmlContent = '<p>Hello Admin,</p> 
    <p>This email is to notify you about the submission of a checklist form by a crew member.  Please open the attached PDF to see the details.</p>
    <p>Regards,</p>
    <p>System support team</p>';

    // Header for sender info
    $headers = "Reply-To: $fromName <noreply@longocorporation.com>\r\n";
    $headers .= "Return-Path: $fromName <".$from.">\r\n";
    $headers .= "From: $fromName"." <".$from.">";
#    $headers .= "Cc: waqar@plego.com";
#    $headers .= "Bcc: waqar@plego.com";

    // Boundary
    $semi_rand = md5(time());
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

    // Headers for attachment
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

    // Multipart boundary
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

    // Preparing attachment
    if(!empty($file) > 0){
        if(is_file($file)){
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
    }
    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $from;

    // Send email
    $mail = mail($to, $subject, $message, $headers, $returnpath);

    // Email sending status
    echo $mail?"<h1>Email Sent Successfully!</h1><script> setTimeout(function () { window.top.close(); }, 3000); </script>":"<h1>Email sending failed.</h1><script> setTimeout(function () { window.top.close(); }, 3000); </script>";
}



