<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/3/2017
 * Time: 4:12 PM
 */

include_once "functions.php";


// Login function
if (isset($_POST['unique']) AND ($_POST['unique'] == "cLogin")) {
   $data = cleanInput($_POST);
   login($data['db']);
}

// Fetch states on page load
if (isset($_POST['unique']) AND ($_POST['unique'] == "cStates")) {
   $data = cleanInput($_POST);
   getStates();
}

// Get job
if (isset($_POST['unique']) AND ($_POST['unique'] == "getJobs")) {
   $data = cleanInput($_POST);
   $data = isset($data['db']) ? $data['db'] : "";
   getJobs($data);
}

// Get Archived job
if (isset($_POST['unique']) AND ($_POST['unique'] == "getArchivedJobs")) {
   $data = cleanInput($_POST);
   $data = isset($data['db']) ? $data['db'] : "";
   getArchivedJobs($data);
}

// Get User's job
if (isset($_POST['unique']) AND ($_POST['unique'] == "getUJobs")) {
   $data = cleanInput($_POST);
   $data = isset($data['db']) ? $data['db'] : "";
   getUJobs($data);
}

// Add job
if (isset($_POST['unique']) AND ($_POST['unique'] == "addJob")) {
   unset($_POST['formData']);
   unset($_POST['unique']);

   $data = cleanInput($_POST);
   $data['created_by'] = $_SESSION['userId'];

   if ($_SESSION['userRole'] != 'admin') {
      $data['cid'] = $_SESSION['cid'];
      $data['userID'] = $_SESSION['userId'];
   }

   $data = array('postData' => $data, 'fileData' => $_FILES);

   addJob($data);
}

// Delete job
if (isset($_POST['unique']) AND ($_POST['unique'] == "remJobs")) {
   $data = cleanInput($_POST);
   remJob($data['db']);
}

// Update job
if (isset($_POST['unique']) AND ($_POST['unique'] == "updJob")) {
   unset($_POST['formData']);
   unset($_POST['unique']);

   $data = cleanInput($_POST);
   $data['updated_by'] = $_SESSION['userId'];

   $data = array('postData' => $data, 'fileData' => $_FILES);

   updateJob($data);
}

// Update job
if (isset($_POST['unique']) AND ($_POST['unique'] == "switchJobs")) {
   unset($_POST['url']);
   unset($_POST['unique']);

   $data = cleanInput($_POST);
   switchJobs($data['db']);
}

// Update job
if (isset($_POST['unique']) AND ($_POST['unique'] == "sendEmail")) {
   $data = cleanInput($_POST);
   //testEmail();
   $emailStatus = sendEmailToLongo($data['db']);
   if ($emailStatus) {
      echo json_encode(array("success" => "Email sent"));
   } else {
      echo json_encode(array("error" => "Email NOT sent, try again please.", "debug" => $emailStatus));
   }
}











// Get Customers
if (isset($_POST['unique']) AND ($_POST['unique'] == "getCustomers")) {
   $data = cleanInput($_POST);
   getCustomers();
}

// Add/Edit Customer
if ((isset($_POST['unique']) AND ($_POST['unique'] == "addCustomer")) OR $_FILES['c_logo']) {
   unset($_POST['formData']);
   unset($_POST['unique']);
   /*print_r($_POST);
   print_r($_FILES);
   exit();*/

   $data = cleanInput($_POST);
   $data['created_by'] = $_SESSION['userId'];

   $data = array('postData' => $data, 'fileData' => $_FILES);

   addCustomer($data);
}

// Get Users
if (isset($_POST['unique']) AND ($_POST['unique'] == "getUsers")) {
   $data = cleanInput($_POST);
   getUsers($data['db']);
}

// Get User Details
if (isset($_POST['unique']) AND ($_POST['unique'] == "getUser")) {
   $data = cleanInput($_POST);
   getUser($data['db']);
}

// Add/Edit User
if (isset($_POST['unique']) AND ($_POST['unique'] == "addUser")) {
   $data = cleanInput($_POST);

   $data['db']['created_by'] = $_SESSION['userId'];
   addUser($data['db']);
}

// Delete User
if (isset($_POST['unique']) AND ($_POST['unique'] == "remUser")) {
   $data = cleanInput($_POST);
   remUser($data['db']);
}

