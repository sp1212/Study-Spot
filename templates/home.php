<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/home.css" />
    <link rel="stylesheet" href="../styles/main.css" />

    <meta name="author" content="Joey Elsisi, Stuart Paine">
    <meta name="description" content="Study Spot Project">

    <title>Home</title>
</head>

<body>
    <header>
        <div id="top-navbar-placeholder">
            <?php include("top-navbar.php"); ?>
        </div>
    </header>

    <div class="home">
        <h1 class="title">Study Spot</h1>

        <h2 class="as-of">
            <a class="refresh" href=""><?php
                $now = new DateTime(null, new DateTimeZone($_SESSION['timezone']));
                echo $now->format('g:i A') . "<br>";
            ?></a>
        </h2>

        <!--    opening card immediately gives user information -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted"><span class="status">Open now</span>: Rice 130</h6>
                <h6 class="card-subtitle mb-2 text-muted"><span class="distance">Distance</span>: 78 ft away</h6>
                <h6 class="card-subtitle mb-2 text-muted"><span class="next">At 1:30</span>: Olsson 005</h6>
            </div>
        </div>

        <!--search bar-->
        <form class="search-wrap">
            <div class="search">
                <img type="image" id="submit" class="search-button" src="../images/icons8-search.svg"
                    alt="search button">
                <input type="text" id="text-search" placeholder="Find a building">
                <!--look into fontawesome.com-->
            </div>
        </form>

        <!--    building suggestions -->
        <div class="container">
            <span><a href="?command=building"> Rice Hall</a> </span>
            <span> Monroe Hall </span>
            <span> Bryan Hall </span>
            <span> Brown Hall </span>
            <span> Gibson Hall </span>
            <span> Wilson Hall </span>
            <span> Chemistry Bldg </span>
            <span> Campbell Hall </span>
            <span> Robertson Hall </span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
        </script>
</body>

</html>