
function submitData(consumerId) {
  // Create an array to store the data from each row
  const rowDataArray = [];

  // Select all table rows in the tbody
  const tableRows = document.querySelectorAll('tbody tr');

  // console.log(tableRows);
  // Loop through each row
  tableRows.forEach(row => {
    // Extract data from each cell in the row
    const complaintId = row.cells[0].textContent;
    const submitDate = row.cells[2].textContent;
    const estimatedDate = row.cells[3].querySelector('input').value;
    const completionStatus = row.cells[4].querySelector('select').value;

    // Create an object to represent the row data
    const rowData = {
      complaintId: complaintId,
      submitDate: submitDate, 
      consumerId: consumerId,
      estimatedDate: estimatedDate,
      completionStatus: completionStatus
    };

    // Add the row data to the array
    rowDataArray.push(rowData);
     // Create a form element
    const form = document.createElement('form');
    form.method = 'post';
    form.action = 'update_work_status.php';

    // Create an input field for the rowDataArray
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'rowDataArray';
    input.value = JSON.stringify(rowDataArray);

    // Append the input field to the form
    form.appendChild(input);

    // Append the form to the body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  });

}
