$(document).ready(function () {

    var url_api = 'http://localhost/homeband-api/api/';

    $("#code_postal").keyup(function(){
        cp =  $("#code_postal").val();
        if(cp.length < 4){
            $('#villes').empty();
        } else {
            updateVilles();
        }
    });

    function updateVilles() {
        var id_select = "#villes";
        var id_cp = "#code_postal";

        var cp = $(id_cp).val();
        var url = url_api + 'villes';
        var params = {'cp' : cp};

        // Appel de la fonction jQuery (Ajax)
        $.get(url, params, function(data){
            // 1 - Vider le champs SELECT
            $(id_select).empty();

            // 2 - Remplissage avec les nouvelles valeurs
            for(var key in data.liste){
                var ville = data.liste[key];

                var nom = ville.nom;
                var id_villes = ville.id_villes;

                $(id_select).append('<option value="' + id_villes + '">' + nom + '</option>');
            }
        }, 'json');

    }
$("#formInscription").submit(function(e){
    var statutCu = $("#checkCU").prop("checked");
    if(statutCu==false){
        alert("Vous devez accepeter les conditions d'utilisations");
        return false;
    }


})
});


