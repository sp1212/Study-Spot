<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/home.css" />
    <link rel="stylesheet" href="./styles/main.css" />

    <meta name="author" content="Joey Elsisi, Stuart Paine">
    <meta name="description" content="Study Spot Project">

    <title>Home</title>
</head>

<body onload="getBuildingList(getBuildings)">
    <header>
        <div id="top-navbar-placeholder">
            <?php include("top-navbar.php"); ?>
        </div>
    </header>

    <main>
        <div class="home row">
            <h1 class="title">Study Spot</h1>
    
            <h2 class="as-of">
                <a class="refresh" href="" style="color: green">
                    <?php
                        $now = new DateTime(null, new DateTimeZone($_SESSION['timezone']));
                        echo $now->format('g:i A') . "<br>";
                    ?>
                </a>
            </h2>
    
            <!--    opening card immediately gives user information -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted"><span class="status">Open now</span>: Rice 130</h6>
                    <h6 class="card-subtitle mb-2 text-muted"><span class="distance">Distance</span>: 78 ft away</h6>
                    <h6 class="card-subtitle mb-2 text-muted"><span class="next">At 1:30</span>: Olsson 005</h6>
                </div>
            </div>
        </div>
        <div class="home row">
            <!--look into fontawesome.com-->
            <!--search bar-->
            <form class="search-wrap" action="?command=home" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" id="text-search" placeholder="Find a building" name="search" required>
                    <input type="image" id="submit" class="search-button" src="./images/icons8-search.svg"
                        alt="search button">
                </div>
            </form>
        </div>
        <div class="home row">
            <!--    building suggestions -->
            <div class="container">
                <span><a href="?command=building&name=<?=$_SESSION["searches"][0]?>"><?=$_SESSION["searches"][0]?></a></span>
                <span><a href="?command=building&name=<?=$_SESSION["searches"][1]?>"><?=$_SESSION["searches"][1]?></a></span>
                <span><a href="?command=building&name=<?=$_SESSION["searches"][2]?>"><?=$_SESSION["searches"][2]?></a></span>
                <span><a href="?command=building&name=<?=$_SESSION["searches"][3]?>"><?=$_SESSION["searches"][3]?></a></span>
                <span><a href="?command=building&name=<?=$_SESSION["searches"][4]?>"><?=$_SESSION["searches"][4]?></a></span>
                <span><a href="?command=building&name=<?=$_SESSION["searches"][5]?>"><?=$_SESSION["searches"][5]?></a></span>
                <span><a href="?command=building&name=<?=$_SESSION["searches"][6]?>"><?=$_SESSION["searches"][6]?></a></span>
                <span><a href="?command=building&name=<?=$_SESSION["searches"][7]?>"><?=$_SESSION["searches"][7]?></a></span>
            </div>
        </div>
        <div class="home row">
            <p>
                <a class="btn btn-dark btn-sm" data-bs-toggle="collapse" href="#buildingsCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                    All Buildings
                </a>
            </p>
            <div class="collapse" id="buildingsCollapse">
                <div class="card card-body" id="collapsedBuildingList">
                    <b>Buildings</b>
                </div>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <script>
        var buildings = {
            arr: []
        };

        function getBuildings(newList) {
            buildings.arr = newList.sort(sortBuildings);
            var list = document.getElementById("collapsedBuildingList");
            for (var i = 0; i < buildings.arr.length; i++)
            {
                list.innerHTML += "<hr>" + buildings.arr[i].name + "<br>";
            }
        }

        function sortBuildings (a, b)
        {
            return a.name.localeCompare(b.name);
        }

        function queryBuildings() {
            return new Promise(resolve => {
                // instantiate the object
                var ajax = new XMLHttpRequest();
                // open the request
                ajax.open("GET", "?command=jsonbuildings", true);
                // ask for a specific response
                ajax.responseType = "json";
                // send the request
                ajax.send(null);

                // What happens if the load succeeds
                ajax.addEventListener("load", function () {
                    // Return the list as the fulfillment of the promise 
                    if (this.status == 200) { // worked 
                        resolve(this.response);
                    } else {
                        console.log("When trying to get a new list of buildings, the server returned an HTTP error code.");
                    }
                });

                // What happens on error
                ajax.addEventListener("error", function () {
                    console.log("When trying to get a new list of buildings, the connection to the server failed.");
                });
            });
        }

        async function getBuildingList(callback) {
            var newList = await queryBuildings();
            callback(newList);
        }
    </script>
</body>

</html>