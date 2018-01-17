$(document).ready(function () {

    var selVilles = "#villes";
    var selCP = "#code_postal";
    var selCU = "#checkCU";
    var selForm = "#formInscription";

    updateVilles();

    $(selCP).keyup(function(){

            updateVilles();
    });

    $(selForm).submit(function(e){
        var statutCu = $(selCU).prop("checked");
        if(statutCu==false){
            alert("Vous devez accepter les conditions d'utilisations");
            return false;
        }
    });

    // Fonctions

    function updateVilles() {
        var cp =  $(selCP).val();
        if(cp.length < 4){
            $(selVilles).empty();
            $(selVilles).append('<option value="0">Entrez un code postal</option>')
            $(selVilles).prop("disabled", true);
        } else {

            var cp = $(selCP).val();
            var url = api + 'villes';
            var params = {'cp' : cp};

            // Appel de la fonction jQuery (Ajax)
            $.get(url, params, function(data){
                // 1 - Vider le champs SELECT
                $(selVilles).empty();
                $(selVilles).prop("disabled", false);

                // 2 - Remplissage avec les nouvelles valeurs
                for(var key in data.villes){
                    var ville = data.villes[key];

                    var nom = ville.nom;
                    var id_villes = ville.id_villes;

                    $(selVilles).append('<option value="' + id_villes + '">' + nom + '</option>');
                }
            }, 'json');
        }
    }

});


