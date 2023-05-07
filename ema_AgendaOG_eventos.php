<?php

header('Content-Type: application/json');

$pdo = new PDO('mysql:dbname=test;host=localhost', 'root', '');
// $pdo = new PDO('mysql:dbname=mpasis;host=192.200.0.99', 'usuariomysql', 'pcbox197.N95');

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';

switch ($accion) {
    case 'agregar':

        // verifica si se marcó todo el día, para saber si es un feriado y pintarlo de color gris
        $hora_start = date("H:i", strtotime($_POST['start']));
        $hora_end = date("H:i", strtotime($_POST['end']));
        if ($hora_start == "08:00" and $hora_end == "21:00") {
            $color = "#3a3737";
        } else {
            $color = $_POST['color'];
        }
        // fin verifica si se marcó todo el día, para saber si es un feriado y pintarlo de color gris

        $sentenciaSQL = $pdo->prepare('INSERT INTO ema_eventos(title,descripcion,color,textColor,start,end, estado)
            VALUES(:title,:descripcion,:color,:textColor,:start,:end,:estado)');

        $respuesta = $sentenciaSQL->execute(
            [
                'title' => $_POST['title'],
                'descripcion' => $_POST['descripcion'],
                'color' => $color,
                'textColor' => $_POST['textColor'],
                'start' => $_POST['start'],
                'end' => $_POST['end'],
                'estado' => $_POST['estado'],
            ]
        );
        // si se realizó un isert, devuelve true, sino false.
        echo json_encode($respuesta);

        break;
    case 'eliminar':
        // echo 'Instrucción Eliminar';
        $respuesta = false;
        if (isset($_POST['id'])) {
            $sentenciaSQL = $pdo->prepare('DELETE FROM ema_eventos WHERE ID=:ID');
            $respuesta = $sentenciaSQL->execute(['ID' => $_POST['id']]);
        }
        echo json_encode($respuesta);
        break;
    case 'modificar':
        // echo 'Instrucción Modificar';
        $sentenciaSQL = $pdo->prepare('UPDATE ema_eventos SET
        title=:title,
        descripcion=:descripcion,
        color=:color,
        textColor=:textColor,
        start=:start,
        end=:end,
        estado=:estado
        WHERE ID=:ID
        ');

        $respuesta = $sentenciaSQL->execute(
            [
                'ID' => $_POST['id'],
                'title' => $_POST['title'],
                'descripcion' => $_POST['descripcion'],
                'color' => $_POST['color'],
                'textColor' => $_POST['textColor'],
                'start' => $_POST['start'],
                'end' => $_POST['end'],
                'estado' => $_POST['estado'],
            ]
        );
        echo json_encode($respuesta);
        break;

    default:
        // Seleccionar los ema_eventos del calendario
        $sentenciaSQL = $pdo->prepare('SELECT * FROM ema_eventos');
        $sentenciaSQL->execute();
        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
}
