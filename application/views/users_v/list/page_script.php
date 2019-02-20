<script>
    $(document).ready(function() {
        $('#datatable-responsive').DataTable({
            "language": {
                "url": "https://www.tuzlaanket.com/assets/assets/js/dtTurkish.json",
            },
            "responsive": true,
            "pageLength": 25,
            "order": [[ 0, "asc" ],[ 1, "asc" ]]
        });
    } );
</script>