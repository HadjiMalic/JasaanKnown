<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/jasaanknown.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: azure;
        }

        .sidebar {
            background-color: gainsboro;
            padding: 20px;
        }

        .sidebar .profile img {
            width: 100px;
            border-radius: 50%;
        }

        .sidebar .profile p {
            margin: 10px 0;
        }

        .nav-link {
            color: #000;
        }

        .nav-link.active {
            font-weight: bold;
        }

        .content {
            padding: 20px;
        }

        .post {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }

        .post img {
            width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
        }

        .post-images {
            text-align: center;
        }

        .post-images img {
            max-width: calc(100% - 20px);
            height: auto;
            margin: 10px;
            border-radius: 8px;
            max-height: 400px;
        }

        .sidebar2 {
            width: 300px;
            padding: 20px;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
        }

        .sidebar2 h2, .sidebar2 h3 {
            color: #2a2a2a;
        }

        .sidebar2 h2 {
            font-size: 1.5em;
            margin-bottom: 0.5em;
        }

        .sidebar2 h3 {
            font-size: 1.25em;
            margin-bottom: 1em;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1em;
            padding: 10px;
            background-color: #e9ecef;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .feature-item:hover {
            background-color: gainsboro;
        }

        .icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .sidebar .logo {
            font-size: 24px;
            font-weight: 700;
            height: 56px;
            display: flex;
            align-items: center;
            color: var(--danger);
            z-index: 500;
            padding-bottom: 20px;
            box-sizing: content-box;
        }

        .sidebar .logo .logo-name {
            margin-left: 10px;
        }

        .sidebar .logo .logo-name span {
            color: var(--warning);
        }

        .sidebar .logo .bx {
            min-width: 60px;
            display: flex;
            justify-content: center;
            font-size: 2.2rem;
        }

        /* Comments Section Styling */
        .comments-container {
            margin-top: 20px;
        }

        .comment {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .comment img.profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-text {
            background-color: #f1f1f1;
            border-radius: 18px;
            padding: 10px 15px;
            max-width: 100%;
            word-wrap: break-word;
        }

        /* Comment Form Styling */
        .comment-form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        .comment-form textarea {
            resize: none;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 4px;
            width: 100%;
            margin-bottom: 10px;
            font-family: Arial, sans-serif;
        }

        .comment-form button {
            align-self: flex-end;
            background-color: #1da1f2;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 10px;
        }

        .comment-form button:hover {
            background-color: #0d8cd7;
        }

    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <a href="#" class="logo">
                    <div class="logo-name"><span>Jasaan</span>Known</div>
                </a>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore Jasaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Municipality of Jasaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Lower Jasaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Upper Jasaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kimaya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jampason</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bobontugan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Solana</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 content">
                <?php
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'jk');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, actname, barangay, date, picture, description FROM activities";
                $result = $conn->query($sql);
        
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="activity">';
                        echo '<img src="' . $row["picture"] . '" alt="Activity Image">';
                        echo '<div class="activity-details">';
                        echo '<h2>' . $row["actname"] . '</h2>';
                        echo '<p class="activity-barangayname">' . $row["barangay"] . '</p>';
                        echo '<p class="activity-description">' . $row["description"] . '</p>';
                        echo '<p class="activity-date">' . $row["date"] . '</p>';
                        echo '</div>';
                        // Add comments container
                        echo '<div class="comments-container">';
                        // Fetch and display comments for each activity
                        $activity_id = $row["id"]; // Assuming 'id' is the column name for the activity ID
                        $comments_sql = "SELECT * FROM comments WHERE activity_id = $activity_id";
                        $comments_result = $conn->query($comments_sql);
                        if ($comments_result->num_rows > 0) {
                            while ($comment_row = $comments_result->fetch_assoc()) {
                                echo '<div class="comment">';
                                echo '<img class="profile-pic" src="images/default.png" alt="Profile Picture">';
                                echo '<div class="comment-text">' . $comment_row["comment"] . '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "No comments yet.";
                        }
                        echo '</div>';
                        // Comment form
                        echo '<form class="comment-form" method="post" action="submit_comment.php">';
                        echo '<input type="hidden" name="activity_id" value="' . $activity_id . '">';
                        echo '<textarea name="comment" placeholder="Add your comment" rows="2"></textarea>';
                        echo '<button type="submit">Submit</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>

            <div class="col-md-3 col-lg-3 sidebar2">
    <h2>Check Informations by Category</h2>
    <a href="resident_population.php" class="feature-item resident-management">
        <i class="icon fas fa-users"></i>
        <span class="text">Resident Population</span>
    </a>
    <a href="household_information.php" class="feature-item household-information">
        <i class="icon fas fa-home"></i>
        <span class="text">Household Information</span>
    </a>
    <a href="record_keeping.php" class="feature-item record-keeping">
        <i class="icon fas fa-file-alt"></i>
        <span class="text">Record Keeping</span>
    </a>
    <a href="complaints_feedback.php" class="feature-item complaints-feedback">
        <i class="icon fas fa-comments"></i>
        <span class="text">Complaints and Feedback</span>
    </a>
    <a href="disaster_preparedness.php" class="feature-item disaster-preparedness">
        <i class="icon fas fa-building"></i>
        <span class="text">Establishments</span>
    </a>
    <a href="events_activities.php" class="feature-item security-access">
        <i class="icon fas fa-handshake"></i>
        <span class="text">Events and Activities</span>
    </a>
</div>

        </div>
    </div>
    <script src="index.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
