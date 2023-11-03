// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable();
});

table
  .on('order.dt search.dt', function () {
    let i = 1;

    table
      .cells(null, 0, {
        search: 'applied',
        order: 'applied'
      })
      .every(function (cell) {
        this.data(i++);
      });
  })
  .draw();

