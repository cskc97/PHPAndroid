<?php

require_once('include/database_functions.php');

$data = new DatabaseFunctions();

$username = "NewUser";
$password = "NewUserPassword";

$data->insertUser($username,$password);

echo "Hello World";

?>
