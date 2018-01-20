<script type="text/javascript">
$(function(){
    $(document).on('change', '#avatar', function(){
        CALL.previewImage(this, '.profile-user-img');
    });

    $(document).on('click', '.change-avatar', function(){
        $('#avatar').click();
    });
});
</script>
