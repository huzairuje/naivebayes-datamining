<script type="text/javascript">
$(function(){
    $('.table-datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route($route.".datatables") !!}',
        columns: [
            {data: 'no', searchable: false, width: '5%', className: 'center'},
            {data: 'name'},
            {data: 'description'},
            {data: 'action', orderable: false, searchable: false, width: '15%', className: 'center action'},
        ],
        drawCallback: function(){
            INIT.tooltip();
        },
    });

    $(document).on('click', '.primary', function(){
        var checkbox = $(this).parents('ul.action').find('input[type="checkbox"]');
        if ($(this).is(':checked')) {
            $(checkbox).prop('checked', true);
            $(checkbox).not(this).attr('disabled', false);
        } else {
            $(checkbox).prop('checked', false);
            $(checkbox).not(this).attr('disabled', true);
        }
    });

    $(document).on('click', '.check_all', function(){
        var checkbox = $(this).parents('.list-group-item').next('.children').find('input[type="checkbox"]');
        if ($(this).is(':checked')) {
            $(checkbox).prop('checked', true);
            $(checkbox).not('.primary').not('.check_all').attr('disabled', false);
        } else {
            $(checkbox).prop('checked', false);
            $(checkbox).not('.primary').not('.check_all').attr('disabled', true);
        }
    });
});
</script>
