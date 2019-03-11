<script src="<?php echo base_url("assets"); ?>/assets/js/dataTables.js"></script>
<script type="text/javascript">
    $('#mahalle').on('change', function () {
        var mahalleID = this.val();

        if (mahalleID) {
            $.ajax({
                type: 'POST',
                url: <?php echo base_url('adres/get_sokak'); ?>,
                data: 'mahalle = ' + mahalleID,
                success: function (data) {
                    $('#sokak').html('<option value="">Sokak Seçiniz..</option>')
                    var dataObj = jQuery.parseJSON(data);
                    if (dataObj).
                    each(function () {
                        var option = $('<option />');
                        option.attr('value', this.id).text(this.name);
                        $('#sokak').append(option);
                    });
                } else {
                    $('#sokak').html('<option value="">Sokak Bulunamadı..</option>')
        }
        }
        }
    );
    } else
    {
        $('#sokak').html('<option value="">Lütfen önce mahalle seçiniz..</option>')
    }
    })
    ;
</script>