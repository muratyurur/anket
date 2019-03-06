<script src="<?php echo base_url("assets"); ?>/assets/js/news.js"></script>
<script src="<?php echo base_url("assets"); ?>/assets/js/dataTables.js"></script>

<script>
    $(document).ready(function () {

        if ($('#radio3_1').is(':checked')) {
            $('.memnuniyet').show();
            $('.tuzlakart').show();
            $('.gorusulen-container').show();
            $('.talep').show();
            $('#radio2_51').hide();
            $('#radio2_5').prop("checked", false);
            $('#radio1_21').hide();
            $('#radio1_2').prop("checked", false);
        } else if ($('#radio3_5').is(':checked')) {
            $('.memnuniyet').show();
            $('.tuzlakart').show();
            $('.gorusulen-container').show();
            $('.talep').show();
            $('#radio2_51').hide();
            $('#radio2_5').prop("checked", false);
            $('#radio1_11').hide();
            $('#radio1_21').hide();
            $('#radio1_31').hide();
            $('#radio1_41').hide();
            $('#radio1_2').prop("checked", false);
        } else {
            $('.memnuniyet').hide();
            $('.tuzlakart').hide();
            $('.gorusulen-container').hide();
            $('.talep').hide();
        }

        $(document).on('change', '.durum', function () {
            var d = $('input[type=radio][name=durumoptions]:checked').val();
            if (d == "G") {

                $('.memnuniyet').fadeIn();
                $('.tuzlakart').fadeIn();


                $('#radio1_11').fadeIn();
                $('#radio1_21').hide();
                $('#radio1_31').fadeIn();
                $('#radio1_41').fadeIn();
                $('#radio1_51').hide();

                $('#radio2_11').fadeIn();
                $('#radio2_21').fadeIn();
                $('#radio2_31').fadeIn();
                $('#radio2_41').fadeIn();
                $('#radio2_51').hide();

                $('.gorusulen-container').fadeIn();
                $('.talep').fadeIn();

            } else if (d == "B") {

                $('#radio1_11').hide();
                $('#radio1_21').fadeIn();
                $('#radio1_31').hide();
                $('#radio1_41').fadeIn();
                $('#radio1_51').hide();

                $('#radio2_11').hide();
                $('#radio2_21').hide();
                $('#radio2_31').hide();
                $('#radio2_41').hide();
                $('#radio2_51').fadeIn();

                $('.gorusulen-container').hide();
                $('.talep').hide();

                $('.memnuniyet').hide();
                $('.tuzlakart').hide();

                $('#checkstar').prop("checked", false);

            } else if (d == "A") {

                $('#radio1_11').hide();
                $('#radio1_21').fadeIn();
                $('#radio1_31').hide();
                $('#radio1_41').fadeIn();
                $('#radio1_51').hide();

                $('#radio2_11').hide();
                $('#radio2_21').hide();
                $('#radio2_31').hide();
                $('#radio2_41').hide();
                $('#radio2_51').fadeIn();

                $('.gorusulen-container').hide();
                $('.talep').hide();

                $('.memnuniyet').hide();
                $('.tuzlakart').hide();

                $('#checkstar').prop("checked", false);

            } else if (d == "R") {

                $('#radio1_11').hide();
                $('#radio1_21').hide();
                $('#radio1_31').fadeIn();
                $('#radio1_41').fadeIn();
                $('#radio1_51').hide();

                $('#radio2_11').hide();
                $('#radio2_21').hide();
                $('#radio2_31').hide();
                $('#radio2_41').fadeIn();
                $('#radio2_51').hide();

                $('.gorusulen-container').hide();
                $('.talep').hide();

                $('.memnuniyet').hide();
                $('.tuzlakart').hide();

                $('#checkstar').prop("checked", false);

            } else if (d == "T") {

                $('#radio1_11').hide();
                $('#radio1_21').hide();
                $('#radio1_31').hide();
                $('#radio1_41').hide();
                $('#radio1_51').fadeIn();
                $('#radio1_51').prop("checked", true);

                $('#radio2_11').fadeIn();
                $('#radio2_21').fadeIn();
                $('#radio2_31').fadeIn();
                $('#radio2_41').fadeIn();
                $('#radio2_51').hide();

                $('.gorusulen-container').fadeIn();
                $('.talep').fadeIn();

                $('.memnuniyet').fadeIn();
                $('.tuzlakart').fadeIn();

            }
        })

        $(document).on('change', '.tuzlakart', function () {
            var t = $('input[type=radio][name=tuzlakartoptions]:checked').val();
            if (t == "I")
            {
                $('#checkstar').hide();
                $('#checkstar').prop("checked", false);
            }
        })
    })
</script>
