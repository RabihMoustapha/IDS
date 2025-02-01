<style>
    * {
        font-family: monospace;
        font-weight: bold;
    }

    body {
        background-size: cover;
        background-position: center;
        background: url("../Images/Background.jpeg");
        color: white;
    }

    .data-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .data-block {
        width: 250px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
        transition: transform 0.3s ease-in-out;
    }

    .data-block:hover {
        transform: scale(1.05);
    }

    .data-block img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .data-block h3 {
        margin-top: 15px;
        font-size: 18px;
        font-weight: bold;
    }

    .data-block p {
        margin: 5px 0;
        color: #555;
    }
</style>

<?php
include 'connection.php';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchQuery'];
    $query = "SELECT * FROM post WHERE description LIKE $searchTerm";
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
        echo "<td><img id='Img' src='../Frontend/Images/$row[img]'></td>";
        echo "<td>$row[description]</td>";
        echo "<td><a href='Delete/post.php?id=$row[id]'><img src='../Frontend/Images/delete.png' style='cursor: pointer'></a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
    ?>