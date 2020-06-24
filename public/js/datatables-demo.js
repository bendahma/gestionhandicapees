// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "columnDefs": [
      { "width": "20%", "targets": 1 },
      { "width": "8%", "targets": 2 }
    ]
  });
});
