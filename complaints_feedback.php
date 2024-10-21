<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'jk');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle complaint submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_complaint'])) {
    $title = $_POST['title'];
    $complaint = $_POST['complaint'];
    $type = $_POST['type'];
    $date = date('Y-m-d');  // Current date
    $barangay = $_POST['barangay'];
    $complainant= $_POST['complainant'] ?? null;
    $contactnum = $_POST['contactnum'];
    $file = '';
   

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
        $targetDir = "uploaded_files/";
        $targetFile = $targetDir . basename($_FILES["file"]["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow only specific file types
        $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                $file = $targetFile;
            } else {
                echo "Error uploading file.";
                exit();
            }
        } else {
            echo "Only JPG, JPEG, PNG, PDF, DOC, and DOCX files are allowed.";
            exit();
        }
    }

    // Insert the complaint into the database
    $stmt = $conn->prepare("INSERT INTO complaints (title, complaint, type, date, barangay, complainant, contactnum, file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssss', $title, $complaint, $type, $date, $barangay, $complainant, $contactnum, $file);

    if ($stmt->execute()) {
        // Redirect to avoid form resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error submitting complaint: " . $stmt->error;
    }
}

// Fetch existing complaints
$sql = "SELECT title, complaint, type, barangay, complainant, contactnum, status, date, file FROM complaints";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store data in an array
    $complaints = [];
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }
} else {
    $complaints = []; // No results
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
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
        .complaint-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .complaint-card h5 {
            margin-bottom: 10px;
            font-size: 1.25rem;
        }

        .complaint-card p {
            margin-bottom: 10px;
        }

        .badge {
            font-size: 0.9rem;
            margin-right: 5px;
        }

        .badge-status {
            font-size: 0.85rem;
            padding: 5px 10px;
        }

        .date-badge {
            background-color: #17a2b8;
            color: #fff;
        }

        .barangay-badge {
            background-color: #28a745;
            color: #fff;
        }

        .status-badge {
            background-color: #ffc107;
            color: #fff;
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
                <h2>Complaints</h2>
                <h6>Do you have concerns? Submit your concenrns here below!</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitComplaintModal" style="font-size: 0.875rem; padding: 8px 16px; margin: 20px 0;">
    Submit a Complaint
</button>

                <?php if (!empty($complaints)): ?>
                    <?php foreach ($complaints as $complaint): ?>
                        <div class="complaint-card">
                            <h5><?php echo htmlspecialchars($complaint['title']); ?></h5>
                            <p><?php echo htmlspecialchars($complaint['complaint']); ?></p>
                            <div>
                                <span class="badge badge-primary">Public</span>
                                <span class="badge badge-status date-badge"><?php echo htmlspecialchars($complaint['date']); ?></span>
                                <span class="badge badge-status barangay-badge"><?php echo htmlspecialchars($complaint['barangay']); ?></span>
                                <?php if (!empty($complaint['status'])): ?>
                                    <span class="badge badge-status status-badge"><?php echo htmlspecialchars($complaint['status']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No complaints found.</p>
                <?php endif; ?>
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

    <div class="modal fade" id="submitComplaintModal" tabindex="-1" aria-labelledby="submitComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitComplaintModalLabel">Submit a Complaint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="complaintTitle">Title</label>
                        <input type="text" class="form-control" id="complaintTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="complaintText">Complaint</label>
                        <textarea class="form-control" id="complaintText" name="complaint" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="complaintType">Type</label>
                        <select class="form-control" id="complaintType" name="type" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="complaintBarangay">Barangay</label>
                        <input type="text" class="form-control" id="complaintBarangay" name="barangay" required>
                    </div>

                    <div class="form-group">
    <label for="complainant">Complainant Name (Optional)</label>
    <input type="text" class="form-control" id="complainant" name="complainant">
</div>
<div class="form-group">
    <label for="contactnum">Contact Number</label>
    <input type="text" class="form-control" id="contactnum" name="contactnum" required>
</div>

                    <div class="form-group">
                        <label for="complaintFile">Upload File</label>
                        <input type="file" class="form-control-file" id="complaintFile" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit_complaint">Submit Complaint</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="index.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
