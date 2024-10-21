<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizational Chart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
        }

        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .org-node {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin: 10px;
            text-align: center;
            max-width: 200px;
        }

        .org-node img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .org-details h2, .org-details h3 {
            margin: 5px 0;
        }

        .org-details p {
            margin: 0;
        }

        .org-subchart {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="org-chart">
        <div class="org-node" id="managing-director"></div>
        <div class="org-subchart" id="directors"></div>
        <div class="org-subchart" id="managers"></div>
    </div>

    <script>
        const officials = <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "jk";
        
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT name, barangay, position, age, contactnum, yearofterm, image FROM officials";
            $result = $conn->query($sql);
            $officials = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $officials[] = $row;
                }
            }

            $conn->close();

            echo json_encode($officials);
        ?>;

        // Sort officials by position
        officials.sort((a, b) => {
            const positions = ["Kapitan", "kagawad"];
            const posA = positions.indexOf(a.position);
            const posB = positions.indexOf(b.position);

            if (posA === -1 && posB === -1) {
                return 0;
            } else if (posA === -1) {
                return 1;
            } else if (posB === -1) {
                return -1;
            } else {
                return posA - posB;
            }
        });

        const managingDirectorContainer = document.getElementById('managing-director');
        const directorsContainer = document.getElementById('directors');
        const managersContainer = document.getElementById('managers');

        officials.forEach((official) => {
            const orgNode = document.createElement('div');
            orgNode.classList.add('org-node');

            orgNode.innerHTML = `
                <img src="${official.image}" alt="${official.name}">
                <div class="org-details">
                    <h3>Position: ${official.position}</h3>
                    <h4>Name: ${official.name}</h4>
                    <p>Barangay: ${official.barangay}</p>
                    <p>Contact Number: ${official.contactnum}</p>
                    <p>Year of Term: ${official.yearofterm}</p>
                </div>
            `;

            if (official.position === "Kapitan") {
                orgNode.querySelector('.org-details h3').innerHTML = `<h2>${official.position}</h2>`;
                managingDirectorContainer.appendChild(orgNode);
            } else if (official.position === "kagawad") {
                directorsContainer.appendChild(orgNode);
            } else {
                managersContainer.appendChild(orgNode);
            }
        });
    </script>
</body>
</html>
