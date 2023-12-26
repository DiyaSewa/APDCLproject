<?php
session_start();
if (!isset($_SESSION['cid'])) {
    header('index.php');
}
include('db.php');
// var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rowDataArray'])) {
  $rowDataArray = json_decode($_POST['rowDataArray'], true);
  foreach ($rowDataArray as $rowData) {
      $complaintId = $rowData['complaintId'];
      $consumerId = $rowData['consumerId'];
      $submitDate = $rowData['submitDate'];
      $estimatedDate = $rowData['estimatedDate'];
      $completionStatus = $rowData['completionStatus'];

      $checkSql = "SELECT * FROM workstatus WHERE complaint_id='$complaintId'";
      $result = $conn->query($checkSql);
      if ($result->num_rows > 0) {
          // If the record exists, perform an update
          $updateSql = "UPDATE workstatus SET estimated_date='$estimatedDate', completion_status='$completionStatus' WHERE complaint_id='$complaintId'";
          if ($conn->query($updateSql) === TRUE) {
              echo "Record updated successfully";
              $_SESSION['success_message'] = "Record Updated successfully";
          } else {
              echo "Error updating record: " . $conn->error;
          }
      } else {

        $insertSql = "INSERT INTO workstatus (complaint_id, consumer_id, estimated_date,submit_date, completion_status) VALUES ('$complaintId', '$consumerId' ,'$estimatedDate','$submitDate', '$completionStatus')";
        var_dump($insertSql);
        if ($conn->query($insertSql) === TRUE) {
            echo "Record inserted successfully";
            $_SESSION['success_message'] = "Record Inseted successfully";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
      }
  }

  // Close the database connection
  $conn->close();
  header('Location: workstatusAuthority.php');
  exit(); // Stop further execution
}


?>
