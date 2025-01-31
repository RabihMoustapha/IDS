<?php
if (isset($_GET['name']) && !empty($_GET['name']) & isset($_GET['password']) && !empty($_GET['password']) && isset($_GET['email']) && !empty($_GET['email'])) {
    $name = $_GET['name'];
    echo "<div class='welcome-message'>Hello $name</div>";
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Home</title>

    <!--CSS-->
    <link type='text/css' rel='stylesheet' href='../Frontend/CSS/Home.css'>

    <!--Bootstrap-->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>
    <link rel='icon' type='image/x-icon' href='../Frontend/Images/api.png'>

</head>

<body>
    <header>
        <nav class='navbar navbar-expand-lg bg-body-tertiary'>
            <div class='container-fluid'>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse'
                    data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent'
                    aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                        <li class='nav-item'>
                            <a class='nav-link active' aria-current='page' href='../Frontend/Post/Create.php' style='height: 38px;'>
                                <img src='../Frontend/Images/plus.png' style='width: 20px; height: 20px;'>
                            </a>
                        </li>
                    </ul>
                    <form class='d-flex' role='search' method='post' style='flex-grow: 1; margin-right: 10px;'>
                        <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' id='searchQuery'>
                        <button class='btn btn-outline-success' style='height: 38px;' type='submit'><img src='../Frontend/Images/search.png' style='height: 20px; width: 20px'></button>
                    </form>
                    <button class='btn btn-outline-danger' type='button' onclick='logout()' style='height: 38px;'><img src='../Frontend/Images/logout.png' style='width: 20px; height: 20px;'></button>
                </div>
            </div>
        </nav>
    </header>

    <?php
    include "connection.php";
    $searchQuery = $_POST['searchQuery'];
    $query = "Select * from post where description like $searchQuery";
    $result = mysqli_query($Connection, $query);
    $nbr = mysqli_num_rows($result);
    ?>
    <table class="data-block" cellspacing="25">
        <tr>
            <th>Title</th>
            <th>Img</th>
            <th>Description</th>
        </tr>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
            $row = mysqli_fetch_assoc($result);
            echo "<tr>";
            echo "<td>$row[title]</td>";
            echo "<td><img id='Img' src='../Frontend/Images/$row[img]' class='user'></td>";
            echo "<td>$row[description]</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>

        <!--Footer-->
        <footer class='footer'>
            <div class='footer-container'>
                <p>WebApi. All rights reserved.</p>
                <ul class='footer-links'>
                    <li><a href='tel:+961818140764'>Phone Number</a></li>
                    <li><a href='mailto:mostapharabih59@gmail.com'>Email</a></li>
                    <li><a href='https://github.com/RabihMoustapha'>GitHub</a></li>
                </ul>
            </div>
        </footer>

        <!--Scripts-->
        <script type='text/javascript' src='../Frontend/JS/Home.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>

</body>

</html>