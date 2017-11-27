$(document).ready(function () {


    $("#code_postal").on("change", function(){
        updateVilles()
    });

    function updateVilles() {
        var id_select = "#villes";
        var id_cp = "#code_postal";

        var cp = $(id_cp).val();
        var url = 'http://localhost/homeband/Villes/getByCodePostal';
        var params = {'code_postal' : cp};

        // Appel de la fonction jQuery (Ajax)
        $.post(url, params, function(data){
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


