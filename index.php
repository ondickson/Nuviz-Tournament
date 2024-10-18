<?php
include('db_connection.php');

// Query to get team stats including matches played
$query = "
    SELECT 
        t.id, t.name, t.logo, 
        COALESCE(SUM(CASE WHEN m.team1_id = t.id THEN 1 ELSE 0 END) + SUM(CASE WHEN m.team2_id = t.id THEN 1 ELSE 0 END), 0) AS matches_played,
        COALESCE(SUM(CASE WHEN m.team1_id = t.id AND m.team1_goals > m.team2_goals THEN 1 ELSE 0 END) +
                SUM(CASE WHEN m.team2_id = t.id AND m.team2_goals > m.team1_goals THEN 1 ELSE 0 END), 0) AS wins,
        COALESCE(SUM(CASE WHEN m.team1_id = t.id AND m.team1_goals = m.team2_goals THEN 1 ELSE 0 END) +
                SUM(CASE WHEN m.team2_id = t.id AND m.team2_goals = m.team1_goals THEN 1 ELSE 0 END), 0) AS draws,
        COALESCE(SUM(CASE WHEN m.team1_id = t.id AND m.team1_goals < m.team2_goals THEN 1 ELSE 0 END) +
                SUM(CASE WHEN m.team2_id = t.id AND m.team2_goals < m.team1_goals THEN 1 ELSE 0 END), 0) AS losses,
        COALESCE(SUM(CASE WHEN m.team1_id = t.id THEN m.team1_goals ELSE 0 END) + 
                SUM(CASE WHEN m.team2_id = t.id THEN m.team2_goals ELSE 0 END), 0) AS goals_for,
        COALESCE(SUM(CASE WHEN m.team1_id = t.id THEN m.team2_goals ELSE 0 END) + 
                SUM(CASE WHEN m.team2_id = t.id THEN m.team1_goals ELSE 0 END), 0) AS goals_against,
        COALESCE(SUM(CASE WHEN m.team1_id = t.id AND m.team1_goals > m.team2_goals THEN 2 ELSE 0 END) +
                SUM(CASE WHEN m.team2_id = t.id AND m.team2_goals > m.team1_goals THEN 2 ELSE 0 END) +
                SUM(CASE WHEN m.team1_goals = m.team2_goals THEN 1 ELSE 0 END), 0) AS points
    FROM teams t
    LEFT JOIN matches m ON t.id = m.team1_id OR t.id = m.team2_id
    GROUP BY t.id, t.name, t.logo
    ORDER BY points DESC, goals_for DESC
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Nuviz Weekend Tournament</title>
    <link rel="icon" type="image/png" href="./images/logo.jpg">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .team-img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }
        .team-name {
            display: flex;
            align-items: center;
        }
        table {
            margin-top: 20px;
            width: 100%;
            overflow-x: auto; /* Make the table scrollable on small screens */
        }
        th {
            background-color: #004d00; /* Dark green for header */
            color: #fff;
            text-align: center;
        }
        tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }
        tbody tr:hover {
            background-color: #d4edda; /* Light green for hover */
        }
        a {
            color: #343a40;
            /*text-decoration: none;*/
            font-weight: 600;
        }
        a:hover {
            color: orange;
        }
        .team-img {
            border-radius: 50%;
            margin-right: 1em;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            th, td {
                font-size: 14px;
            }
            .team-img {
                width: 40px; /* Adjust image size for mobile */
            }
        }

        /* Responsive Table */
        @media (max-width: 576px) {
            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <h1 class="text-center my-4">NUVIZ WEEKEND TOURNAMENT</h1>
            <p>Click on the team name to view their stats*</p>
            
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Team</th>
                        <th>MP</th> <!-- Matches Played -->
                        <th>W</th>
                        <th>D</th>
                        <th>L</th>
                        <th><b>Pts</b></th>
                        <th>GF</th>
                        <th>GA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <div class="team-name">
                                <img src="<?php echo htmlspecialchars($row['logo']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?> Logo" class="team-img">
                                <a href="team.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></a>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($row['matches_played']); ?></td>
                        <td><?php echo htmlspecialchars($row['wins']); ?></td>
                        <td><?php echo htmlspecialchars($row['draws']); ?></td>
                        <td><?php echo htmlspecialchars($row['losses']); ?></td>
                        <td><b><?php echo htmlspecialchars($row['points']); ?></b></td>
                        <td><?php echo htmlspecialchars($row['goals_for']); ?></td>
                        <td><?php echo htmlspecialchars($row['goals_against']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="meanings my-4">
            <h4>Full Meaning of shorten words</h4>
            <p>MP - Matches Played</p>
            <p>W - Wins</p>
            <p>D - Draws</p>
            <p>L - Lose</p>
            <p>Pts - Points</p>
            <p>GF - Goals For</p>
            <p>GA - Goals Against</p>
        </div>
        <div class="meanings my-4">
            <h4>Tournament Rules</h4>
            <p>Wins - 2 Points</p>
            <p>Draws - 1 Point</p>
            <p>Lose - 0 Points</p>
        </div>
    </div>

    
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

