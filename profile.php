<!-- Profile Page -->
<div class="profile-container">
    <div class="profile-header">
        <!-- Profile Picture -->
        <div class="profile-picture">
            <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" id="profile-img">
        </div>

        <!-- Profile Information -->
        <div class="profile-info">
            <h2><?php echo $user['name']; ?></h2>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Score: <?php echo $user['score']; ?></p>
            <p>Rank: <?php echo $user['rank']; ?></p>

            <!-- Edit Button -->
            <button class="btn-edit-profile" onclick="toggleEditForm()">Edit</button>
        </div>
    </div>

    <!-- Edit Form (Initially Hidden) -->
    <div id="edit-form" class="edit-form" style="display: none;">
        <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="edit-form-content">
            <!-- Profile Picture Upload (Hidden) -->
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture" class="file-input" accept="image/*">
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="score">Score:</label>
                <input type="text" id="score" name="score" value="<?php echo $user['score']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="rank">Rank:</label>
                <input type="text" id="rank" name="rank" value="<?php echo $user['rank']; ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save Changes</button>
                <button type="button" class="btn-cancel" onclick="toggleEditForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Key Stats Section Outside Profile Container -->
<div class="key-stats-container">
    <div class="key-stat-box box-red">
        <div class="avatar">
            <i class="fa fa-medal"></i>
        </div>
        <h3>Total Points</h3>
        <p><?php echo $user['total_points']; ?></p>
    </div>
    <div class="key-stat-box box-white">
        <div class="avatar">
            <i class="fa fa-calendar-check"></i>
        </div>
        <h3>Total Events</h3>
        <p><?php echo $user['total_events']; ?></p>
    </div>
    <div class="key-stat-box box-red">
        <div class="avatar">
            <i class="fa fa-book-reader"></i>
        </div>
        <h3>Total Exams</h3>
        <p><?php echo $user['total_exams']; ?></p>
    </div>
    <div class="key-stat-box box-white">
        <div class="avatar">
            <i class="fa fa-crown"></i>
        </div>
        <h3>Leaderboard Position</h3>
        <p><?php echo $user['leaderboard_position']; ?></p>
    </div>
</div>

<!-- CSS Styling -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .profile-container {
    max-width: 900px;
    margin: 50px auto;
    background-color: #ffffff;
    border-radius: 15px;
    border: 3px solid #e74c3c; /* Added red border */
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    padding: 30px;
    }

    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profile-picture {
        position: relative;
        text-align: center;
    }

    .profile-picture img {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 5px solid #fff;
        object-fit: cover;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .file-input {
        display: none;
    }

    .btn-edit-profile {
        background-color: #ff4d4d;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-edit-profile:hover {
        background-color: #ff1a1a;
    }

    .edit-form {
        margin-top: 40px;
        padding: 25px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f8f8f8;
    }

    .edit-form .form-group {
        margin-bottom: 20px;
    }

    .edit-form .form-group label {
        display: block;
        font-weight: bold;
        color: #333;
    }

    .edit-form .form-group input {
        width: 100%;
        padding: 12px;
        margin-top: 6px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
    }

    .btn-save, .btn-cancel {
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-save {
        background-color: #3498db;
        color: white;
    }

    .btn-cancel {
        background-color: #ccc;
        color: #333;
    }

    .btn-save:hover {
        background-color: #2980b9;
    }

    .btn-cancel:hover {
        background-color: #b0b0b0;
    }

    /* Key Stats Section */
    .key-stats-container {
        display: flex;
        justify-content: space-between;
        margin: 50px auto;
        max-width: 1000px;
        padding: 0 20px;
        gap: 30px;
    }

    .key-stat-box {
        width: 23%;
        padding: 25px;
        border-radius: 12px;
        color: white;
        text-align: center;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .key-stat-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
    }

    .key-stat-box h3 {
        font-size: 20px;
        margin-bottom: 12px;
        font-weight: bold;
    }

    .key-stat-box p {
        font-size: 28px;
        font-weight: 600;
    }

    /* Avatar Icons inside Key Stats */
    .avatar {
        font-size: 40px;
        margin-bottom: 15px;
    }

    .avatar i {
        color: white;
    }

    /* Colors for Key Stats Boxes */
    .box-red {
        background-color: #e74c3c;
    }

    .box-white {
        background-color: #ffffff;
        color: #333;
    }

    .profile-info{
        margin-right: 72%;
    }
</style>

<!-- JavaScript -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    function toggleEditForm() {
        var editForm = document.getElementById('edit-form');
        var inputs = document.querySelectorAll('.edit-form input');
        editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';

        if (editForm.style.display === 'block') {
            inputs.forEach(input => input.disabled = false);
        } else {
            inputs.forEach(input => input.disabled = true);
        }
    }
</script>
