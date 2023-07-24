<?php 
session_start();
$page_title = 'All students';
$css_file = 'style.css';
if(isset($_SESSION['name'])){
require_once('./init.php');

global $con;

$stmt = $con->prepare('SELECT * FROM students');
$stmt->execute();
$students = $stmt->fetchAll();

?>
<h1>Hello <?php echo $_SESSION['name'] ?></h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">college_Name</th>
      <th scope="col">Department</th>
      <th scope="col">GPA</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach($students as $student){ ?>
    <tr>
      <td><?php echo $student['id']?></td>
      <td><?php echo $student['name']?></td>
      <td><?php echo $student['collage_name']?></td>
      <td><?php echo $student['department']?></td>
      <td><?php echo $student['gpa']?></td>
      <td><a class="btn btn-danger" href="delete.php?id=<?php echo $student['id']?>">Delete</a></td>
    </tr>
    <?php } ?>

  </tbody>
</table>

<a href="add.php">Add student</a>
<a href="logout.php">LOGOUT</a>


<?php 
include_once('./includes/template/footer.php');

}else{
  header('location:signin.php');

}
?>