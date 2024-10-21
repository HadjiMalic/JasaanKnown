<?php
// Include database configuration
include 'config.php';
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_complaint'])) {
    $title = $_POST['title'];
    $complaint = $_POST['complaint'];
    $type = $_POST['type'];
    $date = date('Y-m-d');  // Current date
    $barangay = $_POST['barangay'];
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
    $stmt = $conn->prepare("INSERT INTO complaints (title, complaint, type, date, barangay, file) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $title, $complaint, $type, $date, $barangay, $file);

    if ($stmt->execute()) {
        // Redirect to avoid form resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error submitting complaint: " . $stmt->error;
    }
}

// Fetch existing complaints
$complaints = $conn->query("SELECT * FROM complaints ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            margin-bottom: 1rem;
        }
        .card-title {
            font-size: 1rem;
        }
        .card-text {
            font-size: 0.875rem;
        }
        .badge {
            font-size: 0.75rem;
        }
        .form-container {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
        <!-- Complaint List -->
        <div class="col-md-8">
            <div class="row">
                <?php while ($row = $complaints->fetch_assoc()) { ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['complaint']); ?></p>
                                <span class="badge badge-info"><?php echo htmlspecialchars($row['type']); ?></span>
                                <span class="badge badge-secondary"><?php echo htmlspecialchars($row['date']); ?></span>
                                <span class="badge badge-success"><?php echo htmlspecialchars($row['barangay']); ?></span>
                                <span class="badge badge-warning"><?php echo htmlspecialchars($row['status']); ?></span>

                               
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?php echo $row['id']; ?>" style="background-color: #007bff; border-radius: 8px; color: white; width: 60px; height: 20px; font-size: 10px;">
    <i class="fas fa-eye"></i> View
</button>

                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Viewing Complaint Details -->
                    <div class="modal fade" id="viewModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel<?php echo $row['id']; ?>">Complaint Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Title:</strong> <?php echo htmlspecialchars($row['title']); ?></p>
                                    <p><strong>Complaint:</strong> <?php echo htmlspecialchars($row['complaint']); ?></p>
                                    <p><strong>Type:</strong> <?php echo htmlspecialchars($row['type']); ?></p>
                                    <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
                                    <p><strong>Barangay:</strong> <?php echo htmlspecialchars($row['barangay']); ?></p>
                                    <p><strong>Complainant:</strong> <?php echo htmlspecialchars($row['complainant']); ?></p>
                                    <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($row['contactnum']); ?></p>
                                    <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                                    <?php if ($row['file']) { ?>
                                        <p><strong>File:</strong> <a href="<?php echo $row['file']; ?>" target="_blank">View File</a></p>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="">Respond</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
