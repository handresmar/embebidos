$(document).ready(function() {
    var dataTable = $('#employee-grid').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "columnDefs": [
        { className: "dt-body-center", "targets": [ 0 ] }
        ],
        "ajax":{
        url :"data.php", // json datasource
        type: "post",  // method  , by default get
        error: function(){  // error handling
            $(".employee-grid-error").html("");
            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#employee-grid_processing").css("display","none");
        }
    }
} );
    setInterval( function () {
        dataTable.ajax.reload();
    }, 60000 );
} );