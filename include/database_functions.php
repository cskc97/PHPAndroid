<?php

//CREATED BY CSKC

require_once('Config.php');




class DatabaseFunctions
{
private $databaseConnection;

public function __construct()
{
	$this->databaseConnection=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	

	
}

private function encrypt_password($password)
{

return sha1(md5($password));



}

public function isLinkEstablished()
{
	return $databaseConnection!=NULL;

}

public function InsertUser($username, $password)
{
	$encryptedPassword = $this->encrypt_password($password);
	$insertionQuery = "INSERT INTO `users` (`_id`, `username`, `password`) VALUES (NULL, ?, ?);";
	$stmt = $this->databaseConnection->prepare($insertionQuery);


	$stmt->bind_param("ss",$uName,$ePassword);

	$uName = $username;
	$ePassword=$encryptedPassword;


	$stmt->execute();

	$stmt->close();

}

public function __destruct()
{

	$this->databaseConnection->close();

	//echo "<br> DESTRUCTOR INVOKED <br>";
}

public function user_exists($username,$password)
{

	$searchQuery="SELECT * FROM `users` WHERE `username` LIKE '".$username."';";

	//echo $searchQuery."<br><br>";


	$assoc = $this->databaseConnection->query($searchQuery);
	$assocArray = $assoc->fetch_assoc();


	if($assocArray == NULL)
		{
	//		echo "ASSOC ARRAY IS EMPY!";
		}

//	echo "<br> Encrypted Entry = {$this->encrypt_password($password)} ";

//	echo "<br> Existing Password = {$assocArray["password"]} <br><br> ";

	if($this->encrypt_password($password)==$assocArray["password"])	
		{
	//		echo "USER ALREADY EXISTS";
			return true;
		}
	else 
		{
	//		echo "USER DOES NOT EXIST";
			return false;
		}

		$assoc->close();

}


public function delete_user($username)
{

	$deleteQuery = "DELETE FROM `users` WHERE username = '".$username."';";
	$this->databaseConnection->query($deleteQuery);


}




}

/*
//TESTING 
$data = new DatabaseFunctions();

echo "Inserting user into database";

echo "</br> </br>";

$data->InsertUser("user","pass");


echo "Checking if user exists <br> <br>";
$data->user_exists("user","pass");

echo "<br><br>Deleting User from Database <br><br>";

$data->delete_user("user");


echo "Inserting user into database";

echo "</br> </br>";

$data->InsertUser("user","pass");

$data = NULL;
*/






?>