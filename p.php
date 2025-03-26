<!-- This page is For User Profile View  --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile Overview</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .profile-container {
            margin-top: 15px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 70px;
            width: 100%;
            max-width: 960px;
            margin-bottom: 30px;
            position: relative;
        }

        /* Hero Section */
        .hero-section {
            display: flex;
            align-items: center;
            padding-bottom: 30px;
            border-bottom: 1px solid #eee;
            margin-bottom: 30px;
        }

        .profile-picture-hero {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
            border: 3px solid #e0e0e0;
            position: relative; /* For positioning the change picture button */
        }

        .profile-picture-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .change-picture-button {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 0.8em;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }

        .profile-picture-hero:hover .change-picture-button {
            opacity: 1;
        }

        .change-picture-button input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .profile-info-hero {
            flex-grow: 1;
        }

        .profile-name-hero {
            font-size: 2em;
            color: #333;
            margin-bottom: 5px;
        }

        .profile-details-hero p {
            color: #555;
            margin-bottom: 5px;
            font-size: 0.9em;
        }

        .edit-profile-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
            margin-left: auto;
        }

        .edit-profile-button:hover {
            background-color: #0056b3;
        }

        /* Data Count Boxes */
        .data-counts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .data-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 20px;
            text-align: center;
        }

        .data-card h3 {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 8px;
        }

        .data-card .count {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
        }

        /* Leaderboard Row */
        .leaderboard-section {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .leaderboard-title {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 10px;
        }

        .leaderboard-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 6px;
            font-size: 0.9em;
            color: #666;
        }

        .leaderboard-row strong {
            font-weight: bold;
            color: #333;
        }

        /* Activity Tracker */
        .activity-section {
            margin-bottom: 30px;
        }

        .activity-title {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 10px;
        }

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(31, 20px); /* 31 boxes for days */
            gap: 3px;
            margin-top: 10px;
        }

        .activity-day {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            background-color: #eee;
            cursor: default;
        }

        .activity-day.active {
            background-color: #28a745;
        }

        /* Edit Profile Modal (Fullscreen) */
        .edit-profile-modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: #f4f6f8; /* Light background for the full screen */
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            align-items: center;
            justify-content: center;
        }

        .edit-profile-modal.open {
            display: flex;
            opacity: 1;
        }

        .edit-modal-content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 90%;
            max-width: 600px; /* Adjust max width as needed */
            position: relative;
            transform: translateY(-20px); /* Slight initial offset */
            transition: transform 0.3s ease-out;
        }

        .edit-profile-modal.open .edit-modal-content {
            transform: translateY(0);
        }

        .edit-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .edit-modal-title {
            color: #2d3748;
            font-size: 1.8em;
        }

        .close-button {
            background: none;
            border: none;
            color: #718096;
            font-size: 1.5em;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .close-button:hover {
            color: #4a5568;
        }

        .edit-profile-form .form-group {
            margin-bottom: 20px;
        }

        .edit-profile-form label {
            display: block;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .edit-profile-form input[type="text"],
        .edit-profile-form input[type="email"],
        .edit-profile-form input[type="date"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 1em;
            box-sizing: border-box;
        }

        .edit-profile-form .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .edit-profile-form .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .edit-profile-form .form-actions .save-button {
            background-color: #28a745;
            color: white;
        }

        .edit-profile-form .form-actions .save-button:hover {
            background-color: #1e7e34;
        }

        .edit-profile-form .form-actions .cancel-button {
            background-color: #dc3545;
            color: white;
        }

        .edit-profile-form .form-actions .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body> 
    <div class="profile-container">
        <section class="hero-section">
            <div class="profile-picture-hero">
                <img src="https://via.placeholder.com/100" alt="Your Profile Picture" id="hero-profile-picture">
                <button class="change-picture-button" title="Change Profile Picture">
                    <i class="fas fa-camera"></i>
                    <input type="file" accept="image/*" onchange="previewProfilePicture(this)">
                </button>
                
            </div>
            <div class="profile-info-hero">
            <a href="dashboard.php?valofmenu=dashboard" class="btn btn-sm btn-outline-primary"><i class="fas fa-arrow-left me-1"></i> Back to Recruitment</a>

                <h2 class="profile-name-hero" id="hero-name">John Doe</h2>
                <div class="profile-details-hero">
                    <p><i class="fas fa-envelope"></i> <span id="hero-email">john.doe@example.com</span></p>
                    <p><i class="fas fa-calendar-alt"></i> Joined: <span id="hero-joining-date">2024-01-15</span></p>
                    <p><i class="fas fa-id-card"></i> User ID: <span id="hero-user-id">12345</span></p>
                </div>
            </div>
            <button class="edit-profile-button" onclick="openEditProfileModal()">
                <i class="fas fa-user-edit"></i> Edit Profile
            </button>
        </section>

        <section class="data-counts-section">
            <div class="data-card">
                <h3>Total Submissions</h3>
                <p class="count">150</p>
            </div>
            <div class="data-card">
                <h3>Events Participated</h3>
                <p class="count">12</p>
            </div>
            <div class="data-card">
                <h3>Points Earned</h3>
                <p class="count">2850</p>
            </div>
        </section>

        <section class="leaderboard-section">
            <h2 class="leaderboard-title"><i class="fas fa-trophy"></i> Recent Submissions</h2>
            <div class="leaderboard-row">
                <strong>Submission ID</strong>
                <strong>Date</strong>
                <strong>Event ID</strong>
                <strong>Status</strong>
            </div>
            <div class="leaderboard-row">
                <span>SUB001</span>
                <span>2025-03-25</span>
                <span>EVENT01</span>
                <span>Accepted</span>
            </div>
            <div class="leaderboard-row">
                <span>SUB002</span>
                <span>2025-03-24</span>
                <span>EVENT02</span>
                <span>Pending</span>
            </div>
            <div class="leaderboard-row">
                <span>SUB003</span>
                <span>2025-03-23</span>
                <span>EVENT01</span>
                <span>Rejected</span>
            </div>
        </section>

        <section class="activity-section">
            <h2 class="activity-title"><i class="fas fa-chart-bar"></i> Submission Activity (March 2025)</h2>
            <div class="activity-grid" id="activityGrid">
                </div>
        </section>
        

        <div id="editProfileModal" class="edit-profile-modal">
            <div class="edit-modal-content">
                <div class="edit-modal-header">
                    <h2 class="edit-modal-title"><i class="fas fa-user-edit"></i> Edit Profile</h2>
                    <button type="button" class="close-button" onclick="closeEditProfileModal()">&times;</button>
                </div>
                <form id="editProfileForm" class="edit-profile-form">
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" id="edit-name" value="John Doe">
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" id="edit-email" value="john.doe@example.com">
                    </div>
                    <div class="form-group">
                        <label for="edit-joining-date">Joining Date</label>
                        <input type="date" id="edit-joining-date" value="2024-01-15">
                    </div>
                    <div class="form-group">
                        <label for="edit-user-id">User ID</label>
                        <input type="text" id="edit-user-id" value="12345" readonly>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="save-button" onclick="saveProfileChanges()">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="button" class="cancel-button" onclick="closeEditProfileModal()">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sample data for active submission days in March 2025 (YYYY-MM-DD format)
        const submissionDays = ['2025-03-01', '2025-03-05', '2025-03-10', '2025-03-15', '2025-03-16', '2025-03-20', '2025-03-25', '2025-03-26'];
        const profilePicturePreview = document.getElementById('hero-profile-picture');

        function previewProfilePicture(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePicturePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function renderActivityCalendar() {
            const activityGrid = document.getElementById('activityGrid');
            activityGrid.innerHTML = ''; // Clear previous content

            const year = 2025;
            const month = 2; // March is month index 2 (0-based)
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            for (let i = 1; i <= daysInMonth; i++) {
                const day = String(i).padStart(2, '0');
                const currentDate = `${year}-${String(month + 1).padStart(2, '0')}-${day}`;
                const dayElement = document.createElement('div');
                dayElement.classList.add('activity-day');
                dayElement.title = `March ${day}, ${year}`; // Example tooltip

                if (submissionDays.includes(currentDate)) {
                    dayElement.classList.add('active');
                    dayElement.title = `Submission on March ${day}, ${year}`;
                }

                activityGrid.appendChild(dayElement);
            }
        }

        function openEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.classList.add('open');
        }

        function closeEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.classList.remove('open');
        }

        function saveProfileChanges() {
            // In a real application, you would send this data to the server
            const newName = document.getElementById('edit-name').value;
            const newEmail = document.getElementById('edit-email').value;
            const newJoiningDate = document.getElementById('edit-joining-date').value;

            // Update the displayed information (for demonstration)
            document.getElementById('hero-name').textContent = newName;
            document.getElementById('hero-email').textContent = newEmail;
            document.getElementById('hero-joining-date').textContent = newJoiningDate;

            closeEditProfileModal();
            alert('Profile changes saved (demonstration only).');
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderActivityCalendar();

            // Optional: Add event listener to close modal when clicking outside
            const modal = document.getElementById('editProfileModal');
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeEditProfileModal();
                }
            });
        });

        renderActivityCalendar(); // Call on initial load as well
    </script>
</body>
</html>