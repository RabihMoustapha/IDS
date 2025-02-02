<link href='../Frontend/CSS/Home.css' type='text/css' rel='stylesheet'>
<div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='../Frontend/home.php' style='height: 38px;'>
                <img src='../Frontend/Images/home.png' style='background: white; border-radius: 5px;height: 40px; width: 40px'>
            </a>
        </li>
    </ul>
</div>
<?php
include 'connection.php';

if (isset($_POST['searchQuery'])) {
    $searchQuery = mysqli_real_escape_string($Connection, $_POST['searchQuery']);

    $query = "SELECT * FROM post WHERE title LIKE ? OR description LIKE ?";
    $stmt = mysqli_prepare($Connection, $query);

    if ($stmt) {
        //Arduino syntax that mean contain
        $searchTerm = "%" . $searchQuery . "%";

        //ss for searchTerm type(string)
        mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $nbr = mysqli_num_rows($result);
        if ($nbr > 0) {
            echo "<table class='data-block' cellspacing='25'>
                    <tr>
                        <th>Title</th>
                        <th>Img</th>
                        <th>Description</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td><img id='Img' src='../Frontend/Images/" . htmlspecialchars($row['img']) . "'></td>
                        <td>" . htmlspecialchars($row['description']) . "</td>
                        <td><a href='Delete/post.php?id=" . $row['id'] . "'><img src='../Frontend/Images/delete.png' style='cursor: pointer'></a></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found for '$searchQuery'</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($Connection);
    }
}

mysqli_close($Connection);
?>