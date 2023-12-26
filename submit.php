<?php
session_start();

// Check for session variable (replace with your login logic)
if (!isset($_SESSION['cid'])) {
    header('index.php'); 
    
}

include('db.php');

// Prepared statement for security
$stmt = $conn->prepare("SELECT
    complaints.complaint_id,
    complaints.d_t_submit AS submit_date,
    customers.Consumer_id,
    workstatus.estimated_date,
    workstatus.completion_status
FROM complaints
INNER JOIN customers ON complaints.consumer_id = customers.consumer_id
INNER JOIN workstatus ON complaints.complaint_id = workstatus.complaint_id");
if (!$stmt) {
  die("Query preparation failed: " . $conn->error);
}

if (!$stmt->execute()) {
  die("Query execution failed: " . $stmt->error);
}
else{
$result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Work Status</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

<table class="table"> <thead>
        <tr>
            <th>Complaint ID</th>
            <th>Consumer ID</th>
            <th>Submit Date</th>
            <th>Estimated Date</th>
            <th>Completion Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['complaint_id']; ?></td>
            <td><?php echo $row['Consumer_id']; ?></td>
            <td><?php echo $row['submit_date']; ?></td>
            <td><input type="date" name="estimated_date[<?php echo $row['complaint_id']; ?>]" value="<?php echo $row['estimated_date']; ?>"></td>
            <td>
                <select name="completion_status[<?php echo $row['complaint_id']; ?>]">
                    <option value="Approved" <?php echo ($row['completion_status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                    <option value="In Progress" <?php echo ($row['completion_status'] == 'In Progress') ? 'selected' : ''; ?>>In progress</option>
                    <option value="Under Review" <?php echo ($row['completion_status'] == 'Under Review') ? 'selected' : ''; ?>>Under Review</option>
                    <option value="Pending" <?php echo ($row['completion_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            
                </select>
            </td>
        </tr>
        <?php 
        endwhile;
         ?>
    </tbody>
</table>
<button onclick="submitData()">Submit</button>

</body>
</html>
