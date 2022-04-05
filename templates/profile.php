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

    <title>Profile</title>
</head>

<body>
    <header>
        <!--Top navigation bar-->
        <div id="top-navbar-placeholder">
            <?php include("top-navbar.php"); ?>
        </div>
    </header>

    <main>
        <div class="row bcr-name">
            <h2>User Profile</h2>
        </div>
        <div class="row justify-content-center">
            <div class="row bcr-name">
                <h4><?=$_SESSION['name']?></h4>
                <h4><?=$_SESSION['email']?></h4>
                <h4><?=$_SESSION['timezone']?></h4>
            </div>
            <div class="col-7">
                <form action="?command=profile" method="post">
                    <div class="mb-3">
                        <label for="timezone" class="form-label">Time Zone</label>
                        <select class="form-control form-select" id="timezone" name="timezone">
                            <option>America/New_York</option>
                            <option>America/Chicago</option>
                            <option>America/Denver</option>
                            <option>America/Los_Angeles</option>
                        </select>
                        <input type="hidden" id="userid" name="userid" value="<?=$_SESSION['userid']?>">
                    </div>
                    <div class="text-center">                
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
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
</body>

</html>