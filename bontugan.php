<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>JASAANKNOWN</title>

    <style>
        /* Styles for buttons */
        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }

        .button-container button {
            padding: 5px 10px;
            font-size: 14px;
            background-color:#f6f6f9;
            color:#fbc02d;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100px; /* Fixed width for all buttons */
            text-align: center; /* Center text */
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        .content-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: center; /* Center the table horizontally */
            height: 700px; 
       
        }

        .content-table td {
            padding: 20px;
            border: 1px solid #ddd;
            text-align: left;
        }

    </style>
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
            <li class=""><a href="#" onclick="redirectTo('users.php')"><i class='bx bx-group'></i>Users</a></li>
            <li class=""><a href="#" onclick="redirectTo('settings.php')"><i class='bx bx-cog'></i>Archive</a></li>
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

        <!-- Buttons below the navigation bar -->
        <div class="button-container">
            <button onclick="showPopulation()">Population</button>
            <button onclick="showHistory()">History</button>
            <button onclick="showOfficials()">Officials</button>
            <button onclick="showMap()">Map</button>
            <button onclick="showMap()">Events</button>
        </div>

        <div>
            <table class="content-table">
                <tr>
                    <td>This is the content area. You can put your content here.</td>
                </tr>
            </table>
        </div>

    </div>

    <!-- JavaScript for button actions -->
    <script>
               function showPopulation() {
    // Redirect to popLJ.php
    window.location.href = 'popB.php';
        function showHistory() {
            // Add your code here to show history-related content
        }

        function showOfficials() {
            // Add your code here to show officials-related content
        }

        function showMap() {
            // Add your code here to show map-related content
        }
    }
    </script>
      <script src="index.js"></script>
</body>

</html>
