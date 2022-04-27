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

    <title>Secret Spots</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Secret Spots</li>
                </ol>
            </nav>
        </div>
        <div class="row bcr-name">
            <h2>Secret Spots</h2>
        </div>
        <div class="row justify-content-center">
            <div class="row bcr-name">
                <p>These study spots have been shared by fellow users.  Please vote for spots you like and share your own!</p>
            </div>
            <div class="row justify-content-center bcr-name">
                <div class="col-lg-4">
                <form action="?command=secretspots" method="post">
                    <div class="mb-3">
                        <label for="spot" class="form-label">Share a Spot</label>
                        <input type="text" class="form-control" id="spot" name="spot" required/>
                    </div>
                    <?php 
                    if (strcmp($error_msg, "") != 0)
                    {
                        echo "<div class='alert alert-danger'>" . $error_msg . "</div>";
                    }
                    ?>
                    <div class="text-center">                
                        <button type="submit" class="btn btn-success">Submit Spot</button>
                    </div>
                </form>
                </div>
            </div>
            <div class="col-lg-7">
                <table class="table" style="text-align: center; margin-left: auto; margin-right: auto;">
                    <tr>
                        <th>Name</th>
                        <th>Votes</th>
                        <th></th>
                    </tr>
                    <?php
                        foreach($data as $spot) {
                    ?>
                        <tr>
                            <td><?=$spot["name"]?></td>
                            <td><?=$spot["votes"]?></td>
                            <td>
                                <form method="post">
                                    <button type="submit" class="btn btn-sm btn-success" name="upvote" value="<?=$spot["name"]?>">Upvote</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
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