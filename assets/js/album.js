$(document).ready(function () {

    //var selnbTitre = "#nbreTitres";
    var selListeTitres = "#listeTitres";

    var loopTemplate = $(selListeTitres).html();
    var nbTitres = 0;

    $(selListeTitres).find(".ligne-titre").first().remove();

    $("#addTitre").click(function(){
        var num = nbTitres + 1
        var titre = loopTemplate.replace(/###/g, num)
        $(selListeTitres).append(titre)
        nbTitres = num;
    });

    $(selListeTitres).on("click", ".remove-titre", function(){
        var item = $(this).closest(".ligne-titre");
        var index = $(selListeTitres).find(".ligne-titre").index(item);

        // Suppression de l'élément
        $(selListeTitres).find(".ligne-titre")[index].remove();

        var size = $(selListeTitres).find(".ligne-titre").length;

        for(var i = index; i < size; i++){
            // Mise à jour des autres éléments
            item  = $(selListeTitres).find(".ligne-titre")[i];
            var num = i + 1;

            var input = $(item).find("input").first();
            $(input).attr("name", "titre[" + num + "]");
            $(input).attr("placeholder", "Titre " + num);
        }

        nbTitres--;
    });

    /*
    $(selnbTitre).change(function(){
        modifyTitres();
    });

    // Fonctions


    function modifyTitres() {
        //On récupère la valeur du champ 
        var nbTitres =  parseInt ($(selnbTitre).val());
        //Dans éléments listTitres je récupère les éléments qui ont la classse row
        var selListTitres = "#listeTitres";
        //Nbre d'éléments dans listTitres
        var nbAffichage = $(selListTitres).find(".row").length;

        if (nbTitres < nbAffichage){
            var diff = nbAffichage - nbTitres;
            for(var i=0;i < diff;i++){
                $(selListTitres).find(".row").last().remove();
            }
        }else if(nbTitres > nbAffichage){
            var diff = nbTitres - nbAffichage;
            var seldivList = "#listTitres";
            for(var i=0;i < diff;i++){
                var num = nbAffichage + i+1;
                var div = " <div class='row'>\
                            <div class='form-group col-sm-12 col-md-offset-8 col-md-4'>\
                            <label for='date'>Titre "+num+"</label>\
                            <input type='text' id='nom' name='titres[]' class='form-control' placeholder='Titre n° "+num+"'\
                            value=''/>\
                            </div>\
                            </div> "
                $(selListTitres).append(div);
            }
        }
    }
    */

});


