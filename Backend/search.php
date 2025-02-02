<link href='../Frontend/CSS/Home.css' type='text/css' rel='stylesheet'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>
<link rel='icon' type='image/x-icon' href='../Frontend/Images/api.png'>
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
                        <a class='nav-link active' aria-current='page' href='../Frontend/Home.php' style='height: 38px;'>
                            <img src='../Frontend/Images/home.png' style='width: 20px; height: 20px;'>
                        </a>
                    </li>
                </ul>
                <form class='d-flex' role='search' action='search.php' method='post' style='flex-grow: 1; margin-right: 10px;'>
                    <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' name='searchQuery' id='searchQuery'>
                    <button class='btn btn-outline-success' style='height: 38px;' type='submit'><img src='../Frontend/Images/search.png' style='height: 20px; width: 20px'></button>
                </form>
                <button class='btn btn-outline-danger' type='button' onclick='logout()' style='height: 38px;'><img src='../Frontend/Images/logout.png' style='width: 20px; height: 20px;'></button>
            </div>
        </div>
    </nav>
</header>
<?php
include 'connection.php';

if (isset($_POST['searchQuery'])) {
    $searchQuery = mysqli_real_escape_string($Connection, $_POST['searchQuery']);
    $query = "SELECT * FROM post WHERE title LIKE ? OR description LIKE ?";
    $stmt = mysqli_prepare($Connection, $query);

    if ($stmt) {
        //Arduino syntax that mean can contain before or after the specified string
        $searchTerm = "%" . $searchQuery . "%";

        //ss for searchTerm type(string)
        mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $nbr = mysqli_num_rows($result);
        echo "<table>";
        if ($nbr > 0) {
            echo "<table class='data-block' cellspacing='25'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $img = $row['img'];
                echo "<table class='data-block' cellspacing='25'>";
                echo "<tr><td>" . htmlspecialchars($row['title']) . "</td></tr>";
                echo "<tr><td><a href='comment.php?id=" . $row['id'] . "'><img id='Img' src='../Frontend/Images/" . htmlspecialchars($row['img']) . "'></td></tr>";
                echo "<tr><td>" . htmlspecialchars($row['description']) . "</td></tr>";
                echo "<tr><td><a href='Delete/post.php?id=" . $row['id'] . "'><img src='../Frontend/Images/delete.png' style='cursor: pointer; width: 50px'></a></td>";
                echo "<td><a href='../Frontend/Images/" . $img . "' download><img src='../Frontend/Images/download.png' style='cursor: pointer; width: 30px'></a></td></tr>";
                echo "</table>";
            }
        } else {
            echo "<p>No results found for '$searchQuery'</p>";
        }
        echo "</table>";
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($Connection);
    }
}

mysqli_close($Connection);
?>

<script type='text/javascript' src='../Frontend/JS/Search.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>