<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$usernamesearch = "";
$res = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $res = "inconnu";
  $usernamesearch = $_POST["username"];
  // $stmt = mysqli_prepare($link, "SELECT id FROM users WHERE $usernamesearch");
  if($id = mysqli_query($link, "SELECT id FROM users where username ='$usernamesearch'")){
    $row = mysqli_fetch_assoc($id);
    if ($row==NULL){
        $res = 'inconnu';
    }
    if ($row!=NULL){
        $res = $row['id'];
    }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        <style>
        body{ font: 14px sans-serif; }
        .search{width: 30%; margin : auto;}
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
          <label>Search user by username</label>
          <input type="text" name="username" class="form-control search" placeholder="Joe">
      </div>
      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Search">
      </div>
    </form>
    <h2 class="my-5">Result for <b><?php echo htmlspecialchars($usernamesearch); ?></b> :</h1>
    <h2 class="my-5">id : <b><?php echo htmlspecialchars($res); ?></b>,</h1>
</body>
</html>