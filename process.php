<?php
   // $mysqli = new mysqli('localhost','root', '', 'crud') or die(mysqli_error($mysqli));

   session_start();
   $mysqli = new mysqli('localhost', 'root','','userdata') or die(mysqli_error($mysqli));
   
    $fname="";
    $lname="";
    $email="";
    $phone="";
    $update = false;
    $id = 0;

    // For deleting records
   if(isset($_GET['delete'])){
       $id = $_GET['delete'];
       $mysqli->query("DELETE FROM users WHERE id = $id") or die(mysqli_error($mysqli));
      
       header('location: index.php');
   }

    // For setting records
   if(isset($_GET['edit'])){
       $id = $_GET['edit'];
       $result = $mysqli->query("SELECT * FROM users WHERE id = $id") or die(mysqli_error($mysqli));
       //print_r($result->fetch_array());
       //exit;
       if(sizeof($result)==1){
            $row = $result->fetch_array();
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $phone = $row['phone'];
            $update = true;
           // echo $fname;
           
            
       }

//header('location: index.php');
   }


    // For updating records
   if(isset($_POST['update'])){
    $id = $_POST['id'];
   
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $mysqli->query("UPDATE users SET fname= '$fname', lname='$lname', email='$email', phone='$phone' WHERE id='$id'") or die($mysqli->error);
   header('location: index.php');
   }


    // For creating records records
    if(isset($_POST['send'])){
        
      
        function test_input($data){
            return trim($data);
        }

        if (empty($_POST["fname"])) {
            $nameErr = "First Name is required";
             echo $nameErr;
             return;
          } else {
            $fname = test_input($_POST["fname"]);
            
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
              $nameErr = "Only letters and white space allowed";
              echo $nameErr;
             return;
            }
          }
        
          if (empty($_POST["lname"])) {
            $nameErr = "Last Name is required";
            echo $nameErr;
             return;
          } else {
            $lname = test_input($_POST["lname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
              $nameErr = "Only letters and white space allowed";
              echo $nameErr;
             return;
            }
          }
          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            echo $nameErr;
             return;
          } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
              echo $nameErr;
             return;
            }
          }
          if (empty((int)$_POST["phone"])) {
            $nameErr = "phone is required";
            echo $nameErr;
             return;
          } else {
           $phone = test_input((int)$_POST["phone"]);
            // check if e-mail address is well-formed
            if (!is_int((int)$_POST['phone'])) {
              $nameErr = "Invalid phone format";
              echo $nameErr;
             return;
            }
          }

          
        $mysqli->query("INSERT INTO users (fname, lname, email, phone) VALUES('$fname', '$lname','$email','$phone')") or die($mysqli->error);
        header('location: index.php');
    }

