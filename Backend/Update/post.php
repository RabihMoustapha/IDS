<link type="text/css" href="../../Frontend/CSS/Home.css" rel="stylesheet">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>
<link rel='icon' type='image/x-icon' href='../../Frontend/Images/api.png'>
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
                        <a class='nav-link active' aria-current='page' href='../../Frontend/Home.php' style='height: 38px;'>
                            <img src='../../Frontend/Images/home.png' style='width: 20px; height: 20px;'>
                        </a>
                    </li>
                </ul>
                <form class='d-flex' role='search' action='../search.php' method='post' style='flex-grow: 1; margin-right: 10px;'>
                    <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' name='searchQuery' id='searchQuery'>
                    <button class='btn btn-outline-success' style='height: 38px;' type='submit'><img src='../../Frontend/Images/search.png' style='height: 20px; width: 20px'></button>
                </form>
                <button class='btn btn-outline-danger' type='button' onclick='logout()' style='height: 38px;'><img src='../../Frontend/Images/logout.png' style='width: 20px; height: 20px;'></button>
            </div>
        </div>
    </nav>
</header>
<body>
<form action="update.php" method="post">
    <div class='form-floating mb-3'>
        <input autocomplete='id' type='id' class='form-control' id='id' name='id' placeholder='id@example.com' required>
        <label for='id'>PID</label>
    </div>
    <div class='form-floating mb-3'>
        <input autocomplete='email' type='email' class='form-control' id='email' name='email' placeholder='email@example.com' required>
        <label for='email'>Email address</label>
    </div>
    <div class='form-floating mb-3'>
        <input autocomplete='title' type='text' class='form-control' id='title' name='title' placeholder='title' required>
        <label for='title'>Title</label>
    </div>
    <div class='form-floating mb-3'>
        <input autocomplete='description' type='text' class='form-control' id='description' name='description' placeholder='description' required>
        <label for='description'>Description</label>
    </div>
    <button class='btn btn-outline-success' type='submit'>Update</button>
</form>
</body>