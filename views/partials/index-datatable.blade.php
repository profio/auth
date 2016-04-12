@section('end-head')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/iCheck/flat/blue.css') }}">
@append

@section('end-body')
<script type="text/javascript" src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript">
    function iCheckInit()
    {
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    }

    var datatable;

    $(document).ready(function(){
        var table = $('.datatable');
        datatable = table.DataTable({
            "dom": "<'col-md-2 col-sm-6'l><'col-md-5 col-sm-6'f><'col-sm-12'<'table-responsive'rt>><'col-sm-6'i><'col-sm-6'p>",
            "order": [[ 1, "asc" ]],
            "columnDefs": [ { "targets": 'no-sort', "searchable": false, "orderable": false, "visible": true } ]
        });

        iCheckInit();

        $('.datatable').on('draw.dt', function () {
            iCheckInit();
        });

        $('.checkbox-check').click(function(){
            $("input[type='checkbox']", "#index").iCheck("check");
        });

        $('.checkbox-uncheck').click(function(){
            $("input[type='checkbox']", "#index").iCheck("uncheck");
        });
    });
</script>
@append
