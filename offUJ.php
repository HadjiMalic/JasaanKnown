<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Profiles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .official-card {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .official-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .official-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .official-details {
            flex: 1;
        }

        .official-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .official-position {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .official-year,
        .official-age,
        .official-department {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="official-card" style="background-color: #f9c2ff;">
    <div class="official-picture">
        <img src="images/shaiwo.jpg" alt="Official Picture">
    </div>
    <div class="official-details">
        <div class="official-name">John Doe</div>
        <div class="official-position">Mayor</div>
        <div class="official-year">Year of Term: 2022 - 2026</div>
        <div class="official-age">Age: 45</div>
        <div class="official-department">Department: Administration</div>
    </div>
</div>

<div class="official-card" style="background-color: #ffcccc;">
    <div class="official-picture">
        <img src="images/lovely.jpg" alt="Official Picture">
    </div>
    <div class="official-details">
        <div class="official-name">Jane Smith</div>
        <div class="official-position">Councilor</div>
        <div class="official-year">Year of Term: 2022 - 2026</div>
        <div class="official-age">Age: 40</div>
        <div class="official-department">Department: Finance</div>
    </div>
</div>

</body>
</html>
