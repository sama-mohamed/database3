<?php 
session_start();
$page_title = "Add Student";
$css_file = 'style.css';
if(isset($_SESSION['name'])){

require_once('./init.php');
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $collage_Name = filter_var($_POST['collage_Name'],FILTER_SANITIZE_STRING);
    $department  = filter_var($_POST['department'],FILTER_SANITIZE_STRING);
    $gpa    = filter_var($_POST['gpa'],FILTER_SANITIZE_STRING);

    global $con;

    $stmt = $con->prepare("INSERT INTO students(name,collage_Name,department ,gpa ) value(?,?,?,?)");
    $stmt->execute(array($name,$collage_Name,$department ,$gpa ));

  

    header("Refresh:3;url=index.php"); 
}

?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">collage_Name</label>
    <input type="text" name="collage_Name" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">department</label>
    <input type="text" name="department" class="form-control">
  </div>

  

  <div class="mb-3">
    <label class="form-label">GPA</label>
    <input type="text" name="gpa" class="form-control">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

<?php 
include_once("./includes/template/footer.php");
}else{
  header('location:signin.php');

}
 ?>