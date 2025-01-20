<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateAccount</title>
    <link type="text/css" href="CSS/CreateAccount.css" rel="stylesheet">
    <script type="text/javascript" src="JS/Account/Create.js"></script>
    <link rel="icon" type="image/x-icon" href="Images/api.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="Images/api.png">
</head>

<body>
    <!--Header-->
    <form action="javascript:void(0)" method="post">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="logout.php"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="addpost.php">Add</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="deletepost.php">Post</a></li>
                                    <li><a class="dropdown-item" href="deletehistory.php">History</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="deleteothers">Others</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search" method="post" onsubmit="getItem(event)">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchQuery" oninput="getItem(event)">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
    </form>

    <!-- Output for search results -->
    <div id="output"></div>

    <!--createaccount form-->
    <form class="form-floating" action="javascript:void(0)" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" placeholder="Paul">
            <label for="username">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="usermail" placeholder="email@example.com">
            <label for="usermail">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
            <button class="btn btn-outline-success" onclick="createaccount()">Create</button>
        </div>
    </form>
    <!--Footer-->
    <footer class="footer">
        <div class="footer-container">
            <p>WebApi. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="tel:+961818140764">Phone Number</a></li>
                <li><a href="mailto:mostapharabih59@gmail.com">Email</a></li>
                <li><a href="https://github.com/RabihMoustapha">GitHub</a></li>
            </ul>
        </div>
    </footer>
</body>

</html>