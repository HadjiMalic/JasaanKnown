<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all attractions
$sql = "SELECT * FROM Attractions";
$attractionsResult = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attractions</title>
    <style>
        .image-container {
            position: relative;
            max-width: 100%;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 5px;
        }
        .image-grid img {
            width: 100%;
            height: auto;
            cursor: pointer;
        }
        .view-more {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            margin-top: 10px;
            color: #007bff;
            cursor: pointer;
        }
        .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.);
    justify-content: center;
    align-items: center;
}

.modal-content {
    position: relative;
    max-width: 50%;
    max-height: 40%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
}
        .close, .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }
        .close {
            top: 15px;
            right: 35px;
        }
        .prev {
            left: 15px;
        }
        .next {
            right: 15px;
        }
        .close:hover, .prev:hover, .next:hover {
            color: #bbb;
        }
    </style>
</head>
<body>
    <h1>Attractions</h1>

    <?php
    if ($attractionsResult->num_rows > 0) {
        while ($attraction = $attractionsResult->fetch_assoc()) {
            echo '<h2>' . htmlspecialchars($attraction['Name']) . '</h2>';
            echo '<p><strong>Location:</strong> ' . htmlspecialchars($attraction['Location']) . '</p>';
            echo '<p><strong>Type:</strong> ' . htmlspecialchars($attraction['Type']) . '</p>';
            echo '<p><strong>Description:</strong> ' . htmlspecialchars($attraction['Description']) . '</p>';

            // Fetch images for this attraction
            $attractionID = $attraction['ID'];
            $stmt = $conn->prepare("SELECT PictureURL FROM Pictures WHERE AttractionID = ?");
            $stmt->bind_param("i", $attractionID);
            $stmt->execute();
            $picturesResult = $stmt->get_result();

            echo '<div class="image-container">';
            $imageUrls = [];
            if ($picturesResult->num_rows > 0) {
                while ($row = $picturesResult->fetch_assoc()) {
                    $imageUrls[] = $row['PictureURL'];
                }
            }

            $maxVisibleImages = 3;
            $totalImages = count($imageUrls);
            $remainingImages = $totalImages - $maxVisibleImages;

            echo '<div class="image-grid">';
            for ($i = 0; $i < $totalImages; $i++) {
                if ($i < $maxVisibleImages) {
                    echo '<img src="' . htmlspecialchars($imageUrls[$i]) . '" alt="Attraction Image" onclick="openModal(' . $i . ')">';
                } else if ($i == $maxVisibleImages) {
                    echo '<div class="view-more" onclick="showAllImages()">View More (' . $remainingImages . ')</div>';
                    break;
                }
            }
            echo '</div></div><hr>';
        }
    } else {
        echo "No attractions found.";
    }

    $conn->close();
    ?>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <span class="prev" onclick="changeImage(-1)">&#10094;</span>
        <span class="next" onclick="changeImage(1)">&#10095;</span>
        <div class="modal-content">
            <img id="modalImg" src="" alt="Modal Image">
        </div>
    </div>

    <script>
        var images = [];
        var currentImageIndex = 0;

        function openModal(index) {
            images = Array.from(document.querySelectorAll('.image-grid img')).map(img => img.src);
            currentImageIndex = index;
            updateModalImage();
            document.getElementById('myModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        function changeImage(direction) {
            currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
            updateModalImage();
        }

        function updateModalImage() {
            document.getElementById('modalImg').src = images[currentImageIndex];
        }

        // Close the modal when clicking outside of the image
        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
