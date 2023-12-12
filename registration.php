<!DOCTYPE html>
<html lang="en">
    <head>
        <title> registration file </title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
       <style type="text/css">
        form{
            padding: 5px;
        }
        #Consumer_id,#Name,#Phone_no,#Email,#Address,#City,#Location,#pincode,#sub_division,#Password{
            width:70%;
        }
       </style>
    </head>
    <body class="container">
        <h3 style="color:blue;">Register yourself</h3>
 <hr>
 <div class="class">
    <?php
    if(!empty($error_msg))
    echo $error_msg;
?>
 </div>
            <form method="post" >
                    <label for ="Consumer_id"  class="form-label">Consumer_id</label></t>
                <input type="text" class="form-controls" name ="Consumer_id" id="Consumer_id" required> </br>
        
                <label  for ="Name" class="form-label">Name:</label></t>
                <input type="text" class="form-controls" name ="Name" id="Name" required> </br>
                
                <label  for ="Email" class="form-label">Email:</label>
            <input type="email" class="form-controls" name="Email" id="Email"required></br>

                <label for ="Phone_no" class="form-label"> Phone_no:</label>
            <input type ="number" class="form-controls" name="Phone_no" id="Phone_no" required></br>

            <label for ="Address" class="form-label">Address:</label>
            <input type="text" class ="form- controls" name ="Address" id="Address" required></br>

            <label for ="City" class="form-label">City:</label>
            <input type="text" class ="form- controls" name ="City"id="City" required></br>

            <label for ="pincode" class="form-label">pincode:</label>
            <input type="number" class ="form- controls" name ="pincode"id="pincode" required></br>
      
            <label for ="sub_division"class="form-label">sub_division:</label>
            <input type="text" class ="form-controls" name="sub_division"id="sub_division" required></br>

            <label for="Password"  class="form-label">Passsword:</label>
            <input type="password"class="form-controls" name ="Password"id="Password" required></br>
            </div>
            <div class="mb-3">
            <button type ="submit" class="btn-btn primary" id ="submit" value="submit" name="submit">submit</button>
            <button type ="reset" class="btn-btn secondary" id ="clear" value="clear" >Clear</button>
        </div>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<!-- begi -->
        <?php
        $error_msg = "";
    
        if(isset($_POST['submit']))
        {
            
            //  consumer id to the database
            if(isset($_POST['Consumer_id']) && !empty($_POST['Consumer_id']))
            $Consumer_id = $_POST['Consumer_id'];
        else
            $error_msg .= "Error: Consumer_id should not be empty.<br>";
            
         //  consumer name to the database
            if(isset($_POST['Name']) && !empty($_POST['Name']))
                $Name = $_POST['Name'];
            else
                $error_msg .= "Error: Name should not be empty.<br>";

         //  Consumer Email to the database
            if(isset($_POST['Email']) && !empty($_POST['Email']))
                $Email = $_POST['Email'];
            else
                $error_msg .= "Error: Email should not be empty.<br>";


             //  Phone no to the database
             if(isset($_POST['Phone_no']) && !empty($_POST['Phone_no']))
             $Phone_no = $_POST['Phone_no'];
         else
             $error_msg .= "Error: Phone no should not be empty.<br>";

            //  Address to the database
            if(isset($_POST['Address']) && !empty($_POST['Address']))
            $Address = $_POST['Address'];
        else
            $error_msg .= "Error: address should not be empty.<br>";
         //  City to the database
         if(isset($_POST['City']) && !empty($_POST['City']))
         $City = $_POST['City'];
     else
         $error_msg .= "Error: city should not be empty.<br>";
 
          //  pincode to the database
          if(isset($_POST['pincode']) && !empty($_POST['pincode']))
          $pincode = $_POST['pincode'];
      else
          $error_msg .= "Error: pincode should not be empty.<br>";

        //  sub_division to the database
        if(isset($_POST['sub_division']) && !empty($_POST['sub_division']))
        $sub_division = $_POST['sub_division'];
    else
        $error_msg .= "Error:subdivision should not be empty.<br>";

         // password ro the database
            if(isset($_POST['Password']) && !empty($_POST['Password']))
                $Password = $_POST['Password'];
            else
                $error_msg .= "Error: Password should not be empty.<br>"; 

        //   inserting the values 
        if(!strlen($error_msg))
        {
                $sql = "INSERT INTO customers (Consumer_id, Name, Email,Phone_no,Address,City,pincode,sub_division,Password) ".
                "VALUES ('$Consumer_id', '$Name','$Email','$Phone_no','$Address','$City','$pincode','$sub_division','$Password')";

            include('db.php');
            $conn->query($sql);
            if($conn->errno)
            {
                $error_msg .= $conn->error;
            }
             else {
                echo "User Registration Successfull.";
            }
            $conn->close();
        
        }
        }    
        ?>
      </body>
    </html>
      </body>
</html>