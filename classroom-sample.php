<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css" />

    <meta name="author" content="Joey Elsisi, Stuart Paine">
    <meta name="description" content="Study Spot Project">

    <title>Rice Hall 011</title>
</head>

<body>
    <header>
        <!--Top navigation bar-->
        <div id="top-navbar-placeholder">
            <?php include ("top-navbar.php"); ?>
        </div>
    </header>

    <main>
        <!--Navigation route breadcrumb-->
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Buildings</a></li>
                    <li class="breadcrumb-item"><a href="?command=building">Rice Hall</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rice Hall 011</li>
                </ol>
            </nav>
        </div>
        <div class="row bcr-name">
            <h2>Rice Hall 011</h2>
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
                            <a href="?command=classroom" title="current-status"></a>
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
        <div class="row">
            <!--Responsive column-->
            <div class="col-lg-1">

            </div>
            <!--Sample calendar view-->
            <div class="col">
                <iframe
                    src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%2390cc90&ctz=America%2FNew_York&showNav=1&mode=WEEK&showTitle=0&showDate=1&showPrint=1&showTabs=1&showCalendars=0&showTz=1&src=b2Y5cWY2aXJyNGR2Z2o1cnZwbnNuZWZxNmdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23E67C73"
                    style="width: 100%;" height="600" title="calendar"></iframe>
            </div>
            <!--Responsive column-->
            <div class="col-lg-1">

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
</body>

</html>