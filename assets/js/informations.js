$(document).ready(function () {

    var selVilles = "#villes";
    var selCP = "#code_postal";

    var id_villes_courant = $("#id_villes").val();
    if(id_villes_courant > 0){
        $(selVilles + ' option[value="' + id_villes_courant + '"]').prop("selected", true);
    }

    updateVilles();

    $(selCP).keyup(function(){
        updateVilles();
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

                var selected = ''

                // 2 - Remplissage avec les nouvelles valeurs
                for(var key in data.villes){
                    var ville = data.villes[key];

                    var nom = ville.nom;
                    var id_villes = ville.id_villes;

                    if(id_villes == id_villes_courant){
                        selected = 'selected';
                    } else {
                        selected = '';
                    }

                    $(selVilles).append('<option value="' + id_villes + '" ' + selected + '>' + nom + '</option>');
                }
            }, 'json');
        }
    }

});


