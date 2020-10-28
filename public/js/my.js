/**
 * Created by kamel on 04/12/2016.
 */




/******Liste de type formation*******/

function charger_type(){
    $("#TYPE_FORMATION").change(function() {
        if ($(this).data('options') == undefined) {
            /*Taking an array of all options-2 and kind of embedding it on the select1*/
            $(this).data('options', $('#DIPLOME option').clone());
        }
        var id = $(this).val();
        var options = $(this).data('options').filter('[value=' + id + ']');
        $('#DIPLOME').html(options);
    });
}


function charger_diplomes() {

    var url      = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token= $("[name='_token']").val();

    var cat= $("#TYPE_FORMATION").val();

    $.ajax({
        type:'GET',
        url:url+'/getDiplomes',
        data:'_token ='+token+'&cat='+cat,
        success:function(data){
            var options='';
            $.each(data, function(index, element) {
                options =options + '<option value="'+element.id+'">'+ element.LIBELLE+'</option>';
            });
          //  console.log(options);
            if(data.length>0){
                $('#DIPLOME').find('option').remove().end().append(options);
            }else {
                $('#DIPLOME').find('option').remove().end().append('<option value="0">AUTRE</option>');
            }
        }
    });
}

function calculer_total_formation(){
   if($('#DI').val().length !== 0 && $('#DE').val().length !== 0  && $('#NB').val().length !== 0  && $('#PU').val().length !== 0 ){
       var total = 0;
       total += parseFloat($('#DI').val());
       console.log(total);
       total += parseFloat($('#DE').val());
       console.log(total);
       total += parseFloat($('#NB').val()) * parseFloat($('#PU').val());
       console.log(total);
       $("#TOTAL").val(parseFloat(total).toFixed(3));
       $("#TOTAL").css('color','red');
   }
    else
   {
       //console.log('hhh');
   }
}

function charger_diplomes_edit() {

    var url = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token = $("[name='_token']").val();

    var cat = $("#TYPE_FORMATION_EDIT").val();

    $.ajax({
        type: 'GET',
        url: url + '/getDiplomes',
        data: '_token =' + token + '&cat=' + cat,
        success: function (data) {
            var options = '';
            $.each(data, function (index, element) {
                options = options + '<option value="' + element.id + '">' + element.LIBELLE + '</option>';
            });
            //console.log(options);
            if (data.length > 0) {
                $('#DIPLOME').find('option').remove().end().append(options);
            } else {
                $('#DIPLOME').find('option').remove().end().append('<option value="0">AUTRE</option>');
            }
        }
    });
    }

function calculer_total_formation_edit(){
    if($('#DIE').val().length !== 0 && $('#DEE').val().length !== 0  && $('#NBE').val().length !== 0  && $('#PUE').val().length !== 0 ){
        var totale = 0;
        totale += parseFloat($('#DIE').val());
        console.log(totale);
        totale += parseFloat($('#DEE').val());
        console.log(totale);
        totale += parseFloat($('#NBE').val()) * parseFloat($('#PUE').val());
        console.log(totale);
        $("#TOTALE").val(parseFloat(totale).toFixed(3));
        $("#TOTALE").css('color','red');
    }
    else
    {
        //console.log('hhh');
    }
}
/*********************************************************************/
function charger_sessions_etudiant(){

    var url      = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token= $("[name='_token']").val();

    var ETUDIANT= $("#ETUDIANT").val();

    $.ajax({
        type:'GET',
        url:url+'/getSESSION',
        data:'_token ='+token+'&ETUDIANT='+ETUDIANT,
        success:function(data){
            var options='<option value="0">Selectionner session</option>';
            $.each(data, function(index, element) {
                options =options +'<option value="'+element.id+'">'+ element.LIBELLE+'</option>';
                //console.log(options);
                //placeholder
            });
             //console.log(data);
            if(data.length>0){

               $('#SESSION_ETUDIANT').find('option').remove().end().append(options);
            }else {
                $('#SESSION_ETUDIANT').find('option').remove().end().append('<option value="0">AUTRE</option>');
            }
            // console.log(options);
        }
    });

}


function charger_formation_etudiant(){

    var url      = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token= $("[name='_token']").val();

    var SESSION_ETUDIANT= $("#SESSION_ETUDIANT").val();
    var ETUDIANT= $("#ETUDIANT").val();

    $.ajax({
        type:'GET',
        url:url+'/getFORMATION',
        data:'_token ='+token+'&ETUDIANT='+ETUDIANT+'&SESSION_ETUDIANT='+SESSION_ETUDIANT,
        success:function(data){
            var options='<option value="0" selected>Selectionner formation</option>';
            $.each(data, function(index, element) {
                options =options +'<option value="'+element.id+'">'+ element.LIBELLE+'</option>';
                //console.log(options);
                //placeholder
            });
          //  console.log(data);
            if(data.length>0){

                $('#DIPLOME_ETUDIANT').find('option').remove().end().append(options);

            }else {
                $('#DIPLOME_ETUDIANT').find('option').remove().end().append('<option value="0">AUTRE</option>');
            }
            // console.log(options);
        }
    });

}

/********************************************************/
function charger_session_entreprise(){

    var url      = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token= $("[name='_token']").val();

    var ENTREPRISE= $("#ENTREPRISE").val();

    $.ajax({
        type:'GET',
        url:url+'/getSESSION_ENTREPRISE',
        data:'_token ='+token+'&ENTREPRISE='+ENTREPRISE,
        success:function(data){
            var options='<option value="0">Selectionner session</option>';
            $.each(data, function(index, element) {
                options =options +'<option value="'+element.id+'">'+ element.LIBELLE+'</option>';
                //console.log(options);
                //placeholder
            });
            //console.log(data);
            if(data.length>0){

                $('#SESSION_ENTREPRISE').find('option').remove().end().append(options);
            }else {
                $('#SESSION_ENTREPRISE').find('option').remove().end().append('<option value="0">AUTRE</option>');
            }
            // console.log(options);
        }
    });

}


function charger_formation_entreprise(){

    var url      = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token= $("[name='_token']").val();

    var SESSION_ENTREPRISE= $("#SESSION_ENTREPRISE").val();
    var SOCIETE= $("#ENTREPRISE").val();

    $.ajax({
        type:'GET',
        url:url+'/getFORMATION_ENTREPRISE',
        data:'_token ='+token+'&SOCIETE='+SOCIETE+'&SESSION_ENTREPRISE='+SESSION_ENTREPRISE,
        success:function(data){
            var options='<option value="0">Selectionner formation</option>';
            $.each(data, function(index, element) {
                options =options +'<option value="'+element.id+'">'+ element.LIBELLE+'</option>';
                //console.log(options);
                //placeholder
            });
            console.log(data);
            if(data.length>0){

                $('#DIPLOME_ENTREPRISE').find('option').remove().end().append(options);
            }else {
                $('#DIPLOME_ENTREPRISE').find('option').remove().end().append('<option value="0">AUTRE</option>');
            }
            // console.log(options);
        }
    });

}
/*************************************************/
function get_total_etudiant(){
    var url      = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token= $("[name='_token']").val();
    var ETUDIANT= $('#ETUDIANT').val();
    var SESSION_ETUDIANT= $('#SESSION_ETUDIANT').val();
    var DIPLOME_ETUDIANT= $('#DIPLOME_ETUDIANT').val();
    $.ajax({
        type:'GET',
        url:url+'/getTOTAL_ETUDIANT',
        data:'_token ='+token+'&ETUDIANT='+ETUDIANT+'&SESSION_ETUDIANT='+SESSION_ETUDIANT+'&DIPLOME_ETUDIANT='+DIPLOME_ETUDIANT,
        success:function(data){
            $.each(data, function(index, element) {
               var id= element.id;
                var TOTAL= element.TOTAL;
                var RESTE= element.RESTE;
                var PAYE= element.PAYE;
                var REGISTER= element.id;
                 if(data.length>0){

                    $('#TOTAL').val(TOTAL);
                     $('#RESTE').val(RESTE);
                     $('#REGISTER').val(REGISTER);
                }else {
                    $('#TOTAL').val('');
                     $('#RESTE').val('');
                     $('#REGISTER').val('');
                }
            });
        }
    });
}

function get_total_entreprise(){
    var url      = window.location.href;
    url = url.substr(0, url.lastIndexOf("/"));
    var token= $("[name='_token']").val();
    var ENTREPRISE= $('#ENTREPRISE').val();
    var SESSION_ENTREPRISE= $('#SESSION_ENTREPRISE').val();
    var DIPLOME_ENTREPRISE= $('#DIPLOME_ENTREPRISE').val();
    $.ajax({
        type:'GET',
        url:url+'/getTOTAL_ENTREPRISE',
        data:'_token ='+token+'&ENTREPRISE='+ENTREPRISE+'&SESSION_ENTREPRISE='+SESSION_ENTREPRISE+'&DIPLOME_ENTREPRISE='+DIPLOME_ENTREPRISE,
        success:function(data){
            $.each(data, function(index, element) {
                var id= element.id;
                var TOTAL= element.TOTAL;
                var RESTE= element.RESTE;
                var PAYE= element.PAYE;
                var REGISTER= element.id;
                if(data.length>0){

                    $('#TOTAL').val(TOTAL);
                    $('#RESTE').val(RESTE);
                    $('#REGISTER').val(REGISTER);
                }else {
                    $('#TOTAL').val('');
                    $('#RESTE').val(RESTE);
                    $('#REGISTER').val('');
                }
            });
        }
    });
}