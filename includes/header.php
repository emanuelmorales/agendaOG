<?php
// CONTROLO QUE ESTE LOGUEADO PARA ACCEDER


include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

?>
<?php if (login_check($mysqli) == true && (cta_bloq(htmlentities($_SESSION['username']))) == true): ?>

  <head>
    <link href="images/favicon.ico" type="image/x-icon" rel="icon" /><link href="images/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    <title>Sistema de Gestion Integral - mpA Jujuy</title>
    <meta charset="utf-8" />
    <!-- <meta http-equiv="Expires" content="0"> 
    <meta http-equiv="Last-Modified" content="0"> 
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1" />-->
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />

    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->



    <!-- Scripts -->
    <!--<script src="assets/js/jquery.min.js"></script>-->
    <script src="js/jquery2.2.4.js"></script>

    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/skel-viewport.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>

    <script type="text/JavaScript" src="js/sweetalert.min.js"></script>
    <link href="assets/css/sweetalert.css" rel='stylesheet'>
    <!--multiselect-->
    <link href="assets/css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.multiselect.js"></script>



    <!-- JTABLE -->

    <link href="jtable.2.4.0/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="js/jquery-ui-themes-1.11.1/themes/flick/jquery-ui.css">
    <link href="jtable.2.4.0/themes/metro/blue/jquery-ui.css" rel="stylesheet" type="text/css" />

    <!-- Import CSS file for validation engine (in Head section of HTML) -->
    <link href="jtable.2.4.0/scripts/validationEngine/validationEngine.jquery.css" rel="stylesheet" type="text/css" />




    <!--Scripts-->
    <script src="js/jquery-ui.js"></script>

    <script src="js/jquery.stepyform.js"></script>
    <script src="jtable.2.4.0/jquery.jtable.js" type="text/javascript"></script>
    <script src="jtable.2.4.0/extensions/jtable.custombutton.js" type="text/javascript"></script>
    <script src="jtable.2.4.0/localization/jquery.jtable.es.js" type="text/javascript"></script>
    <script src="jtable.2.4.0/scripts/es-datepicker.js"></script>
    <!--tinymce-->
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <!--<link rel="stylesheet" href="tinymce/js/tinymce/skins/lightgray/content.min.css">-->
    <!-- Import Javascript files for validation engine (in Head section of HTML) -->
    <script type="text/javascript" src="jtable.2.4.0/scripts/validationEngine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="jtable.2.4.0/scripts/validationEngine/jquery.validationEngine-es.js"></script>
    <!-- JTABLE upload-->
    <script src="js/jquery.uploadfile.js"></script>
    <link href="assets/css/uploadfile.css" rel="stylesheet" type="text/css" />

    <!-- search select -->
      <link href="assets/css/select2.css" rel="stylesheet" type="text/css" />
      <script src="js/select2.js"></script>


    <style>
    /*Quitar espacio superior del menú*/
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #555;
    }
    #main-wrapper{
      padding-top: 45px;
    }
    /*Quitar espacio entre ultimo registro del jtable y manejo de páginas*/
    .jtable{
      margin:0px;
    }


    /* BOTONES DE DATATABLE */
       .btn-datatable {
           background: #337ab7 !important;
           border-color: #2e6da4 !important;
           color: #ffffff !important;
       }

       .btn-datatable:hover {
           background: #2e6da4 !important;
           color: #ffffff !important;
       }

       button.dt-button, div.dt-button, a.dt-button :hover {
         color: #ffffff !important;
       }

    </style>

       

    <!-- CONTROL DE INACTIVIDAD -->
    <script type="text/javascript" src="includes/jquery.idle.js"></script>
    <!-- <div id="dialoginactividad" hidden></div> -->
    <script>
    $(document).idle({
      onIdle: function(){
        // $("#dialoginactividad").html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><span class="jtable-delete-confirm-message">Su sesión ha expirado, ingrese nuevamente al sistema.</span></p>');
        // $("#dialoginactividad").dialog({
        //   width       :   "AUTO",
        //   heigth      :   "AUTO",
        //   show: "fade",
        //   hide: "fade",
        //   title: "ERROR",
        //   close:function(){
        //     $( this ).dialog( "close" );
        //     window.location.href = "includes/logout.php";
        //
        //   },
        //   buttons: {
        //     Aceptar: function() {
        //       $( this ).dialog( "close" );
        //         window.location.href = "includes/logout.php";
        //     }
        //
        //   }
        // });
        window.location.href = "includes/logout.php?cerrar=1";
      },
      idle: 10800000 /* 3hs*/

      // idle:4000 /* 2hs*/
    });



    function mostrarnoti(id,tipo){

      var numero= document.getElementById("circulo").innerHTML;
      var calculo = numero - 1;

      var parametros = {
        "id" :id,
        "tipo": tipo,
      };

      $.ajax({
        type: "POST",
        url: "cfg_mis_notificaciones_actions.php?action=notificacion",
        data: parametros,
        async: false,

      }).done(function(respuesta){


        // swal(respuesta.titulo,respuesta.texto);

        swal({
          html:true,
          title:'<p style="font-size:15px;font-weight:bold;">'+respuesta.titulo+'<p>',
          text:respuesta.texto,
        },function(isConfirm){
          if (isConfirm) {
            $(".sweet-alert").remove();
          }
        });


        if(calculo > 0){
          $("#circulo").text(calculo);

        }else{

          $("#circulo").remove();
        }

        $('#notificacion'+id).remove();



    });




    }




    $(document).ready(function () {

    var drop = document.getElementsByClassName("btnBoot");
    var j;

    for (j = 0; j < drop.length; j++) {
      drop[j].addEventListener("click", function() {

        var dropContent = this.nextElementSibling;
        if (dropContent.style.display === "block") {
          dropContent.style.display = "none";
        } else {
          dropContent.style.display = "block";
        }
      });
    }

  });

    </script>
    <!-- FIN CONTROL DE INACTIVIDAD -->



  </head>

 
<?php else :

  header("Location: error.php?err=No esta autorizado a ingresar a esta pagina o su cuenta se encuentra bloqueada.");
  exit();


endif; ?>
