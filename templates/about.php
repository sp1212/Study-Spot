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

    <title>About</title>
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
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
        <div class="row bcr-name">
            <h2>About Study Spot</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 justify-content-center bcr-name">
                <p>This application has been developed as a project for 
                    <a href="https://cs4640.cs.virginia.edu/" target="_blank" style="text-decoration: none">UVA CS 4640</a>.
                </p>
                <h4>Motivation</h4>
                <p>Although libraries are perhaps the most typical study space, many students find that these spaces 
                    are overcrowded, noisy, or simply too far away to be used conveniently.  Our project, Study Spot, 
                    aims to address this through a web application that allows (UVA) students to search for and view when 
                    and what classrooms around grounds are openly available at any given time, whether that be the present 
                    day or the upcoming week.  This methodology is based on the idea that a given classroom in which no 
                    course is being formally taught at a given time is likely empty and consequently available for use 
                    by students as a study space.
                </p>
            </div>
            <p class="as-of">
                <?php
                    $now = new DateTime(null, new DateTimeZone($_SESSION['timezone']));
                    echo "Updated " . $now->format('g:i:s A') . "<br>";
                ?>
                <a class="refresh" href="">(Refresh to update)</a>
            </p>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
        </script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
</body>

</html>