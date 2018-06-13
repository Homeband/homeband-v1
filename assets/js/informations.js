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

    var id_groupes = parseInt($("#AddMember_id_groupes").val());
    var url = api + 'groupes/' + id_groupes + "/membres";
    var listeMembres = $("#ListMembers").DataTable( {
        "ajax": {
            url: url,
            dataSrc: function (d) {
                return d.members;
            }
        },
        "columns": [
            { data: "nom" },
            { data: "prenom" },
            { data: "date_debut" },
            { data: "date_fin" },
            { data: function(d){
                var chaine = '<a class="btn btn-danger remove-member" id-groupe="' + id_groupes + '" + id-membres="' + d.id_membres + '" href="#"><i class="fa fa-times-circle fa-lg"></i></a>'

                    return chaine
            }}
        ]
    });

    $("#ListMembers").on("click", ".remove-member", function(){
        var id_membres = $(this).attr("id-membres");
        var url = api + "groupes/" + id_groupes + "/membres/" + id_membres

        $.ajax({
            url: url,
            type: 'DELETE',
            success: function(result) {
                listeMembres.ajax.reload();
            },
            data: "",
            dataType: "json"
        });
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

    $("#formAddMember").submit(function(e){
        e.preventDefault();

        var nom = $("#AddMember_nom").val();
        var prenom = $("#AddMember_prenom").val();
        var date_debut = $("#AddMember_date_debut").val();
        var date_fin = $("#AddMember_date_fin").val();
        var est_date = $("#AddMember_est_date").prop("checked") ? 1 : 0;

        var id_groupes = parseInt($("#AddMember_id_groupes").val());
        var url = api + 'groupes/' + id_groupes + "/membres";
        var membre = {
            'nom': nom,
            'prenom' : prenom,
            'date_debut': date_debut,
            'date_fin': date_fin,
            'est_date': est_date
        }

        var params = {'member' : membre };

        // Appel de la fonction jQuery (Ajax)
        $.post(url, params, function(data){
            listeMembres.ajax.reload();
        }, 'json');

        // Nettoyage des champs
        clearFormAddMember();

        $("#closeAddMember").click();
    });


    function clearFormAddMember(){
        $("#formAddMember").find("input[type=text],input[type=date]").val("");
        $("#formAddMember").find("input[type=checkbox]").prop("checked", false);
    }
});


