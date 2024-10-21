<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'jk';
$username = 'root';
$password = '';

// Attempt to establish a connection to the database
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
    die(); // Terminate script execution
}

// Fetch data from the resident table
$sql = "SELECT COUNT(*) AS total FROM resident_archive";
$result = $db->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
$total_records = $row['total'];

$records_per_page = 100; // Number of records to display per page
$total_pages = ceil($total_records / $records_per_page); // Calculate total pages

$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number, default to 1 if not set

// Validate current page value
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Calculate the starting record for the current page
$start_from = ($current_page - 1) * $records_per_page;

// Fetch data from the resident table with pagination
$sql = "SELECT * FROM resident_archive";
$residentsQuery = $db->query($sql);
?>
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
        body {
    font-family: Arial, sans-serif;
   /* Dark background color */
    margin: 0;
    padding: 0;
}

.container {
    max-width: 960px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f2f2f2; /* Darker container background color */
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            margin-top: 0;
        }
        .main {
    background-color: transparent;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}
.pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
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
            <li class=""><a href="barangay.php" onclick="redirectTo('barangay.php')"><i class='bx bxs-compass'></i>Barangays</a></li>
            <li class=""><a href="maps.php" onclick="redirectTo('maps.php')"><i class='bx bx-map-alt'></i>Maps</a></li>
            <li class=""><a href="users.php" onclick="redirectTo('users.php')"><i class='bx bx-group'></i>Users</a></li>
            <li class="active"><a href="archv.php" onclick="redirectTo('archive.php')"><i class='bx bx-cog'></i>Archive</a></li>
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

        <!-- Main -->
        <main>
            <!-- Header -->
            <div class="header">
                <div class="left">
                    <h1>Archive</h1>
                    <ul class="breadcrumb">
                        <!-- Breadcrumb items -->
                    </ul>
                </div>
                <div class="archive-buttons">
            <button onclick="toggleTable('residents')">Residents</button>
            <button onclick="toggleTable('activities')">Activities</button>
        </div>
            </div>

            <!-- Residents Archive -->
            <div class="container" id="residentsTable">
                <h2>Residents Archive</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Voter</th>
                            <th>Birth Date</th>
                            <th>Deleted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Assuming $db is your database connection object
                        $residentsQuery = $db->query("SELECT * FROM resident_archive");
                        while ($row = $residentsQuery->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>" . $row['age'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . ($row['voter'] ? 'Yes' : 'No') . "</td>";
                            echo "<td>" . $row['birth_date'] . "</td>";
                            echo "<td>" . $row['deleted_at'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php
                    // Pagination links
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='?page=$i'";
                        if ($i == $current_page) echo " class='active'";
                        echo ">$i</a>";
                    }
                    ?>
                </div>
            </div>
            </div>

            <!-- Activities Archive -->
            <div class="container" id="activitiesTable" style="display: none;">
    <h2>Activities Archive</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Activity Name</th>
                <th>Barangay</th>
                <th>Date</th>
                <th>Picture</th>
                <th>Description</th>
                <th>Deleted At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch data for activities archive table with pagination
            $activities_per_page = 100; // Number of activities to display per page
            $activities_current_page = isset($_GET['act_page']) ? $_GET['act_page'] : 1; // Get the current page number, default to 1 if not set

            // Calculate the starting record for the current page
            $activities_start_from = ($activities_current_page - 1) * $activities_per_page;

            $activities_query = "SELECT * FROM activities_archive LIMIT $activities_start_from, $activities_per_page";
            $activities_result = $db->query($activities_query);
            while ($row = $activities_result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['actname'] . "</td>";
                echo "<td>" . $row['barangay'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['picture'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['deleted_at'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>    
                    </tbody>
                </table>
                <div class="pagination">
                    <?php
                    // Pagination links
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='?page=$i'";
                        if ($i == $current_page) echo " class='active'";
                        echo ">$i</a>";
                    }
                    ?>
                </div>
            </div>

       
    </div>
    <script>
    function toggleTable(tableId) {
        var residentsTable = document.getElementById('residentsTable');
        var activitiesTable = document.getElementById('activitiesTable');
        
        // Toggle visibility based on tableId
        if (tableId === 'residents') {
            residentsTable.style.display = 'block';
            activitiesTable.style.display = 'none';
        } else if (tableId === 'activities') {
            residentsTable.style.display = 'none';
            activitiesTable.style.display = 'block';
        }
    }
</script>

    <script src="index.js"></script>
    
</body>

</html>
