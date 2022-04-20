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

    <title>Buildings List</title>
</head>

<style>
    #toTopBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: #222;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 4px;
  }

  #toTopBtn:hover {
    background-color: #555;
  }
</style>

<body>

<button onclick="topFunction()" id="toTopBtn" title="Go to top">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-up"
      viewBox="0 0 16 16">
      <path fill-rule="evenodd"
        d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z" />
    </svg>
</button>

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
                <li class="breadcrumb-item active" aria-current="page">Buildings</li>
            </ol>
        </nav>
    </div>
    <div class="row bcr-name">
        <h2>Select a Building</h2>
    </div>

    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col">

        <?php
        foreach($_SESSION["buildings"] as $building){
            ?>

            <div class="row cr-list-item open-list-item">
                <a href="?command=building&name=<?=$building["name"]?>" title="Rice Hall 011"></a>
                <div class="col-4 cr-name">
                    <?=$building["name"]?>
                </div>
                <div class="col-4 open">
                    Open
                </div>
                <div class="col-4 until">
                    Until 2:30pm
                </div>
            </div>
            <?php
        }
        ?>

            <p class="as-of">
                <?php
                $now = new DateTime(null, new DateTimeZone($_SESSION['timezone']));
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
    // Reference: previous personal (scp4exq) project
    //Get the button
    var topButton = document.getElementById("toTopBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            topButton.style.display = "block";
        } else {
            topButton.style.display = "none";
      }
    };

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
</script>
</body>

</html>