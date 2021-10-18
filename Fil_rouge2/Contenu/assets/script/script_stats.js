// fichier tableau.js
$(document).ready(function () {
    var table = $('#tab').DataTable();

    $('#tab tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
 
    $('#lettre').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    } );
});