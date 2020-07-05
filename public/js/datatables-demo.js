// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "columnDefs": [
      { "width": "0%", "targets": 1 },
      { "width": "8%", "targets": 2 }
    ]
  });
});
// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTableRe').DataTable({
    "columnDefs": [
      { "width": "0%", "targets": 1 },
      { "width": "0%", "targets": 5 }
    ]
  });
});
