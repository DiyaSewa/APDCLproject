<?php
session_start();

// Check for session variable ( replace with your login logic )
if ( !isset( $_SESSION[ 'id' ] ) ) {
    header( 'login.php');
    // Redirect to login page

}
include( 'db.php' );

// Handle GET request for initial data display
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' ) {
    // Prepared state   ment for security

    $id = $_SESSION['id'];
    $empDataQuery = "SELECT * FROM employee WHERE id = ?";
    $stmtEmp = $conn->prepare($empDataQuery);
    
    if (!$stmtEmp) {
        die('Employee data query preparation failed: ' . $conn->error);
    }
    
    $stmtEmp->bind_param('s', $id);
    
    if (!$stmtEmp->execute()) {
        die('Employee data query execution failed: ' . $stmtEmp->error);
    }
    
    $empResult = $stmtEmp->get_result();

    if ($empRow = $empResult->fetch_assoc()) {

        $employeeSubdivision = $empRow['sub_division'];
        var_dump($employeeSubdivision);


        $stmt = $conn->prepare( "SELECT
        complaints.complaint_id,
        complaints.d_t_submit AS submit_date,
        customers.consumer_id,
        workstatus.estimated_date AS estm_date,
        workstatus.completion_status
        FROM
            complaints
        INNER JOIN
            customers ON complaints.consumer_id = customers.consumer_id
        LEFT JOIN
            workstatus ON complaints.complaint_id = workstatus.complaint_id
        WHERE
            customers.sub_division ='$employeeSubdivision' " );
    
        if (!$stmt) {
            die('Query preparation failed: ' . $conn->error);
        }
        
        if (!$stmt->execute()) {
            die('Query execution failed: ' . $stmt->error);
        }
        
        $result = $stmt->get_result();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Work Status</title>
<link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>
<style>
h1 {
    text-align: center;
    color: blue;
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

.primary {
    background-color: blue;
    display: inline-block;
    border-radius: 8px;
}

.secondary {
    background-color: blue;
    display: inline-block;
    border-radius: 8px;
}

.container,
.container-md,
.container-sm {
    width: 80% !important;
    padding: 2rem;
}
</style>

</head>

<body>
<div class = 'container'>
<h1>Work Status Authority</h1>
<table class = 'table table-bordered' id = 'table'>
<thead>
<tr>
<th>Complaint ID</th>
<th>Consumer ID</th>
<th>Submit Date</th>
<th>Estimated Date</th>
<th>Completion Status</th>
<th>Action</th>

</tr>
</thead>
<tbody>

<?php while ( $row = $result->fetch_assoc() ) :  ?>
<tr>
<td><?php echo $row[ 'complaint_id' ];
?></td>
<td><?php echo $row[ 'consumer_id' ];
?></td>
<td><?php echo $row[ 'submit_date' ];
?></td>
<td><input type = 'date' class = 'form-control' name = "estimated_date[<?php echo $row['complaint_id']; ?>]" value = "<?php echo $row['estm_date']; ?>"></td>
<td>
<select name = "completion_status[<?php echo $row['complaint_id']; ?>]" class = 'form-control'>
<option value = ''>Select</option>
<option value = 'Approved' <?php echo ( $row[ 'completion_status' ] == 'Approved' ) ? 'selected' : '';
?>>Approved</option>
<option value = 'Resolved' <?php echo ( $row[ 'completion_status' ] == 'Resolved' ) ? 'selected' : '';
?>>Resolved</option>
<option value = 'Under Review' <?php echo ( $row[ 'completion_status' ] == 'Under Review' ) ? 'selected' : '';
?>>Under Review</option>
<option value = 'Pending' <?php echo ( $row[ 'completion_status' ] == 'Pending' ) ? 'selected' : '';
?>>Pending</option>
<option value = 'Rejected' <?php echo ( $row[ 'completion_status' ] == 'Rejected' ) ? 'selected' : '';
?>>Rejected</option>

</select>
</td>
<td>
<button type = 'submit' class = 'btn btn-primary btn-sm' id = 'submit' value = 'submit' name = 'submit' onclick = "submitData(<?php echo $row['consumer_id']; ?>)">Update</button>
<!-- <button type = 'reset' class = 'btn-btn secondary btn-sm' id = 'clear' value = 'reset' name = 'reset'>Clear</button> -->
</td>
</tr>
<?php
endwhile;
?>

</tbody>
</table>

</div>
<script src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
<script src = 'script.js'></script>
<script>
<?php
// Display success or error message as an alert using JavaScript
if ( isset( $_SESSION[ 'success_message' ] ) ) {
    echo "alert('" . $_SESSION[ 'success_message' ] . "');";
    unset( $_SESSION[ 'success_message' ] );
    // Clear the session variable
}

if ( isset( $_SESSION[ 'error_message' ] ) ) {
    echo "alert('" . $_SESSION[ 'error_message' ] . "');";
    unset( $_SESSION[ 'error_message' ] );
    // Clear the session variable
}
?>
</script>
</body>

</html>