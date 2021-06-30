<?php 
function secure($text){
  return htmlspecialchars(stripcslashes(strip_tags(trim($text))));
}
include 'connect.php';
$response = array();
if(isset($_POST['username']) && isset($_POST['password']))
{
  $uname = secure($_POST['username']);
  $pass = secure($_POST['password']);

  $stmt = $conn->prepare("SELECT * FROM `account_tbl` WHERE `username`=:uname AND `account_status`=1 AND `role`=4");
  $stmt->bindParam("uname", $uname);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC); 
  $count=$stmt->rowCount();
  $data=$stmt->fetch();
  if($count)
  {
    
    $passwordIsCorrect = password_verify($pass, $data['password']);

    if($passwordIsCorrect)
    {
      $code = "login_success";
      echo json_encode(array("code"=>$code, 
      "account_id"=>$data['account_id'], 
      "surname"=>$data['surname'], 
      "firstname"=>$data['firstname'], 
      "middlename"=>$data['middlename'], 
      "contact"=>$data['contact'], 
      "email" => $data['email'],
      "pincode" => $data['pincode'],
      "role" => $data['role']));
    } 
    else
    {
      $code = "login_failed";
      $message = "Login credentials is incorrect!";
      echo json_encode(array("code"=>$code, "message"=>$message));
    }
  }else{
    $code = "login_failed";
    $message = "Login credentials is incorrect!";
    echo json_encode(array("code"=>$code, "message"=>$message));
  }
}
else
{
  $code = "login_failed";
  $message = "Please fill up required field!";
  echo json_encode(array("code"=>$code, "message"=>$message));
}
?>