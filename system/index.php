<?php
//connction of my sql server
$conn = @mysql_connect("localhost","root","");
//selecting data base
mysql_select_db("system",$conn);

// action varible for using insert update and delete opretion which retrive from query string
$action = "";
if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
}


//for insert opretion
if(isset($_REQUEST['save'])){
    
    //form data
    $name   = $_REQUEST['name'];
    $branch = $_REQUEST['branch'];
    $mark   = $_REQUEST['mark'];
    
    //insert query  and exicution of query
    $query = "insert into student(student_name,student_branch,student_mark) values('$name','$branch','$mark')";  
    if(mysql_query($query)){
        echo"<script>alert('data successfully saved ')</script>";
        echo"<script>window.location='index.php'</script>";
    }else{
        echo"failed ".mysql_error();
    }
}


//for Update opretion
if(isset($_REQUEST['edit'])){
    //querystring varible
    $id   = $_REQUEST['id'];
    
    //form data
    $name   = $_REQUEST['name'];
    $branch = $_REQUEST['branch'];
    $mark   = $_REQUEST['mark'];
    
    //update query  and exicution of query
    $query = "update student set student_name = '$name',student_branch ='$branch',student_mark='$mark' where student_id='$id'";  
    if(mysql_query($query)){
        echo"<script>alert('data successfully Updeate ')</script>";
        echo"<script>window.location='index.php'</script>";
    }else{
        echo"failed ".mysql_error();
    }
}


//for Delete opretion
if($action == 'delete'){
    //querystring varible
    $id   = $_REQUEST['id'];
    
    //update query  and exicution of query
    $query = "delete from student where student_id='$id'";  
    if(mysql_query($query)){
        echo"<script>alert('data successfully Deleted ')</script>";
        echo"<script>window.location='index.php'</script>";
    }else{
        echo"failed ".mysql_error();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Simple Insert Update Delete CRUD Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h1><center>REGISTRATION FORM</center></h1>
 
 <br />  <br />
 
 
  <?php if($action == 'add'){ ?>
       <form method="post" >
        <div class="form-group">
          <label for="email">Name :</label>
          <input type="text" class="form-control" placeholder="Name" name="name">
        </div>
        
          <div class="form-group">
          <label for="email">Branch :</label>
          <input type="text" class="form-control" placeholder="Branch" name="branch">
        </div>
        <div class="form-group">
          <label for="email">Mark :</label>
          <input type="text" class="form-control" placeholder="Mark" name="mark">
        </div>
        
        <button type="submit" class="btn btn-default" name="save" >Submit</button>
      </form>
  <?php }else if($action == 'edit'){
 
          $id = $_REQUEST['id'];
          $query ="select * from student where student_id='$id'";
          $query  = "select * from student order by student_id desc";
          $rs = mysql_query($query) or die("failed ".mysql_error());
          $data = mysql_fetch_array($rs);
  ?>
        <form method="post" >
        <div class="form-group">
          <label for="email">Name :</label>
          <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $data['student_name']; ?>" >
        </div>
        
          <div class="form-group">
          <label for="email">Branch :</label>
          <input type="text" class="form-control" placeholder="Branch" name="branch"  value="<?php echo $data['student_branch']; ?>" >
        </div>
        <div class="form-group">
          <label for="email">Mark :</label>
          <input type="text" class="form-control" placeholder="Mark" name="mark"  value="<?php echo $data['student_mark']; ?>" >
        </div>
        
        <button type="submit" class="btn btn-default" name="edit" >Submit</button>
      </form>
 
  <?php }else{ ?>
          <a href="index.php?action=add" class="btn btn-primary">Add</a>
          <br /> <br />
                   
          <table class="table">
            <thead>
              <tr>
            <th>Name</th>
            <th>branch</th>
            <th>mark</th>
            <th>action</th>
              </tr>
            </thead>
            <tbody>
            <?php
        $query  = "select * from student order by student_id desc";
        $rs = mysql_query($query) or die("failed ".mysql_error());
        while($data = mysql_fetch_array($rs))
        {
            ?>
              <tr>
              <td><?php echo $data["student_name"]; ?></td>
            <td><?php echo $data["student_branch"]; ?></td>
            <td><?php echo $data["student_mark"]; ?></td>
            <td>
            <a href="index.php?action=edit&id=<?php echo $data["student_id"]; ?>" class="btn btn-success">Edit</a>
            <a href="index.php?action=delete&id=<?php echo $data["student_id"]; ?>" class="btn btn-danger" onclick="return confirm('are you soure want to delete this')" >Delete</a>
            
            
            </td>
              </tr>
              <?php     
        }
            

        ?>
            </tbody>
          </table>
  <?php } ?>
 
</div>

 


</body>
</html>

