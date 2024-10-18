<?php
include('db_connection.php');

// Get team ID from URL
$team_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch team details from the database
$stmt = $conn->prepare("SELECT * FROM teams WHERE id = ?");
$stmt->bind_param("i", $team_id);
$stmt->execute();
$team = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch the team's match history
$matches = $conn->prepare("SELECT m.*, t1.name as team1_name, t2.name as team2_name 
                           FROM matches m 
                           JOIN teams t1 ON m.team1_id = t1.id 
                           JOIN teams t2 ON m.team2_id = t2.id 
                           WHERE m.team1_id = ? OR m.team2_id = ?");
$matches->bind_param("ii", $team_id, $team_id);
$matches->execute();
$match_results = $matches->get_result();
$matches->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($team['name']); ?> - Team Stats</title>
    <link rel="icon" type="image/png" href="./images/logo.jpg">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        .win-icon {
            color: green;
        }
        .draw-icon {
            color: grey;
        }
        .lose-icon {
            color: red;
        }

        .img-fluid{
            border-radius: 50%;
        }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>

    <div class="container">
        <h1 class="text-center my-4"><?php echo htmlspecialchars($team['name']); ?></h1>
        <div class="text-center">
            <img src="<?php echo htmlspecialchars($team['logo']); ?>" alt="<?php echo htmlspecialchars($team['name']); ?> Logo" class="img-fluid mb-4" style="max-width: 200px;">
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <h3>Wins: <?php echo htmlspecialchars($team['wins']); ?></h3>
            </div>
            <div class="col-md-4">
                <h3>Draws: <?php echo htmlspecialchars($team['draws']); ?></h3>
            </div>
            <div class="col-md-4">
                <h3>Losses: <?php echo htmlspecialchars($team['losses']); ?></h3>
            </div>
            <div class="col-md-4">
                <h3>Goals For: <?php echo htmlspecialchars($team['goals_for']); ?></h3>
            </div>
            <div class="col-md-4">
                <h3>Goals Against: <?php echo htmlspecialchars($team['goals_against']); ?></h3>
            </div>
            <div class="col-md-4">
                <h3>Points: <?php echo htmlspecialchars($team['points']); ?></h3>
            </div>
        </div>

        <h2 class="my-4">Match History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Opponent</th>
                    <th>Score</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($match = $match_results->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo date("d M Y", strtotime($match['match_date'])); ?></td>
                        <td><?php echo $match['team1_id'] == $team_id ? htmlspecialchars($match['team2_name']) : htmlspecialchars($match['team1_name']); ?></td>
                        <td><?php echo htmlspecialchars($match['team1_goals']); ?> - <?php echo htmlspecialchars($match['team2_goals']); ?></td>
                        <td>
                            <?php
                            $result = '';
                            if ($match['team1_goals'] > $match['team2_goals']) {
                                $result = ($match['team1_id'] == $team_id) ? 'win' : 'lose';
                            } elseif ($match['team1_goals'] < $match['team2_goals']) {
                                $result = ($match['team2_id'] == $team_id) ? 'win' : 'lose';
                            } else {
                                $result = 'draw';
                            }
                            ?>
                            <i class="fa <?php echo ($result == 'win') ? 'fa-check win-icon' : (($result == 'draw') ? 'fa-minus draw-icon' : 'fa-times lose-icon'); ?>"></i>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
