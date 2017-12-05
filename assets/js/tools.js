// Variables globales JS
var api = 'http://localhost/homeband-api/api/';

$(document).ready(function(){

    // Récupération de l'emplacement du fichier actuel
    var jsPath = $('script[src*=tools]').attr('src').replace('tools.js', '');
    var datatable_french = jsPath + '/localisation/fr_FR.json';

    $.extend(true, $.fn.dataTable.defaults, {
        'language': {
            'url' : datatable_french
        }
    });


});