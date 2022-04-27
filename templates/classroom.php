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
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

<title><?=$_GET["classroom"]?></title>
</head>

<body>
    <header>
        <!--Top navigation bar-->
        <div id="top-navbar-placeholder">
            <?php include("top-navbar.php"); ?>
        </div>
    </header>

    <main>
        <?php
        $classListTimes = Buildings::$classList[$_GET["name"]]->classListTimes;
//        print_r($classListTimes);
        ?>
        <!--Navigation route breadcrumb-->
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?command=buildinglist">Buildings</a></li>
                    <li class="breadcrumb-item"><a href="?command=building&name=<?=$_GET["name"]?>"><?=$_GET["name"]?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$_GET["classroom"]?></li>
                </ol>
            </nav>
        </div>
        <div class="row bcr-name">
            <h2><?=$_GET["classroom"]?></h2>
        </div>
        <div class="row">
            <!--Responsive column-->
            <div class="col-lg-1">

            </div>

            <div class="col">
                <div class="row">
                    <!--Current status of the classroom-->
                    <div class="col-3 cr-current-status">
                        <h3>Current Status:</h3>
                    </div>
                    <div class="col-9">
                        <div class="row cr-list-item open-list-item">
                            <a href="" title="current-status"></a>
                            <div class="col open">
                                Open
                            </div>
                            <div class="col until">
                                Until 2:30pm
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Responsive column-->
            <div class="col-lg-1">

            </div>
        </div>
        <style>
            @import "styles/calendar.css";
        </style>
<!-- with help from this reference: https://codepen.io/m0skar/pen/WjBdVW?editors=1100-->
        <div class="calendar">
            <div class="outer">
                <table>
                    <thead>
                    <tr>
                        <th class="timeCol"></th>
                        <th class="discolor">Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th class="discolor">Sat</th>
                    </tr>
                    </thead>
                </table>

                <div class="wrap">
                    <table>
                        <tbody>
                        <tr>
                            <td class="timeCol">7:00 am</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td class="live"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">8:00 am</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><div class="lecture double"><input id="check" type="checkbox" class="checkbox" /><label for="check"></label>8:30–9:30 Unforgettable Lectures</div></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">9:00 am</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">10:00 am</td>
                            <td></td>
                            <td></td>
                            <td><div class="lecture double"><input id="check" type="checkbox" class="checkbox" /><label for="check"></label>10:00–11:00 Biology</div></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">11:00 am</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">12:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">1:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">2:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">3:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">4:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">5:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">6:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol">7:00 pm</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="timeCol"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <!--Responsive column-->
            <div class="col-lg-1">
            </div>
            <!--Sample calendar view-->
            <div class="col">
<!--                <iframe-->
<!--                    src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%2390cc90&ctz=America%2FNew_York&showNav=1&mode=WEEK&showTitle=0&showDate=1&showPrint=1&showTabs=1&showCalendars=0&showTz=1&src=b2Y5cWY2aXJyNGR2Z2o1cnZwbnNuZWZxNmdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23E67C73"-->
<!--                    style="width: 100%;" height="600" title="calendar"></iframe>-->
                <!--Page last updated info-->
                <p class="as-of">
                    <?php
                        $now = new DateTime(null, new DateTimeZone($_SESSION['timezone']));
                        echo "Updated " . $now->format('g:i:s A') . "<br>";
                    ?>
                    <a class="refresh" href="">(Refresh to update)</a>
                </p>
            </div>
            <!--Responsive column-->
            <div class="col-lg-1">

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
    <script>
        setTimeout(function () { location.reload(true); }, 60000);
        let time = new Date();
        let day = time.getDay();
        let selectDay = $("th")[day+1];
        selectDay.className += " today";
    </script>
</body>

</html>