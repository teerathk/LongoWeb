<?php
/**
 * Created by mtfz@msn.com using PhpStorm.
 * Date: 4/30/2017
 * Time: 9:16 PM
 */

include_once "db.php";

$db = new db();
$db->setDebug("yes");
//$rows = $db->get("employees")->results();

//$rows = $db->from("employees")->where('employeeId = 2')->results();
$data = [
	"username" => "test",
	"password" => "123",
	"firstName" => "firstName",
	"lastName" => "lastName",
	"emailAddress" => "emailAddress",
];

$rows = $db->create('cusers')->values($data)->json();




echo "<pre>";
print_r($data);
print_r($rows);
/*foreach ($rows as $index => $row) {
    echo "key:" . $index;
    echo ", val:" . $row . "<br>";
}*/
echo "</pre>";
