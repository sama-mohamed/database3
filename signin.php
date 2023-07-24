<?php 

$page_title = "Register";
$css_file = 'style.css';
require_once('./init.php');
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password  = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
   


    global $con;

    $stmt = $con->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute(array($email));
    $user_data= $stmt->fetch();
    $row_count= $stmt->rowcount();
    if($row_count > 0){
        if(password_verify($password,$user_data['password'])){
            @session_start();
            $_SESSION['id']    = $user_data['id'];
            $_SESSION['name']  = $user_data['name'];
            $_SESSION['email']  = $user_data['email'];
            echo "
            <script>
              toaster.success(' you entered sucessfully')
            </script>";
            header("Refresh:3;url=index.php");

        }
        else{
            echo "
            <script>
              toaster.success('wrong email or password')
            </script>";

        }
    }
    else{
        echo "
        <script>
          toaster.success('wrong email')
        </script>";

    }

  

}

?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">
  
  <div class="mb-3">
    <label class="form-label">email</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">password</label>
    <input type="password" name="password" class="form-control">
  </div>

  

 
 
  <button type="submit" class="btn btn-primary">Login</button>
</div>
</form>

<?php include_once("./includes/template/footer.php");
 ?>