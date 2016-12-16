$(document).ready(function(){
    $('.dropdown-button').dropdown();
    $('select').material_select();
    Materialize.fadeInImage('.fade-image');
});

var currentTime = new Date();

$('#data-evento-inicio').pickadate({
    monthsFull: [ 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ],
    monthsShort: [ 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez' ],
    weekdaysFull: [ 'domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado' ],
    weekdaysShort: [ 'dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab' ],
    today: 'hoje',
    clear: 'limpar',
    close: 'fechar',
    //format: 'dddd, d !de mmmm !de yyyy',
    format: 'dd/mm/yyyy',
    formatSubmit: 'yyyy/mm/dd',
    min: currentTime
    //selectMonths: true // Creates a dropdown to control month
    //selectYears: 5 // Creates a dropdown of 15 years to control year
});

$('#data-evento-termino').pickadate({
    monthsFull: [ 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ],
    monthsShort: [ 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez' ],
    weekdaysFull: [ 'domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado' ],
    weekdaysShort: [ 'dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab' ],
    today: 'hoje',
    clear: 'limpar',
    close: 'fechar',
    //format: 'dddd, d !de mmmm !de yyyy',
    format: 'dd/mm/yyyy',
    formatSubmit: 'yyyy/mm/dd',
    min: currentTime
    //selectMonths: true, // Creates a dropdown to control month
    //selectYears: 5 // Creates a dropdown of 15 years to control year
});