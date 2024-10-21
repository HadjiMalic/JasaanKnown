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
    .container {
        width: 80%;
        margin: 0 auto;
    }
    .population-division {
        background-color: #f0f0f0;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
    }
    .population-icon {
        font-size: 40px; /* Adjust size as needed */
        width: 50px;
        height: 70px; /* Adjust height as needed */
        margin-bottom: 15px;
    }
    .population-number {
        font-size: 16px;
        color: #333;
        margin-top: 5px;
    }

    /* Table for sub-divisions */
    .sub-table {
        width: 100%;
        border-collapse: collapse;
    }
    .sub-table th, .sub-table td {
        padding: 15px;
        border: 2px solid #ccc;
        text-align: center;
    }
    .sub-table th {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    .sub-table td {
        background-color: #fff;
    }
    .sub-table td:hover {
        background-color: #f9f9f9;
        border-radius: 10px;
        cursor: pointer;
    }
    .sub-table .sub-division-label {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }
    .sub-table .sample-count {
        font-size: 14px;
        color: #555;
    }
</style>
</head>

<body>
    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
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
                    <div class="container">
    <!-- Initial display of sample population -->
    <div class="population-division">
        <i class="fas fa-users population-icon"></i>
        <div class="population-number">Sample Population: 10,000</div>
    </div>

    <!-- Table for sub-divisions -->
    <table class="sub-table">
        <thead>
            <tr>
                <th>Population</th>
                <th>Sample Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="sub-division" data-division="Male">
                    <div class="sub-division-label">Male</div>
                    <!-- Icon for Male division -->
                    <i class="fas fa-male"></i>
                </td>
                <td class="sample-count">5000</td>
            </tr>
            <tr>
                <td class="sub-division" data-division="Female">
                    <div class="sub-division-label">Female</div>
                    <!-- Icon for Female division -->
                    <i class="fas fa-female"></i>
                </td>
                <td class="sample-count">5000</td>
            </tr>
            <tr>
                <td class="sub-division" data-division="Student">
                    <div class="sub-division-label">Student</div>
                    <!-- Icon for Student division -->
                    <i class="fas fa-graduation-cap"></i>
                </td>
                <td class="sample-count">3000</td>
            </tr>
            <tr>
                <td class="sub-division" data-division="Unemployed">
                    <div class="sub-division-label">Unemployed</div>
                    <!-- Icon for Unemployed division -->
                    <i class="fas fa-user-slash"></i>
                </td>
                <td class="sample-count">1000</td>
            </tr>
            <tr>
                <td class="sub-division" data-division="Employed">
                    <div class="sub-division-label">Employed</div>
                    <!-- Icon for Employed division -->
                    <i class="fas fa-user-tie"></i>
                </td>
                <td class="sample-count">7000</td>
            </tr>
            <tr>
                <td class="sub-division" data-division="Children">
                    <div class="sub-division-label">Children</div>
                    <!-- Icon for Children division -->
                    <i class="fas fa-child"></i>
                </td>
                <td class="sample-count">2000</td>
            </tr>
            <tr>
                <td class="sub-division" data-division="Seniors">
                    <div class="sub-division-label">Seniors</div>
                    <!-- Icon for Seniors division -->
                    <i class="fas fa-user-clock"></i>
                </td>
                <td class="sample-count">1500</td>
            </tr>
            <tr>
                <td class="sub-division" data-division="Household">
                    <div class="sub-division-label">Household</div>
                    <!-- Icon for Household division -->
                    <i class="fas fa-home"></i>
                </td>
                <td class="sample-count">4000</td>
            </tr>
        </tbody>
    </table>
</div>
                </div>
            </div>
        </main>
    </div>
    </script>
      <script src="index.js"></script>
</body>

</html>

