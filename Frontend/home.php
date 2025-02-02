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
    <link type='text/css' rel='stylesheet' href='CSS/Home.css'>

    <!--Bootstrap-->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>
    <link rel='icon' type='image/x-icon' href='Images/api.png'>

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
                            <a class='nav-link active' aria-current='page' href='Post/Create.php' style='height: 38px;'>
                                <img src='Images/plus.png' style='width: 20px; height: 20px;'>
                            </a>
                        </li>
                    </ul>
                    <form class='d-flex' role='search' action='../Backend/search.php' method='post' style='flex-grow: 1; margin-right: 10px;'>
                        <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' name='searchQuery' id='searchQuery'>
                        <button class='btn btn-outline-success' style='height: 38px;' type='submit'><img src='Images/search.png' style='height: 20px; width: 20px'></button>
                    </form>
                    <button class='btn btn-outline-danger' type='button' onclick='logout()' style='height: 38px;'><img src='Images/logout.png' style='width: 20px; height: 20px;'></button>
                </div>
            </div>
        </nav>
    </header>

    <?php
    include "../Backend/connection.php";
    $query = "Select * from post";
    $result = mysqli_query($Connection, $query);
    $nbr = mysqli_num_rows($result);
    ?>
    <table>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
            $row = mysqli_fetch_assoc($result);
            $img = $row['img'];
            echo "<table class='data-block' cellspacing='25'>";
            echo "<tr><td>$row[title]</td></tr>";
            echo "<tr><td><a href='../Backend/comment.php?id=$row[id]'><img id='Img' src='Images/$img' style='cursor: pointer'></a></td></tr>";
            echo "<tr><td>$row[description]</td></tr>";
            echo "<tr><td><a href='../Backend/Delete/post.php?id=$row[id]'><img src='Images/delete.png' style='cursor: pointer; width: 50px'></a></td>";
            echo "<td><a href='Images/" . $img . "' download><img src='Images/download.png' style='cursor: pointer; width: 30px'></a></td></tr>";
            echo "</table>";
        }
        ?>
    </table>
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
    <script type='text/javascript' src='JS/Home.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>

</body>

</html>