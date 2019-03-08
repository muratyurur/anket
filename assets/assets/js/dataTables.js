$(document).ready(function() {
    $('#datatable-responsive').DataTable({
        "language": {
            "url": "https://www.tuzlaanket.com/assets/assets/js/dtTurkish.json",
        },
        "responsive": true,
        "ordering": false,
        "bsort": false,
        "paging": false,
        "info": false,
        "searching": false,
        "fixedHeader": true
    });
    $('.table-responsive').DataTable({
        "language": {
            "url": "https://www.tuzlaanket.com/assets/assets/js/dtTurkish.json",
        },
        "responsive": true,
        "ordering": false,
        "bsort": false,
        "paging": false,
        "info": false,
        "searching": false,
        "fixedHeader": true
    });
} );