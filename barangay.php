<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>JASAANKNOWN</title>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>Jasaan</span>Known</div>
        </a>
        <ul class="side-menu">
            <li class=""><a href="dashboard.php" onclick="redirectTo('dashboard.php')"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="active"><a href="barangay.php" onclick="redirectTo('barangay.php')"><i class='bx bxs-compass'></i>Barangays</a></li>
            <li class=""><a href="maps.php" onclick="redirectTo('maps.php')"><i class='bx bx-map-alt'></i>Maps</a></li>
            <li class=""><a href="users.php" onclick="redirectTo('users.php')"><i class='bx bx-group'></i>Users</a></li>
            <li class=""><a href="archv.php" onclick="redirectTo('archv.php')"><i class='bx bx-cog'></i>Archive</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count"></span>
            </a>
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Barangays</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                
                            </a></li>
                    </ul>
                </div>
              
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                <i>
        <img src="images/uj.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="__.php">
                        <p>Upper Jasaan</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/lj.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="lowerJ.php">
                        <p>Lower Jasaan</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/bontugan.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="bontugan.php">
                        <p>Bobontugan</p>
                    </a>
                    </span>
                </li>
                <li>
                <i>
        <img src="images/jampason.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="jampason.php">
                        <p>Jampason</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/sa.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="sanantonio.php">
                        <p>San Antonio</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/danao.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="danao.php">
                        <p>Danao</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/sn.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="sanicolas.php">
                        <p>San Nicolas</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/is.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="IScruz.php">
                        <p>I.S Cruz</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/natubo.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="natubo.php">
                        <p>Natubo</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/kimaya.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="kimaya.php">
                        <p>Kimaya</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/lb.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="luzbanzon.php">
                        <p>Luz Banzon</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/solana.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="solana.php">
                        <p>Solana</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/aplaya.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    <span class="info">
                    <a href="aplaya.php">
                        <p>Aplaya</p>
                    </a>
                    </span>
                </li>
                <li><i>
        <img src="images/si.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
                    <span class="info">
                    <a href="sanisidro.php">
                        <p>San Isidro</p>
                    </a>
                    </span>
                </li>
<li>
    <i>
        <img src="images/corrales.png" style="width: 80px; height: 80px;" alt="Lovely Image">
    </i>
    </i>
    <span class="info">
                    <a href="corales.php">
                        <p>Corrales</p>
                    </a>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->


        </main>

    </div>

    <script src="index.js"></script>
</body>

</html>