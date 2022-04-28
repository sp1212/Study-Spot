<!--Authors:  Stuart Paine & Joey Elsisi (not in a meta tag because this html is inserted via JS into other html files)-->

<!--Top navigation bar-->
<nav class="navbar navbar-expand-lg navbar-light nav-green">
    <div class="container-fluid">
        <!--Branded-->
        <a class="navbar-brand brand-text" href="?command=home">Study Spot</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Main links-->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?command=buildinglist">Buildings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?command=secretspots">Secret Spots</a>
                </li>
                <!--Search bar-->
                <li class="nav-item">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Find a spot" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?command=about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
                </li>
            </ul>

            <!--User info and profile links-->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                        Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php
                        if (isset($_SESSION["email"]))
                        {
                            echo "<li><a class=\"dropdown-item\" aria-current=\"page\" href=\"?command=profile\">View Profile</a></li>";
                            echo "<li><a class=\"dropdown-item\" aria-current=\"page\" href=\"?command=logout\">Logout</a></li>";
                        }
                        else
                        {
                            echo "<li><a class=\"dropdown-item\" aria-current=\"page\" href=\"?command=login\">Login</a></li>";
                            echo "<li><a class=\"dropdown-item\" aria-current=\"page\" href=\"?command=createaccount\">Create Acc</a></li>";
                        }
                    ?>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>