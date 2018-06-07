$(document).ready(function () {

    var selnbTitre = "#nbreTitres";
    
    $(selnbTitre).change(function(){
       modifyTitres();
    });


    // Fonctions
    function modifyTitres() {
        //On récupère la valeur du champ 
        var nbTitres =  parseInt ($(selnbTitre).val());
        //Dans éléments listTitres je récupère les éléments qui ont la classse row
        var selListTitres = "#listTitres";
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
                            <input type='text' id='nom' name='nom' class='form-control' placeholder='Titre n° "+num+"'\
                            value=''/>\
                            </div>\
                            </div> "
                $(selListTitres).append(div);
            }
        }
    }

});


