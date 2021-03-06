<?php Vue::montrer('standard/layout'); ?>
<main id="home" class="row">

    <!-- Les différentes sections (Aujourdhui, Semaine, Graph) -->
    <!-- Aujourd'hui -->
    <section class="tabs col ">
        <input type="radio" name="tabs" id="tabone" checked="checked">
        <label for="tabone">Aujourd'hui</label>
        <section class="tab row d-flex flex-column">
            <section class="mainpanel justify-content-around col d-flex ">
                <section class="inside d-flex align-items-center flex-lg-column flex-xl-column flex-md-row flex-sm-row flex-row justify-content-between col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <section class="inout d-flex justify-content-around flex-lg-column flex-xl-column flex-md-row flex-sm-row flex-row align-items-center col-6 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                        <h3>Intérieur</h3>
                        <section id="minMaxIn"></section>
                        <?php
                        function displaySensorData($UserIDParam, $SensorIDParam) {
                            if(!isset($DB))
                                $DB = new Database();
                            $queryResult =  $DB->SelectQueryWhere('SensorsData', ['*'], ' WHERE SensorID=' . $SensorIDParam . ' AND UserID=' . $UserIDParam . ';');
//                        var_dump($queryResult);
                            $moy = 0;
                            $i = 0;
                            foreach ($queryResult as $result) {
                                if ($i === 0) {
                                    $min = $result['Value'];
                                    $max = $result['Value'];
                                }

                                if (isset($min) && $result['Value'] < $min) {
                                    $min = $result['Value'];
                                }
                                if (isset($max) && $result['Value'] > $max) {
                                    $max = $result['Value'];
                                }
//                            var_dump($result);
                                $moy = $moy + $result['Value'];
                                $i++;
                            }

                            if ($i > 0)
                            {
                                $moy = $moy / ($i);
                                echo '<h4>Max : ' . $max . '° / Min : ' . $min . '° / Moy : ' . number_format( $moy , 1) . '°</h4>';
                            } else {
                                echo '<h4>no data in db or not logged in</h4>';
                            }
                        }
                        if(session_id() == '' || !isset($_SESSION)) {
                            // session isn't started
                            session_start();
                        }
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                            displaySensorData($_SESSION['UserID'], 1);
                        } else {
                            displaySensorData(1, 1);
                        }
                        ?>
                        <!-- <h4>Max : 35° / Min : 14°</h4> -->
                        <section class="tempe">
                            <img src="../../Assets/img/thermometer.png" alt="Thermomètre">
                            <!-- <p>15°</p> -->
                        </section>
                    </section>
                    <section class="bandeau d-flex text-center justify-content-center align-items-center col-6 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                        <img src="../../Assets/img/eclamation.png" alt="Eclamation">
                    </section>
                </section>
                <section class="scission flex-xl-column col d-none d-sm-none d-md-none d-lg-block d-xl-block"></section>
                <section class="outside d-flex align-items-center flex-lg-column flex-xl-column flex-md-row flex-sm-row flex-row flex-row justify-content-between col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <section class="inout d-flex justify-content-around flex-lg-column flex-xl-column flex-md-row flex-sm-row flex-row align-items-center col-6 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                        <h3>Extérieur</h3>
                        <section id="minMaxOut"></section>
                        <?php
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                            displaySensorData($_SESSION['UserID'], 2);
                        } else {
                            displaySensorData(1, 2);
                        }

                        ?>
                        <section class="tempe">
                            <img src="../../Assets/img/thermometer.png" alt="Thermomètre">
                        </section>
                    </section>
                    <section class="bandeau bandeauout d-flex align-items-center justify-content-center flex-lg-row flex-xl-row flex-md-rocolumnw flex-sm-column flex-column col-6 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    </section>
                </section>
            </section>
        </section>
        <!-- Semaine -->
        <input type="radio" name="tabs" id="tabtwo">
        <label id="tabWeek" for="tabtwo">Semaine</label>
        <section class="tab">
            <table class="fl-table tftable" border="1">
                <tr>
                    <th>J-1</th>
                    <th>J-2</th>
                    <th>J-3</th>
                    <th>J-4</th>
                    <th>J-5</th>
                </tr>
                <tr>
                    <td> IN </td>
                    <td> IN </td>
                    <td> IN </td>
                    <td> IN </td>
                    <td> IN </td>
                </tr>
                <tr id="tableInTemp">
                    <!-- <td>26°</td>
                    <td>23°</td>
                    <td>23°</td>
                    <td>23°</td>
                    <td>23°</td> -->
                </tr>
                <tr>
                    <td> OUT </td>
                    <td> OUT </td>
                    <td> OUT </td>
                    <td> OUT </td>
                    <td> OUT </td>
                </tr>
                <tr id="tableOutTemp">
                    <!-- <td>23°</td>
                    <td>23°</td>
                    <td>23°</td>
                    <td>23°</td>
                    <td>23°</td> -->
                </tr>
            </table>
        </section>
        <!-- Graph -->
        <input type="radio" name="tabs" id="tabthree">
        <label id="thirdTab" for="tabthree">Graph</label>
        <section class="tab">
            <section class="graph">
                <img class="img-fluid" src="../../Assets/img/line-chart.png" alt="Graphique">
            </section>
        </section>
    </section>
</main>
<section id="panel_above" class="container-fluid">
    <nav id="panel_nav">
        <img src="../../Assets/img/close.png">
    </nav>
    <main class="settings_panel row d-flex flex-lg-row flex-xl-row flex-md-column flex-sm-column justify-content-center align-items-center">
        <section class="d-flex align-items-center flex-lg-column flex-xl-column flex-md-row  flex-sm-column flex-column justify-content-between col-10 col-sm-10 col-md-10 col-lg-6 col-xl-6">
            <p class="titlePanel">Paramètres</p>
        </section>
        <section>
            <a href="/documentation">Documentation</a>
        <section>
        <section class="d-flex align-items-center flex-lg-column flex-xl-column flex-md-row flex-sm-column flex-column justify-content-between col-10 col-sm-10 col-md-10 col-lg-6 col-xl-6">
            <p class="titlePanel">Informations</p>
         </section>
    </main>
</section>


<!-- JQuery -->
<?php Vue::montrer('standard/script'); ?>
<!-- Home page Javascript -->
<?php Vue::montrer('Home/script'); ?>


