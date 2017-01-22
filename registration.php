<?php
//CREATED BY CSKC

//function CheckAndRegister($userName, $userPassword)
//{
require_once("include/database_functions.php");
$dataProcess = new DatabaseFunctions();

$response = NULL;

if(isset($_POST['username'])&&isset($_POST['password']))
{


$userName = $_POST['username'];
$userPassword = $_POST['password'];



	if($dataProcess->user_exists($userName,$userPassword))
		{
			//error message

			$response["error"]=TRUE;
			$response["message"]="User already exists";

			$json_response= json_encode($response);
			echo $json_response;

		}

	else
		{

			//register the user.	
			$result=$dataProcess->InsertUser($userName,$userPassword);

			//echo "{$result} <br><br>";
			

			$response["error"]=FALSE;
			$response["message"]="User Entered";
			$response["user"] = ["username"=>$userName,"registration"=>"success"];

			$json_response= json_encode($response);



			echo $json_response;	
			

			


		}





}
//}
//INSERTING USER
//CheckAndRegister("user","pass");

//CHECKING IF USER EXISTS
//CheckAndRegister("anotheruser222","pass2222");

echo("Hello World");


?>

