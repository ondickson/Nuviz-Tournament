<?php
include('db_connection.php');



// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add new team
    if (isset($_POST['add_team'])) {
        $team_name = $_POST['team_name'];
        $logo_path = 'images/' . basename($_FILES["team_logo"]["name"]);

        if (move_uploaded_file($_FILES["team_logo"]["tmp_name"], $logo_path)) {
            $stmt = $conn->prepare("INSERT INTO teams (name, logo) VALUES (?, ?)");
            $stmt->bind_param("ss", $team_name, $logo_path);
            $stmt->execute();
            $stmt->close();
            echo "<div class='alert alert-success'>New team added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error uploading team logo.</div>";
        }
    }

    // Submit match results
    if (isset($_POST['add_match'])) {
        $team1_id = $_POST['team1_id'];
        $team2_id = $_POST['team2_id'];
        $team1_goals = $_POST['team1_goals'];
        $team2_goals = $_POST['team2_goals'];
        $match_date = $_POST['match_date'];

        $stmt = $conn->prepare("INSERT INTO matches (team1_id, team2_id, team1_goals, team2_goals, match_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiis", $team1_id, $team2_id, $team1_goals, $team2_goals, $match_date);
        $stmt->execute();
        $stmt->close();

        // Update team stats
        if ($team1_goals > $team2_goals) {
            // Team 1 wins
            $conn->query("UPDATE teams SET wins = wins + 1, goals_for = goals_for + $team1_goals, goals_against = goals_against + $team2_goals, points = points + 2 WHERE id = $team1_id");
            $conn->query("UPDATE teams SET losses = losses + 1, goals_for = goals_for + $team2_goals, goals_against = goals_against + $team1_goals WHERE id = $team2_id");
        } elseif ($team1_goals < $team2_goals) {
            // Team 2 wins
            $conn->query("UPDATE teams SET wins = wins + 1, goals_for = goals_for + $team2_goals, goals_against = goals_against + $team1_goals, points = points + 2 WHERE id = $team2_id");
            $conn->query("UPDATE teams SET losses = losses + 1, goals_for = goals_for + $team1_goals, goals_against = goals_against + $team2_goals WHERE id = $team1_id");
        } else {
            // Draw
            $conn->query("UPDATE teams SET draws = draws + 1, goals_for = goals_for + $team1_goals, goals_against = goals_against + $team2_goals, points = points + 1 WHERE id = $team1_id");
            $conn->query("UPDATE teams SET draws = draws + 1, goals_for = goals_for + $team2_goals, goals_against = goals_against + $team1_goals, points = points + 1 WHERE id = $team2_id");
        }

        echo "<div class='alert alert-success'>Match result added successfully!</div>";
    }

    // Edit team details
    if (isset($_POST['edit_team'])) {
        $team_id = $_POST['team_id'];
        $new_name = $_POST['new_name'];
        $new_logo_path = 'images/' . basename($_FILES["new_logo"]["name"]);

        if (move_uploaded_file($_FILES["new_logo"]["tmp_name"], $new_logo_path)) {
            $stmt = $conn->prepare("UPDATE teams SET name = ?, logo = ? WHERE id = ?");
            $stmt->bind_param("ssi", $new_name, $new_logo_path, $team_id);
            $stmt->execute();
            $stmt->close();
            echo "<div class='alert alert-success'>Team details updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error uploading new logo.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Nuviz Weekend Tournament</title>
    <link rel="icon" type="image/png" href="./images/logo.jpg">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .nav-sidebar {
            position: sticky;
            top: 0;
            height: 100%;
            overflow: auto;
            padding: 15px;
        }
        .nav-sidebar a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }
        .nav-sidebar a:hover {
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 nav-sidebar bg-light">
            <h4>Admin Menu</h4>
            <a href="#add-team">Add New Team</a>
            <a href="#submit-match">Submit Match Result</a>
            <a href="#edit-team">Edit Team Details</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="container">
                <h1 class="text-center my-4">Admin Page</h1>

                <!-- Form to add a new team -->
                <div id="add-team">
                    <h2>Add New Team</h2>
                    <form action="admin.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="team_name" class="form-label">Team Name</label>
                            <input type="text" class="form-control" id="team_name" name="team_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="team_logo" class="form-label">Team Logo</label>
                            <input type="file" class="form-control" id="team_logo" name="team_logo" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_team">Add Team</button>
                    </form>
                </div>

                <!-- Form to submit match results -->
                <div id="submit-match" class="mt-5">
                    <h2>Submit Match Result</h2>
                    <form action="admin.php" method="POST">
                        <div class="mb-3">
                            <label for="team1_id" class="form-label">Team 1</label>
                            <select class="form-control" id="team1_id" name="team1_id" required>
                                <?php
                                $teams = $conn->query("SELECT * FROM teams");
                                while ($team = $teams->fetch_assoc()) {
                                    echo "<option value='{$team['id']}'>{$team['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="team2_id" class="form-label">Team 2</label>
                            <select class="form-control" id="team2_id" name="team2_id" required>
                                <?php
                                $teams = $conn->query("SELECT * FROM teams");
                                while ($team = $teams->fetch_assoc()) {
                                    echo "<option value='{$team['id']}'>{$team['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="team1_goals" class="form-label">Team 1 Goals</label>
                            <input type="number" class="form-control" id="team1_goals" name="team1_goals" required>
                        </div>
                        <div class="mb-3">
                            <label for="team2_goals" class="form-label">Team 2 Goals</label>
                            <input type="number" class="form-control" id="team2_goals" name="team2_goals" required>
                        </div>
                        <div class="mb-3">
                            <label for="match_date" class="form-label">Match Date</label>
                            <input type="date" class="form-control" id="match_date" name="match_date" required>
                        </div>
                        <button type="submit" class="btn btn-success" name="add_match">Submit Match</button>
                    </form>
                </div>

                <!-- Form to edit team details -->
                <div id="edit-team" class="mt-5">
                    <h2>Edit Team Details</h2>
                    <form action="admin.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Select Team</label>
                            <select class="form-control" id="team_id" name="team_id" required>
                                <?php
                                $teams = $conn->query("SELECT * FROM teams");
                                while ($team = $teams->fetch_assoc()) {
                                    echo "<option value='{$team['id']}'>{$team['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="new_name" class="form-label">New Team Name</label>
                            <input type="text" class="form-control" id="new_name" name="new_name">
                        </div>
                        <div class="mb-3">
                            <label for="new_logo" class="form-label">New Team Logo</label>
                            <input type="file" class="form-control" id="new_logo" name="new_logo">
                        </div>
                        <button type="submit" class="btn btn-warning" name="edit_team">Update Team</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
