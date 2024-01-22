<?php 
include("config.php");
include("signUp.html");

if($_POST["name"] == "") {
  echo "<script>alert('Username cannot be empty!');</script>";
  echo "<script>document.body.innerHTML = '';</script>"; 
  echo "<script>setTimeout(\"location.href = 'signUp.html';\",500);</script>";
  exit();
}

else
  $username = $_POST["name"];

if($_POST["pwd"] == "") {
  echo "<script>alert('Password cannot be empty!');</script>";
  echo "<script>document.body.innerHTML = '';</script>"; 
  echo "<script>setTimeout(\"location.href = 'signUp.html';\",500);</script>";
  exit();
}

elseif($_POST["pwd"]!=$_POST['repwd']) {
  echo "<script>alert('The Re-entered Password does not match the Entered Password!');</script>";
  echo "<script>document.body.innerHTML = '';</script>"; 
  echo "<script>setTimeout(\"location.href = 'signUp.html';\",500);</script>";
  exit();
} 
  
else
  $password = hash('sha512',$_POST["pwd"]);

if(!empty($_POST['submit']))
{
    global $con;
    session_start();
    $_SESSION["login_user"] = $username;
    $user_check=$_SESSION["login_user"];
    $query = $con->prepare("SELECT username FROM users WHERE username like :user_check");
    $query->bindParam(":user_check", $user_check);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $login_session = $row["username"];
    
    if($username == $login_session){
      echo "<script>alert('This username is already present!');</script>";
      echo "<script>document.body.innerHTML = '';</script>"; 
      echo "<script>setTimeout(\"location.href = 'signUp.html';\",500);</script>";
    }

    else 
    {
      $query = $con->prepare("INSERT INTO users(username, password)
                            VALUES(:username, :password)");
      $query->bindParam(":username", $username);
      $query->bindParam(":password", $password);
      $query->execute();
      echo "<script>alert('You have successfully created an account. Redirecting you to home page!');</script>";
      echo "<script>document.body.innerHTML = '';</script>"; 
      echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
    }
}

?>