<?php
    session_start();
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
    <title>status consumer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <th>Complaint ID</th>
                    <th>Consumer ID</th>
                    <th>Submit date</th>
                    <th>Estimated date</th>
                    <th>Completion status</th>
        
                </thead>
                <tbody>
                    <?php
                     include('db.php');
                        $sql ="SELECT * FROM workstatus ORDER BY complaint_id DESC";
                        // echo $sql;
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
                                
                                $tr="<tr><td>$complaint_id</td><td>$consumer_id</td>".
                                "<td>$submit_date</td><td>$estimated_date</td><td>$competion_status</td></tr>";
                                
                                echo $tr;

                            }
                        }

                        $conn->close();
                        
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
