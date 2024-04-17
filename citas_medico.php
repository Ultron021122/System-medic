<?php
    require_once("php/connection.php");
    require_once("./controller/ControllerMedico.php");

    session_start();

    if(!isset($_SESSION['rol'])) {
        header('Location: index.php');
    } else {
        if ($_SESSION['rol'] != 3) {
        header('Location: index.php');
        }
    }

    $ID = $_GET['md'];

    $medico = new medico();
    $agenda = $medico->agenda_medico_usuario($ID);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agenda médica</title>
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
                <div class="container mb-5 pt-4">
                    <table>
                        <th style="border: none;">
                            <img class="" src="http://localhost/clinica/resource/img/logo.png" width="250px"/>
                        </th>
                        <th style="text-align: center; border:none;">
                            <h1 class="title-p">Medical Control System</h1>
                            <h2>Agenda Médica</h2>
                            <h4 style="line-height: 0;">UNIVERSIDAD DE GUADALAJARA</h4>
                            <p style="line-height: 1; color:gray;">Blvd. Gral. Marcelino García Barragán 1421, Olímpica, 44430 Guadalajara, Jal.</p>
                        </th>
                    </table>
                    <table class="mt-3">
                        <tbody>
                            <tr>
                                <th class="" style="text-align: center;" colspan="2">Médico</th>
                            </tr>
                            <tr>
                                <th width="250px">Nombre:</th>
                                <td><?php echo $agenda[0]['Nombre'].' '.$agenda[0]['Apellidos']; ?></td>
                            </tr>
                            <tr>
                                <th>Especialidad:</th>
                                <td><?php echo $agenda[0]['Especialidad']; ?></td>
                            </tr>
                            <tr>
                                <th>Cédula médica:</th>
                                <td><?php echo $agenda[0]['Cedula_medica']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="mt-3">
                        <tr>
                            <th style="text-align: center;" colspan="4">
                                Calendario citas médicas
                            </th>
                        </tr>
                        <tr>
                            <th width="50px">N°</th>
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Hora</th>
                            <th style="text-align: center;">Paciente</th>
                        </tr>
                        <?php
                            $n =1;
                            foreach ($agenda as $row) {
                        ?>
                                <tr>
                                    <td><?php echo $n; ?></td>
                                    <td><?php echo $row['Fecha'];?></td>
                                    <td><?php echo $row['Hora'];?></td>
                                    <td><?php echo $row['N_paciente'].' '.$row['A_paciente'];?></td>
                                </tr>
                        <?php
                                $n++;
                            }
                        ?>
                    </table>
                </div> 
        </section>
        <footer>
            Copyright &copy; <?php echo date("Y");?> Team 7 - Medical Control System
        </footer>
    </body>
    </html>