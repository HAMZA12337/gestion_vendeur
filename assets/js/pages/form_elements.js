$(document).ready(function(){
    $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $('input.autocomplete').autocomplete({
        data: {
            "Apple": null,
            "Microsoft": null,
            "Google": 'assets/images/google.png'
        }
    });
});
$('.datepicker').pickadate({
    format: 'yyyy-MM-dd'
});