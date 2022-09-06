// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.bootstrap-data-table-export').DataTable({
  	
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-download"></i>',
                title: 'Lista de produtos cadastrados',
                filename: 'Produtos cadastrados',
                titleAttr: 'Exportar para PDF',
                className: 'btn btn-primary btn-sm',
                orientation: 'portrait',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ],
        'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': ['no-sort']
            }],
  });
});