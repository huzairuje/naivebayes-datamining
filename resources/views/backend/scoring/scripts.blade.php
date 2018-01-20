<script type="text/javascript">
$(function(){
    $('.table-datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route($route.".datatables") !!}',
        columns: [
            {data: 'no', searchable: false, width: '5%', className: 'center'},
            {data: 'pengeluaran'},
            {data: 'penghasilan'},
            {data: 'pekerjaan'},
            {data: 'status_kawin'},
            {data: 'score'},
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
    $(document).on("click", "#hitung", function(){
        if($("#penghasilan").val() != "" && $("#pengeluaran").val() != "" && $("#pekerjaan").val() != "" && $("#status_kawin").val() != ""){
            var penghasilan = $("#penghasilan").val();
            var pengeluaran = $("#pengeluaran").val();
            var pekerjaan = $("#pekerjaan").val();
            var status_kawin = $("#status_kawin").val();

            $.ajax({
                url: "{{ route($route.'.hitung') }}",
                type: "GET",
                data:{
                    'penghasilan': penghasilan,
                    'pengeluaran': pengeluaran,
                    'pekerjaan': pekerjaan,
                    'status_kawin': status_kawin
                },
                success: function(data){
                    if(data.error === 0 ){
                        $("#score").html('<center><h3 class="jumbotron">'+data.result+"</h3></center>");
                    }
                }
            });
        }
    });
    
});
</script>
