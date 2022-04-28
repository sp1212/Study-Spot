<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/main.css" />

    <meta name="author" content="Joey Elsisi, Stuart Paine">
    <meta name="description" content="Study Spot Project">

    <title><?=$_GET["name"]?></title>
</head>

<body>
    <header>
        <!--Top navigation bar-->
        <div id="top-navbar-placeholder">
            <?php include("top-navbar.php"); ?>
        </div>
    </header>

    <main>
        <!--Navigation route breadcrumb-->
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?command=buildinglist">Buildings</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$_GET["name"]?></li>
                </ol>
            </nav>
        </div>
        <div class="row bcr-name">
            <h2><?=$_GET["name"]?></h2>
        </div>
        <!--List of each classroom and availability within the building-->
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col">
                <?php
                $now = new DateTime(null, new DateTimeZone($_SESSION['timezone']));
                $status = "open";
                $until = "Until";
                /*
                 * $classList[$name] returns a classroom object, we need to access it's properties
                 */
                $classListTimes = Buildings::$classList[$_GET["name"]]->classListTimes;
//                echo "<pre>";
//                print_r($classListTimes);
//                echo "</pre>";
                foreach ($classListTimes as $room => $dayList){
//                    echo "<h1>" . $room . "</h1>";
                    $dayName = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
                    $currDay = $dayName[$now->format("w")];
                    foreach($dayList as $dayHeld => $value){

                        if($dayHeld == $currDay){
//                            echo "<pre>";
//                            print_r($value);
//                            echo "</pre>";
                            foreach ($value as $lecture){
//                                echo "<pre>";
//                                print_r($lecture);
//                                echo "</pre>";
                                //if a class is being held right now, status is closed and we can break the loop
                                if(($lecture["start"] <= $now) && ($now <= $lecture["end"])){
                                    $status = "closed";
                                    $until = "Until " . $lecture["end"]->format("g:ia");
                                    break;
                                }
                                //todo need to determine if there is a back-to-back class to say that the room is reserved until much later
                                //todo not sure what the below code does
                                if($status == "closed"){
                                    break;
                                }
                                //might need to do html logic here now
                            }

                        }


                    }

                ?>
                <div class="row cr-list-item <?=$status?>-list-item">
                    <a href="?command=classroom&name=<?=$_GET["name"]?>&classroom=<?=$room?>" title="Rice Hall 011"></a>
                    <div class="col-4 cr-name">
                        <?=$room?>
                    </div>
                    <div class="col-4 <?php
                    if($status == "closed"){
                        echo "in-use";
                    } else {
                        echo $status;
                    }
                    ?>
                    ">
                        <?php
                        if($status == "open"){
                            echo "Open";
                        } else {
                            echo "In Use";
                        }
                      ?>
                    </div>
                    <div class="col-4 until">
                    <?=$until?>
                    </div>
                </div>

                <?php
                }
                ?>
                <!--Page last updated info-->
                <p class="as-of">
                    <?php
                        echo "Updated " . $now->format('g:i:s A') . "<br>";
                    ?>
                    <a class="refresh" href="">(Refresh to update)</a>
                </p>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
        </script>
    <script>
        setTimeout(function () { location.reload(true); }, 60000);
    </script>
</body>

</html>