<div class="container elegant-color-dark shadow-lg rounded-lg my-5 p-5">

    <?php
    $mysqli = connect();
    $res = $mysqli->query("SELECT * FROM countries ORDER BY country");
    ?>
    <!-- Выбор страны и города -->
    <div class='row justify-content-center elegant-color py-5 px-2 rounded'>

        <?php
        $countryid;
        $index = 0;
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            $countryid = $row[0];
            echo "
            <div class='col-12 col-md-12 col-lg-12 mb-4'>

                <div class='card bg-transparent'>
                    <form method='post'>
                        <div class='card-header border border-white px-2 py-0'>
                            <img class='card-img-64 rounded-circle' src='./$row[2]' alt='flag'>
                        </div>
                        <div class='card-body bg-white px-3 py-2'>
                            <p class='h3 font-weight-lighter'>$row[1]</p>
                            <p>$row[3]</p>
                            <p class=''>Выберите город из предложенного списка:</p>

                            <div class='accordion' id='accordion-$countryid'>";
                            $resCity = $mysqli->query("SELECT * FROM cities where countryid=" . $countryid . " ORDER BY city");
                            while ($row = mysqli_fetch_array($resCity, MYSQLI_NUM)) {
                                echo "
                                <div class='card rounded-0 border-0'>
                                    <div class='card-header d-flex align-items-center bg-white border-0 p-0 m-0' id='heading-$countryid'>
                                        <button class='btn shadow-none btn-block border-bottom border-warning text-decoration-none d-flex justify-content-between align-items-center py-2 px-3' type='button' data-toggle='collapse' data-target='#collapse-$index' aria-expanded='true' aria-controls='collapse-$index'>
                                            <span class='text-left lead font-weight-light'>$row[1]...</span>
                                            <i class='fas fa-chevron-down'></i>
                                        </button>
                                    </div>

                                    <div id='collapse-$index' class='collapse py-2' aria-labelledby='heading-$countryid' data-parent='#accordion-$countryid'>
                                        <div class='card-body'>";
                                        echo (file_get_contents($row[3]));
                                        echo "
                                        </div>

                                        <div class='d-flex justify-content-end px-3'>
                                            <button name='selcity-$index' class='btn btn-md font-weight-bold btn-outline-secondary' type='button' data-toggle='modal' data-target='#basicExampleModal-$row[0]'>Смотреть отели</button>
                                        </div>
                                    </div>

                                </div>";
                                
                                echo"
                                <div class='modal fade' id='basicExampleModal-$row[0]' tabindex='-1' role='dialog'
                                aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-fluid modal-dialog-scrollable' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header d-flex align-items-center mdb-color accent-4'>
                                                <p class='modal-title white-text h2' id='exampleModalLabel'>Наши отели города $row[1]</p>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <i class='fas fa-times' aria-hidden='true'></i>
                                                </button>
                                            </div>
                                            <div class='modal-body'>";
                                            $cityid = $row[0];
                                            $rowModal = mysqli_fetch_array($resModal, MYSQLI_NUM);
                                            $selModal = "SELECT co.country, ci.city, ho.hotel, ho.cost, ho.stars, ho.id, ho.info FROM hotels ho, cities ci, countries co  WHERE ho.cityid=ci.id  AND ho.countryid=co.id AND ho.cityid=$cityid";
                                            $resModal = $mysqli->query($selModal);

                                            echo "
                                            <div class='row'>
                                            ";
                                            while ($rowModal = mysqli_fetch_array($resModal, MYSQLI_NUM)) {
                                                echo "
                                                    <div class='col-12 col-lg-12 col-xl-6 my-3'>
                                                        <div class='card'>
                                                            <div class='card-header mdb-color lighten-4'>
                                                                <span class='h4 font-weight-lighter'>Отель - $rowModal[2]</span>
                                                            </div>
                                                            <div class='card-body d-flex flex-column justify-content-center'>";

                                                                echo "<div class='text-center mb-3'>";
                                                                for ($i = 0; $i < $rowModal[4]; $i++) {
                                                                    echo "<i class='fas elegant-ic fa-star'></i>";
                                                                }
                                                                echo "</div>";

                                                                echo"
                                                                <p class='text-center'>$rowModal[6]</p>
                                                                <p class='text-center'>Стоимость отеля: <b>$rowModal[3]</b><i class='fas green-ic fa-dollar-sign'></i></p>
                                                                <a class='btn btn-link text-primary btn-lg' href='pages/hotelinfo.php?hotel=$rowModal[5]' target='_blank'>Смотеть отель.</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ";
                                            }
                                            mysqli_free_result($resModal);
                                            echo "</div>";

                                            echo"
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                ";
                                
                                $index++;
                                $speed += 0.2;
                            }
                            
                        echo "
                            </div>
                            
                        </div>
                        <div class='card-footer bg-white  p-0'>
                        </div>
                    </form>
                </div>

            </div>
            ";
        };
        mysqli_free_result($res);
        ?>
    </div>

</div>