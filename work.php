<?php
    session_start();
    include('db.php');
    if(!isset($_SESSION['cid']))
    {
        header('index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workstatus Authority</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
    <style>
        h1{
           text-align:center;
        }
        .btn-btn {
                border: none;
                color: white;
                padding: 9px 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 7px 2px;
                cursor: pointer;
            }
            .primary{background-color:blue; display: inline-block;
            border-radius: 8px;}
            .secondary{background-color:blue; display: inline-block;
            border-radius: 8px;}
        </style>
</head>
<body>
<div class="container mt-3">
        
        <h1>Workstatus Authority</h1>
    
            <hr>
            <div class="row mb-3">
                <div class="col-md-10">
                <a class="btn-btn primary" href="index.php"> Home</a>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    <!-- the table to be sent to customer -->
    <div class="container">
    <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                <form method="get">
                    
                  
                        <th>Complaint ID</th>
                        <th>Consumer ID</th>
                        <th>Submit date</th>
            </form>
        
                        
                        <th><label for="estimated_date" class="form-label">Estimated_date</label>
                        <input type="date" id="estimated_date" name="estimated_date" ></th> -->
                         <!-- <button type="submit">Submit</button>-->
               
                
             <th><label for="completion_status" class="form-label">Completion_status</label></th>
                     <th>  <select class="form-select" name="completion_status" id="completion_status" required>
                            <option value="Approved" selected>Approved</option>
                            <option value="In progress">In Progress</option>
                            <option value="Under Review'">Under Review</option>
                            <option value="Pending">Pending</option>
                            <option value="Resolved">Resolved</option>
                        </select>
                    </th>
                    <div class="mb-3">
          <th>  <button type ="submit" class="btn-btn primary" id ="submit" value="submit" name="submit">Submit</button>
            <button type ="reset" class="btn-btn secondary" id ="clear" value="clear" >Clear</button></th> 
        </tr>
</div>
                </div>
                </thead>
                <tbody>
</form>
 <!-- jquery  -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    // Initialize datepicker
    $(function() {
        $("#estimated_date").datepicker();
    });
</script>


                <?php
                    $sql="SELECT Consumer_id,
                    FROM customers
                    NATURAL JOIN workstatus";

                    $sql="SELECT complaint_id,d_t_submit
                    FROM complaint
                    NATURAL JOIN workstatus";

                 $sql="SELECT estimated_date,completion_status FROM workstatus";
            // $user = $_SESSION['complaint_id'];
            include('db.php');

                    
              if ($_SERVER["REQUEST_METHOD"] == "GET"){
                    // include ('db.php');
                    if(isset($_GET)!= 'all'){
                    $complaint_id=$_GET['complaint_id'];
                    $consumer_id = $_GET['Consumer_id '];  // Add appropriate default value or handle this case
                    $submit_date = $_GET['d_t_submit'];
                    // $estimated_date="";
                    // $competion_status="";
                    }
                }
                
            //   if ($_SERVER["REQUEST_METHOD"] == "POST"){
            //     if(isset($_POST)){
            //         $estimated_date="";
            //         $competion_status="";
            //     }
            // }
             
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
                $estimated_date = $_POST['estimated_date'];
                $completion_status = $_POST['completion_status'];
            
                $sql = "INSERT INTO workstatus(estimated_date, completion_status)".
                "VALUES ('$estimated_date','$completion_status')";
        // SQL command to insert data into the table
            $insertQuery = "INSERT INTO workstatus(estimated_date,completion_status)".
        "VALUES ('$estimated_date','$completion_status')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Record added successfully";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}
                    
                    // $sql ="SELECT * FROM workstatus order by complaint_id desc";
                    $sql ="SELECT * FROM workstatus ";
                    $sql ="SELECT * FROM workstatus order by complaint_id desc";
                    $result = $conn->query($sql);
                    if($conn->errno)
                        die( "Error: ". $conn->error );
                    if(!$result->num_rows)
                        echo '<tr><td colspan="5" class="text-center text-danger">No status to be shown</td></tr>';
                    else {
                        while($row = $result->fetch_assoc()) {
                            $complaint_id = $row['complaint_id'];
                            $consumer_id = $row['consumer_id'];
                            $submit_date = $row['submit_date'];
                            $estimated_date = $row['estimated_date'];
                            $competion_status = $row['completion_status'];
                            
                            
                            $tr="<tr><td>$complaint_id</td><td>$consumer_id</td><td>$submit_date</td></tr>";
                    //    <div class="mb-3">

            $tr.='<th><td><a href button type ="submit" class="btn-btn primary" id ="submit" value="submit" name="submit">Submit</button>
               <button type ="reset" class="btn-btn secondary" id ="clear" value="clear" >Clear</button></th> 
           </td>';
                            
                        
                            
                            echo $tr;

                        }
                        
                            $conn->close();
                    }
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
    </html>
    
                
            <!-- // $sql="SELECT estimated_date,completion_status FROM workstatus";
            // $sql = "INSERT INTO workstatus(estimated_date, completion_status)".
            // "VALUES ('$estimated_date','$completion_status')";
            

              

                    // }
                    // $sql="SELECT Consumer_id
                    // FROM customers
                    // NATURAL JOIN workstatus";

                    // $sql="SELECT complaint_id,d_tsubmit
                    // FROM complaint
                    // NATURAL JOIN workstatus";

                // }

                    // $sql="SELECT* FROM workstatus";
                    // if ($conn->query($sql) === TRUE) {
                    // echo "Record added successfully"; 
                    // $tr="<tr><td>$complaint_id</td><td>$consumer_id</td><td>$submit_date</td><td>$estimated_date</td>".
                    // "<td>$completion_status</td></tr>";
                    // echo $tr;
                    // }
                    // else {
                    // echo "Error: " . $sql . "<br>" . $conn->error;
                    // }
                
                    // $conn->close();

             -->
             <!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Form</title>
</head>
<body>
    <form id="complaintForm">
         Displayed complaint data using PHP -->
        <?php
            // Replace with your database credentials
            $servername = "your_server";
            $username = "your_username";
            $password = "your_password";
            $dbname = "your_database";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "
                SELECT c.complaint_id, c.d_t_submit, c.consumer_id, w.estimated_date, w.completion_status
                FROM complaints c
                JOIN workstatus w ON c.complaint_id = w.complaint_id
            ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <div>
                            <input type='hidden' name='complaint_id[]' value='{$row['complaint_id']}'>
                            <label>Consumer ID:</label>
                            <input type='text' name='consumer_id[]' value='{$row['consumer_id']}'>
                            <label>Submit Date:</label>
                            <input type='text' name='submit_date[]' value='{$row['d_t_submit']}'>
                            <label>Estimated Date:</label>
                            <input type='text' name='estimated_date[]' value='{$row['estimated_date']}'>
                            <label>Completion Status:</label>
                            <input type='text' name='completion_status[]' value='{$row['completion_status']}'>
                        </div>
                    ";
                }
            }

            $conn->close();
        ?>
        <button type="button" onclick="submitForm()">Submit</button>
    </form>

    <script>
        function submitForm() {
            var form = document.getElementById("complaintForm");
            var formData = new FormData(form);

            // Use AJAX to submit the form data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "submit.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response if needed
                    console.log(xhr.responseText);
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html> 
