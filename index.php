<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="main.js"></script>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  </head>
  <body>
    <?php require_once 'process.php';?>
<!-- <?php //if($_SESSION['message'] ): ?>
<div class="alert alert-<?php //echo $_SESSION['msg_type'];?>">

    <div>
      <?php //echo $_SESSION['message']; unset($_SESSION['message']);  ?>
    </div>
</div>
<?php //endif; ?> -->
    <?php 
    
    $mysqli = new mysqli('localhost', 'root','','userdata') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM users") or die($mysqli->error);
    //pre_r($result);

    
  //while($chk = $result->fetch_assoc())
  //pre_r($chk['fname']);

    function pre_r($data){
      echo "<pre>";
      print_r($data);
      echo "</pre>";
    }
    ?>

    <div class="container">
      <h2 class="text-center bg-primary text-light">User Data</h2>
      <table class="table table-hover">
        <thead class="thead-dark">

          <tr>
            <td>First Name

            </td>
            <td>Last Name

            </td>
            <td>Email

            </td>
            <td>Phone

            </td>
            <td></td>
            <td></td>
          </tr>
        </thead>
        <tbody>
        <?php
        while($row = $result->fetch_assoc()):?>
        <tr>
          <td><?php echo $row['fname'];?></td>
          <td><?php echo $row['lname'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['phone'];?></td>
          <td><a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info" >Edit</a></td>
          <td><a href="process.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
        </tr>
  <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    
    <h2  class="text-center bg-primary text-light">Form</h2>
    
    <div class="justify-content-center row">
   

      <form action="index.php" method="POST">
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <label for="fname">First Name</label>
          <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname; ?>" />
        </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input
            type="text"
            class="form-control"
            name="lname"
            id="lname"
            value="<?php echo $lname; ?>"
          />
        </div>
        
        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="text"
            class="form-control"
            name="email"
            id="email"
            value="<?php echo $email; ?>"
          />
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input
            type="text"
            class="form-control"
            name="phone"
            id="phone"
            value="<?php echo $phone; ?>"
          />
        </div>

       
        <div class="form-group">
          <?php if($update == true):?>
          <button type="submit" name="update" class="btn btn-info" onclick="validate(event)">
           Update
          </button>
  <?php else: ?>
          <button type="submit" name="send" class="btn btn-primary" onclick="validate(event)">
            Send
          </button>
  <?php endif; ?>
        </div>
      </form>
    </div>
<script>

  function validate(event){
   
  let fname = document.getElementById('fname').value
  let lname = document.getElementById('lname').value
  let email = document.getElementById('email').value
  let phone = +document.getElementById('phone').value


  if(fname === ""){
    event.preventDefault()
    return alert('First Name is required')
  } 
    
  if(lname === "") 
  {
    event.preventDefault()
  return alert('Last Name is required')
  }
  if(!email.includes('@')) {
    event.preventDefault()
  return alert('Email must include @')
  }
  if(!email.includes('.')){
    event.preventDefault()
   return alert('Email must include .')
  }
  //if(typeOf(phone) !== )
  if(phone === "") 
  {
    event.preventDefault()
  return alert('Phone is required')
  }
  
  }
</script>
  </body>
</html>
