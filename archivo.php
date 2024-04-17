<?php
    require_once("php/connection.php");
    require_once("controller/ControllerDiagnostico.php");

    session_start();

    if(!isset($_SESSION['rol'])) {
        header('Location: index.php');
    } else {
        if ($_SESSION['rol'] != 3) {
        header('Location: index.php');
        }
    }

    $ID = $_GET['nd'];

    $diagnostico = new diagnostico();
    $cargar_expediente = $diagnostico->imprimir_diagnostico($ID);
    $cargar_diagnostico = $diagnostico->search_editar_registro($ID);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Diagnostico</title>
        <link rel="icon" href="resource/img/favicon.png" type="image/x-icon">
        <style>
            @page {
                margin: 0cm 0cm;
            }
            header {
                position: fixed; 
                top: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: right;
                line-height: 1cm;
                padding-right: 1rem !important;
            }
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 1cm;
            }
            .title-p {
                color: #3678b3;
            }
            body {
                margin-top: 1cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 1cm;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
            }
            .container {
                margin-right: 2rem;
                margin-left: 2rem;
            }
            .pt-4 {
                padding-top: 1.5rem !important;
            }
            .mb-5 {
                margin-bottom: 3rem !important;
            }
            .mt-5 {
                margin-top: 3rem !important;
            }
            .mt-10 {
                margin-top: 6rem !important;
            }
            .mt-3 {
                margin-top: 1rem !important;
            }
            .mt-1 {
                margin-top: .25rem !important;
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #cbcaca;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>
        <header>
            <?php echo date('d/m/Y g:i a');?>
        </header>
        <section>
            <?php
                foreach ($cargar_expediente as $row) {
            ?>
                <div class="container mb-5 pt-4">
                    <table>
                        <th style="border: none;">
                            <img class="" src="http://localhost/clinica/resource/img/logo.png" width="250px"/>
                        </th>
                        <th style="text-align: center; border:none;">
                            <h1 class="title-p">Medical Control System</h1>
                            <h2>Diagnóstico Médico</h2>
                            <h4 style="line-height: 0;">UNIVERSIDAD DE GUADALAJARA</h4>
                            <p style="line-height: 1; color:gray;">Blvd. Gral. Marcelino García Barragán 1421, Olímpica, 44430 Guadalajara, Jal.</p>
                        </th>
                    </table>

                    <table class="mt-3">
                        <tbody>
                            <tr>
                                <th class="" style="text-align: center;" colspan="4">Datos del paciente</th>
                            </tr>
                            <tr>
                                <th>CURP:</th>
                                <td colspan="3"><?php echo $row['CURP']; ?></td>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <td><?php echo $row['Nombre'].' '.$row['Apellidos']; ?></td>
                                <th>Edad:</th>
                                <td><?php echo $row['Edad'].' años'; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de nacimiento:</th>
                                <td><?php echo $row['FechaN']; ?></td>
                                <th>Género:</th>
                                <td><?php echo $row['Sexo']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php
                        foreach ($cargar_diagnostico as $value) {
                    ?>
                            <table class="diagnostico mt-3">
                                <tbody>
                                    <tr>
                                        <th class="" style="text-align: center;" colspan="2">Diagnóstico N°<?php echo $value['ID_diagnostico'];?></th>
                                    </tr>
                                    <tr>
                                        <th width="250px">Consulta realizada:</th>
                                        <td><?php echo $value['FechaD']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Médico:</th>
                                        <td><?php echo $value['Nombre'].' '.$value['Apellidos']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Especialidad:</th>
                                        <td><?php echo $value['Especialidad']; ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Examen físico:</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo $value['Examen_fisico'];?></td>
                                    </tr>    
                                    <tr>
                                        <th colspan="2">Observaciones:</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo $value['Observaciones'];?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Medicación:</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo $value['Medicacion'];?></td>
                                    </tr>                 
                                </tbody>
                            </table>
                            <table class="mt-5">
                                <tbody>
                                    <tr>
                                        <th style="text-align:right; border:none;">Firma del médico:</th>
                                        <td width="250px"></td>
                                    </tr>
                                </tbody>
                            </table>
                    <?php
                        }
                    ?>
                </div> 
            <?php  
                }
            ?>
        </section>
        <footer>
            Copyright &copy; <?php echo date("Y");?> Team 7 - Medical Control System
        </footer>
    </body>
    </html>