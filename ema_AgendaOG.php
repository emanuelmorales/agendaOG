<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Calendario Web(Develoteca.com)</title>
    <!-- Estilos bootstrap4 -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="includes/ema_agendaOG/css/bootstrap.min.css">
    <!-- js necesarios -->
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="includes/ema_agendaOG/js/jquery.min.js"></script>

    <!-- <script src="js/moment.min.js"></script> -->
    <script src="includes/ema_agendaOG/js/moment.min.js"></script>

    <!-- Full Calendar -->
    <!-- <link rel="stylesheet" href="css/fullcalendar.min.css"> -->
    <link rel="stylesheet" href="includes/ema_agendaOG/css/fullcalendar.min.css">

    <!-- <script src="js/fullcalendar.min.js"></script> -->
    <script src="includes/ema_agendaOG/js/fullcalendar.min.js"></script>

    <!-- Traducir fullcalendar a Español, solo hacinedo referencia al js se traduce automáticamente -->
    <script src="includes/ema_agendaOG/js/es.js"></script>
    <!-- <script src="js/es.js"></script> -->

    <!-- referencia a clockpicker -->
    <link rel="stylesheet" href="includes/ema_agendaOG/css/bootstrap-clockpicker.css">
    <!-- <link rel="stylesheet" href="css/bootstrap-clockpicker.css"> -->
    <script src="includes/ema_agendaOG/js/bootstrap-clockpicker.js"></script>
    <!-- <script src="js/bootstrap-clockpicker.js"></script> -->

    <!-- bootstrap 4.0.0 js para poder usar modal -->
    <script src="includes/ema_agendaOG/js/popper.min.js"></script>
    <script src="includes/ema_agendaOG/js/bootstrap.min.js"></script>

    <!-- estilo de libreria Toastify para alertas -->
    <link rel="stylesheet" type="text/css" href="includes/ema_agendaOG/css/toastify.min.css">
    <!-- js de libreria Toastify para alertas -->
    <script type="text/javascript" src="includes/ema_agendaOG/js/toastify-js.js"></script>

    <!-- archivos librerias selectpicker -->
    <link rel="stylesheet" href="includes/ema_agendaOG/css/bootstrap-select.css">
    <script src="includes/ema_agendaOG/js/bootstrap-select.js"></script>
    <script src="includes/ema_agendaOG/js/defaults-es_ES.js"></script>

    <style>
        .fc th {
            padding: 5px 0px;
            vertical-align: middle;
            background: #F2F2F2;
        }

        .fc-button {
            background: #215db9;
            color: white;
        }

        /* Acomodar el espaciado entre opciones del menú, al usar bootstrap4 queda muy pegado */
        .dropotron li>a {
            padding: 6px 4px 4px 4px;
        }

        /* color de fondo botón selectpicker */
        .bootstrap-select>.dropdown-toggle {
            background: #007bff;
        }
    </style>

</head>

<body class="homepage">
    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-11">
                        <br>
                        <h3 class="text-center">Agenda de Audiencias - Oficina de Gestión MPA</h3>
                        <hr>


                        Referencia de Colores: &nbsp;
                        <!-- onclick="filtro_por_color('NORMAL')" -->
                        <a class="a_como_boton" href="camara_gesell_index.php?estado=ASI"><i class="fa fa-check-circle fa-2x" style="color: #0b577c;" aria-hidden="true" title="Audiencia Reservada"></i>
                            Asignada
                        </a>
                        &nbsp;&nbsp;
                        <a class="a_como_boton" href="camara_gesell_index.php?estado=REALIZADA"><i class="fa fa-check-circle fa-2x" style="color: #217a00" aria-hidden="true"></i>
                            Realizada
                        </a>
                        &nbsp;&nbsp;
                        <a class="a_como_boton" href="camara_gesell_index.php?estado=SUSPENDIDA"><i class="fa fa-check-circle fa-2x" style="color: #ffa000" aria-hidden="true"></i>
                            Suspendida
                        </a>
                        &nbsp;&nbsp;
                        <a class="a_como_boton" href="camara_gesell_index.php?estado=REPROGRAMADA"><i class="fa fa-check-circle fa-2x" style="color: #00897b" aria-hidden="true"></i> Reprogramada
                        </a>
                        &nbsp;&nbsp;
                        <a class="a_como_boton" href="camara_gesell_index.php?estado=CAN"><i class="fa fa-check-circle fa-2x" style="color: #ff0202" aria-hidden="true"></i> Cancelada
                        </a>
                        &nbsp;&nbsp;
                        <a class="a_como_boton" href="camara_gesell_index.php?estado=FER"><i class="fa fa-check-circle fa-2x" style="color: #3a3737" aria-hidden="true"></i> Feriado
                        </a>
                        <hr>



                        <div id="CalendarioWeb"></div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
            <script>
                $(document).ready(function() {

                    let miCalendar = $('#CalendarioWeb').fullCalendar({
                        locale: 'es',
                        header: {
                            left: 'today,prev,next,Miboton',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },

                        // Establecer la vista "mes" como predeterminada Resto de las opciones del calendario
                        defaultView: 'agendaWeek',

                        // creación de un botón personalizado para ir a una fecha ingresada
                        customButtons: {
                            Miboton: {
                                text: "Ir a Fecha",
                                background: "blue",
                                click: function() {

                                    let fechaOriginal = prompt("Ingrese la Fecha en formato 01-04-2023"); //2023-04-01

                                    // Dividir la cadena en año, mes y día
                                    var partesFecha = fechaOriginal.split('-');

                                    // Crear una nueva cadena con el formato deseado
                                    var nuevaFecha = partesFecha[2] + '-' + partesFecha[1] + '-' + partesFecha[0];

                                    // Crear un objeto moment con la fecha deseada
                                    var newDate = moment(nuevaFecha);

                                    // Llamar a la función setDate en el calendario
                                    $('#CalendarioWeb').fullCalendar('gotoDate', newDate);

                                }
                            }
                        },

                        // validRange: {
                        //     start: Date.now(),
                        //     end: '2017-06-01'
                        // },

                        // habilitar/ deshabilitar fines de semana
                        weekends: true,

                        //oculta la fila todo el dia
                        allDaySlot: false,

                        minTime: "08:00",
                        maxTime: "21:00",
                        scrollTime: moment().format('H:m'),

                        eventLimit: false, // allow "more" link when too many events

                        // duración de tiempo
                        slotDuration: '00:30:00',

                        // cada cuanto se mostrarán las etiquetas de tiempo
                        slotLabelInterval: '00:60',

                        // formato de la hora
                        slotLabelFormat: 'hh(:mm)a',

                        // define horas de trabajo
                        businessHours: [{
                                // days of week. an array of zero-based day of week integers (0=Sunday)
                                dow: [0, 1, 2, 3, 4, 5, 6, 7], // Monday - Thursday

                                start: '08:00', // a start time (10am in this example)
                                end: '13:00', // an end time (6pm in this example)
                            },
                            {
                                // days of week. an array of zero-based day of week integers (0=Sunday)
                                dow: [0, 1, 2, 3, 4, 5, 6, 7], // Monday - Thursday

                                start: '15:30', // a start time (10am in this example)
                                end: '21:00', // an end time (6pm in this example)
                            }
                        ],

                        //define alto del calendar
                        contentHeight: 'auto',
                        height: '1024px',
                        aspectRatio: 2,


                        // ? *************************************************************
                        // ? al hacer click en un día, se mostrará un modal con los campos 
                        // ? del formulario para crear un evento
                        // ? *************************************************************
                        dayClick: function(date, jsEvent, view) {

                            // var actual = new Date();
                            // se debe usar moment para obtener el mismo formato de fecha que usa fullCalendar
                            var actual = moment();
                            actual = actual.format("YYYY-MM-DD");
                            fechaSeleccionada = date.format("YYYY-MM-DD"); //obtener fecha seleccionada
                            horaSeleccionada = date.format("HH:mm"); //obtener hora seleccionada

                            horaFinlaizacion = moment(date).add(1, 'hour'); // agregar una hora a la fecha /hora seleccionada
                            horaFinlaizacion = horaFinlaizacion.format("HH:mm"); //obtener hora seleccionada

                            // Si la fecha seleecionada es mayor a la actual se puede agregar
                            if (fechaSeleccionada >= actual) {
                                // deshabilitar botón modificar y eliminar y habilita agregar
                                $("#btnAgregar").prop("disabled", false);
                                $("#btnModificar").prop("disabled", true);
                                $("#btnEliminar").prop("disabled", true);
                                $("#estado_audiencia").hide();

                                limpiarFormulario();

                                $("#tituloEvento").html("Nueva Audiencia");
                                $("#txtFecha").val(fechaSeleccionada);
                                $("#txtHora").val(horaSeleccionada);
                                $("#txtHoraHasta").val(horaFinlaizacion);

                                $("#select_estado").val("ASI");
                                $("#select_estado").selectpicker("refresh");

                                $("#ModalEventos").modal();
                            } else {
                                alert("Error: No se puede solicitar una audiencia en una fecha vencida");
                            }

                        },

                        // para modificar las poropiedades de los eventos, deberemos utilizar la siguiente propiedad, y poner los eventos dentro
                        // eventSources: [{
                        //     events: [{
                        //             title: 'Evento1, llegamos a 8,000',
                        //             start: '2022-08-15',
                        //             descripcion: "Develoteca¡Me apasiona!",
                        //             // definir colores personalizados para cada evento
                        //             color: "#FF0F0",
                        //             textColor: "#FFFFFF"
                        //         },
                        //         {
                        //             title: 'Evento2, llegamos a 8,004',
                        //             descripcion: "Hay que celebrar con un curso en Udemy :)",
                        //             start: '2022-08-18',
                        //             end: '2022-08-20',
                        //         },
                        //         {
                        //             title: 'Evento3, Saludos Develotecos',
                        //             descripcion: "Hay que celebrar compartiendo contenido¡Develoteca me apasiona!",
                        //             start: '2022-08-25T12:30:00',
                        //             allDay: false,
                        //             // definir colores personalizados para cada evento
                        //             color: "#FFF000",
                        //             textColor: "#000000"
                        //         }
                        //     ],
                        //     // definición de colores para todos los eventos 
                        //     color: "black",
                        //     textColor: "yellow"
                        // }],

                        // trayendo los eventos desde la BD
                        events: 'ema_AgendaOG_eventos.php',


                        // ? *************************************************************
                        // ? Funcionalidad click al evento
                        // ? calEvent: trae todos los datos definidos en el evento
                        // ? *************************************************************
                        eventClick: function(calEvent, jsEvent, view) {

                            // deshabilitar botón agregar y habilita modificar y eliminar
                            $("#btnAgregar").prop("disabled", true);
                            $("#btnModificar").prop("disabled", false);
                            $("#btnEliminar").prop("disabled", false);
                            $("#estado_audiencia").show();

                            $('#tituloEvento').html(calEvent.title);

                            // mostrar la información del evento en los inputs
                            $('#txtDescripcion').val(calEvent.descripcion);
                            $('#txtID').val(calEvent.id);
                            $('#txtTitulo').val(calEvent.title);

                            // capturar la fecha, hora de inicio y hora de finalización                    
                            fechaSeleccionada = calEvent.start.format("YYYY-MM-DD"); //obtener fecha seleccionada
                            horaSeleccionada = calEvent.start.format("HH:mm"); //obtener hora seleccionada
                            horaFinlaizacion = calEvent.end.format("HH:mm"); //obtener hora seleccionada

                            // completa los campos de fecha7hora
                            $('#txtFecha').val(fechaSeleccionada);
                            $('#txtHora').val(horaSeleccionada);
                            $('#txtHoraHasta').val(horaFinlaizacion);

                            // $('#txtColor').val(calEvent.color);

                            $("#select_estado").val(calEvent.estado);
                            $("#select_estado").selectpicker("refresh");


                            $("#ModalEventos").modal();

                        },

                        // habilitar/deshabilitar fullcalendar para poder editar eventos arrastrando
                        editable: true,


                        // ? *************************************************************
                        // ? al arrastrar el evento
                        // ? *************************************************************
                        eventDrop: function(calEvent) {
                            $('#txtID').val(calEvent.id);
                            $('#txtTitulo').val(calEvent.title);
                            // $('#txtColor').val(calEvent.color);
                            $('#txtDescripcion').val(calEvent.descripcion);
                            $('#txtEstado').val(calEvent.estado);

                            //apturar la fecha y horas al mover el evento
                            fechaSeleccionada = calEvent.start.format("YYYY-MM-DD"); //obtener fecha seleccionada
                            horaSeleccionada = calEvent.start.format("HH:mm"); //obtener hora seleccionada
                            horaFinlaizacion = calEvent.end.format("HH:mm"); //obtener hora seleccionada

                            $('#txtFecha').val(fechaSeleccionada);
                            $('#txtHora').val(horaSeleccionada);
                            $('#txtHoraHasta').val(horaFinlaizacion);

                            $("#select_estado").val(calEvent.estado);
                            $("#select_estado").selectpicker("refresh");

                            // carga los datos en los inputs del formulario
                            recolectarDatosGUI();
                            EnviarInformacion('modificar', NuevoEvento, true);
                        },


                        // ? *************************************************************
                        // ? actualizar la propiedad "start" y "end" de un evento en 
                        // ? FullCalendar al agrandar su tamaño
                        // ? *************************************************************
                        eventResize: function(calEvent) {
                            $('#txtID').val(calEvent.id);
                            $('#txtTitulo').val(calEvent.title);
                            // $('#txtColor').val(calEvent.color);
                            $('#txtDescripcion').val(calEvent.descripcion);
                            $('#txtEstado').val(calEvent.estado);

                            //apturar la fecha y horas al mover el evento
                            fechaSeleccionada = calEvent.start.format("YYYY-MM-DD"); //obtener fecha seleccionada
                            horaSeleccionada = calEvent.start.format("HH:mm"); //obtener hora seleccionada
                            horaFinlaizacion = calEvent.end.format("HH:mm"); //obtener hora seleccionada

                            $('#txtFecha').val(fechaSeleccionada);
                            $('#txtHora').val(horaSeleccionada);
                            $('#txtHoraHasta').val(horaFinlaizacion);

                            $("#select_estado").val(calEvent.estado);
                            $("#select_estado").selectpicker("refresh");

                            // carga los datos en los inputs del formulario
                            recolectarDatosGUI();
                            EnviarInformacion('modificar', NuevoEvento, true);
                        }

                    });
                });



                function mostrar_alerta(mensaje, fondo, texto) {
                    // Muestra alerta con plugin Toastify
                    Toastify({
                        text: mensaje,
                        duration: 3000,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: fondo,
                            color: texto,
                        },
                        onClick: function() {} // Callback after click
                    }).showToast();
                }
            </script>

            <div class="modal" tabindex="-1" id="ModalEventos">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloEvento"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- hidden es un tipo que oculta los inputs -->
                            <input type="hidden" name="txtID" id="txtID">
                            <input type="hidden" name="txtFecha" id="txtFecha">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtTitulo">Título:</label>
                                    <input type="text" name="txtTitulo" id="txtTitulo" class="form-control" placeholder="Título de la Audiencia" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtHora">Desde:</label>
                                    <!-- aplicando clockpicker -->
                                    <!-- la clase clockpicker convierte el input en u reloj -->
                                    <!-- data-autoclose=true: cuanso seleccione una hora del reloj, automáticmanete desaparecerá y colocará el valor seleccionado en el value del input-->
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input type="text" name="txtHora" id="txtHora" value="10:30" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtHora">Hasta:</label>
                                    <!-- aplicando clockpicker -->
                                    <!-- la clase clockpicker convierte el input en u reloj -->
                                    <!-- data-autoclose=true: cuanso seleccione una hora del reloj, automáticmanete desaparecerá y colocará el valor seleccionado en el value del input-->
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input type="text" name="txtHoraHasta" id="txtHoraHasta" value="10:30" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtHora">Descripción:</label>
                                <textarea name="txtDescripcion" id="txtDescripcion" rows=3 class="form-control" autocomplete="off"></textarea>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="txtEstado">Estado</label>
                                <select class="form-control" id="txtEstado" name="txtEstado">
                                    <option value="">Seleccione Estado de la Audiencia</option>
                                    <option value="ASI" selected>Asignado</option>
                                    <option value="CAN">Cancelado</option>
                                    <option value="REP">Reprogramada</option>
                                    <option value="FIN">Finalizado</option>
                                </select>
                            </div>

                            <!-- <div class="form-group">
                                <label for="txtColor">Color:</label>
                                <input type="color" name="txtColor" id="txtColor" class="form-control" value="#ff0000" style="height:36px;">
                            </div> -->

                            <div class="form-group" id="estado_audiencia">
                                <label for="txtHora">Estado Audiencia:</label>
                                <!-- <select class="selectpicker form-control" data-live-search="true" title="&nbsp;" name="sector_origen" id="sector_origen"> -->
                                <select class="selectpicker form-control" data-live-search="true" name="select_estado" id="select_estado" style="width: 100%" ;>
                                    <option value="ASI" selected>ASIGANDA</option>
                                    <option value="REA">REALIZADA</option>
                                    <option value="SUS">SUSPENDIDO</option>
                                    <option value="REP">REPROGRAMADA</option>
                                    <option value="CAN">CANCELADA</option>
                                    <option value="FER">FERIADO</option>
                                </select>
                            </div>

                            <script>
                                $('.selectpicker').selectpicker();
                            </script>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btnAgregar">Agregar</button>
                            <button type="button" class="btn btn-success" id="btnModificar">Modificar</button>
                            <button type="button" class="btn btn-danger" id="btnEliminar">Borrar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</body>




<script>
    // recolectar datos del fomrulario para agregar, modifciar o eliminar un evento
    var NuevoEvento;

    // tener en cuenta que se debe llamar el evento click luego de definir el Modal, sino no funciona
    $("#btnAgregar").click(function() {

        // carga los datos en los inputs del formulario
        recolectarDatosGUI();

        // Ahora como vamos a agregar el evento desde el btnAgregar, los anterior no nos sirve, hacemos lo siguiente
        EnviarInformacion('agregar', NuevoEvento);

    });

    // eliminar el evento en la BD con el id que se envía
    $("#btnEliminar").click(function() {

        if (confirm('Confirma la Elminación de la Audiencia?')) {
            // carga los datos en los inputs del formulario
            recolectarDatosGUI();
            // Ahora como vamos a agregar el evento desde el btnAgregar, los anterior no nos sirve, hacemos lo siguiente
            EnviarInformacion('eliminar', NuevoEvento);
        } else {
            // ocultar el modal
            $('#ModalEventos').modal('toggle');
        }

    });


    // modificar el evento en la BD con el id que se envía
    $("#btnModificar").click(function() {
        recolectarDatosGUI();
        EnviarInformacion('modificar', NuevoEvento);
    });

    // armamos el evento en el formato necesario para fullCalendar
    function recolectarDatosGUI() {

        // asignar color según estado
        var estado = $("#select_estado").val();
        switch (estado) {
            case "ASI":
                color_estado = "#0b577c";
                break;
            case "REA":
                color_estado = "#217a00";
                break;
            case "SUS":
                color_estado = "#ffa000";
                break;
            case "REP":
                color_estado = "#00897b";
                break;
            case "CAN":
                color_estado = "#ff0202";
                break;
            case "FER":
                color_estado = "#3a3737";
                break;

        }

        //? tener en cuenta que si aquí definimos var NuevoEvento es local y no devuelve nada en la variables global
        NuevoEvento = {
            id: $("#txtID").val(),
            title: $("#txtTitulo").val(),
            // el formato de start tiene formato de fecha hora
            start: $("#txtFecha").val() + " " + $("#txtHora").val(),
            color: color_estado,
            textColor: "#FFFFFF",
            end: $("#txtFecha").val() + " " + $("#txtHoraHasta").val(),
            descripcion: $("#txtDescripcion").val(),
            estado: $("#select_estado").val()
        };
    }

    // función para enviar información, la accion y el objeto evento, con tecnología ajax, sin que refresque la página
    function EnviarInformacion(accion, objEvento, modal) {
        $.ajax({
            type: 'POST',
            url: 'ema_AgendaOG_eventos.php?accion=' + accion,
            data: objEvento,
            success: function(msg) {
                // si respuesta es true
                if (msg) {
                    // actualiza los eventos a través de la consulta al eventos.php
                    $('#CalendarioWeb').fullCalendar('refetchEvents');

                    // Si no se trata de evento drop, oculta el modal, sino simplemente no hace nada ya que no se abrió el modal para modificar.
                    if (!modal) {
                        // ocultar el modal
                        $('#ModalEventos').modal('toggle');
                    }

                    // Muestra alerta
                    switch (accion) {
                        case "agregar":
                            mostrar_alerta("Audiencia Agregada", "#359014", "white");
                            break;
                        case "modificar":
                            mostrar_alerta("Audiencia Modificada", "#FFF176", "black");
                            break;
                        case "eliminar":
                            mostrar_alerta("Audiencia Eliminada", "#FF3333", "white");
                            break;
                    }

                }
            },
            error: function() {
                alert('Hay un error');
            }
        });
    }

    // implementa el reloj en el input time con clockpicker
    $(".clockpicker").clockpicker();

    // limpiar los inputs del form
    function limpiarFormulario() {
        $("#txtID").val('');
        $("#txtTitulo").val('');
        $("#txtColor").val('');
        $("#txtDescripcion").val('');
    }

    // al presionar ctl+enter llama al click de agregar o modificar, según acción reralizada
    document.addEventListener("keydown", function(event) {
        if (event.ctrlKey && event.keyCode === 13) {
            event.preventDefault();
            // si es un alta, guarda el evento, sino, modifica el evento
            if ($("#btnAgregar").prop("disabled") == false) {
                $("#btnAgregar").click();
            } else {
                $("#btnModificar").click();
            }
        }
    });
</script>

</html>