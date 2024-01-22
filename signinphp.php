<?php 
include("config.php");

class signinphp {
   
    
    public function signInFormVerifier(): void {
      if($_POST["name"] == "") {
        echo "<script>alert('Username cannot be empty!');</script>";
        echo "<script>document.body.innerHTML = '';</script>"; 
        echo "<script>setTimeout(\"location.href = 'signIn.html';\",500);</script>";
        exit();
      }

      else
        $username = $_POST["name"];
  
      if($_POST["pwd"] == "") {
        echo "<script>alert('Password cannot be empty!');</script>";
        echo "<script>document.body.innerHTML = '';</script>"; 
        echo "<script>setTimeout(\"location.href = 'signIn.html';\",500);</script>";
        exit();
      }

      else
        $password = hash('sha512',$_POST["pwd"]);
      
    }
    
    public function signInRedirect(): void {
      if(!empty($_POST['submit']))
      {
          $username = $_POST["name"];
          $password = hash('sha512',$_POST["pwd"]);
          global $con;
          session_start();
          $_SESSION["login_user"] = $username;
          $user_check=$_SESSION["login_user"];
          $query = $con->prepare("SELECT * FROM users WHERE username like :user_check");
          $query->bindParam(":user_check", $user_check);
          $query->execute();
          $row = $query->fetch(PDO::FETCH_ASSOC);
          $login_session = $row["username"];
          $plogin_session = $row["password"];
          $idlogin_session = $row["id"];
          
          if($username == $login_session&&$password == $plogin_session){
            echo "<script>alert('You have successfully Signed in!');</script>";
            echo "<script>document.body.innerHTML = '';</script>"; 
            echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
            exit();
          }

          elseif($username != $login_session){
            echo "<script>alert('You have entered an Invalid Username!');</script>";
            echo "<script>document.body.innerHTML = '';</script>"; 
            echo "<script>setTimeout(\"location.href = 'signIn.html';\",500);</script>";
            exit();
          }

          elseif($password != $plogin_session){
            echo "<script>alert('You have entered Incorrect Password!');</script>";
            echo "<script>document.body.innerHTML = '';</script>"; 
            echo "<script>setTimeout(\"location.href = 'signIn.html';\",500);</script>";
            exit();
          }
          
          else 
          {
            echo "<script>alert('You are not a registered user. Please sign up!');</script>";
            echo "<script>document.body.innerHTML = '';</script>"; 
            echo "<script>setTimeout(\"location.href = 'signUp.html';\",500);</script>";
            exit();
          }
      }
      
    }

    
}
?>