<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 90%;
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
            position: relative;
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

        .admin-badge {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            margin-left: 10px;
            vertical-align: middle;
        }

        .profile-actions {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

        .edit-profile-button, .change-password-button, .admin-settings-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }

        .edit-profile-button:hover, .change-password-button:hover, .admin-settings-button:hover {
            background-color: #0056b3;
        }

        .change-password-button {
            background-color: #6c757d;
        }

        .change-password-button:hover {
            background-color: #5a6268;
        }

        .admin-settings-button {
            background-color: #dc3545;
        }

        .admin-settings-button:hover {
            background-color: #c82333;
        }

        /* Admin Stats Section */
        .admin-stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stats-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 20px;
            text-align: center;
        }

        .stats-card h3 {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 8px;
        }

        .stats-card .count {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
        }

        .stats-card:nth-child(1) .count {
            color: #28a745; /* Green */
        }

        .stats-card:nth-child(2) .count {
            color: #ffc107; /* Yellow */
        }

        .stats-card:nth-child(3) .count {
            color: #dc3545; /* Red */
        }

        .stats-card:nth-child(4) .count {
            color: #6f42c1; /* Purple */
        }

        /* Recent Activity Section */
        .recent-activity-section {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .section-title {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 15px;
        }

        .activity-table {
            width: 100%;
            border-collapse: collapse;
        }

        .activity-table th, .activity-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .activity-table th {
            background-color: #f9f9f9;
            color: #333;
            font-weight: 600;
        }

        .activity-table tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .view-button, .edit-button, .delete-button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8em;
            transition: background-color 0.2s ease;
        }

        .view-button {
            background-color: #17a2b8;
            color: white;
        }

        .view-button:hover {
            background-color: #138496;
        }

        .edit-button {
            background-color: #ffc107;
            color: #212529;
        }

        .edit-button:hover {
            background-color: #e0a800;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        /* Admin Access Section */
        .admin-access-section {
            margin-bottom: 30px;
        }

        .permissions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .permission-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .permission-name {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .permission-desc {
            font-size: 0.85em;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .permission-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #28a745;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }

        /* Modal Base Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            align-items: center;
            justify-content: center;
        }

        .modal.open {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 90%;
            max-width: 600px;
            position: relative;
            transform: translateY(-20px);
            transition: transform 0.3s ease-out;
        }

        .modal.open .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
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

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="date"],
        .form-group input[type="password"],
        .form-group select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 1em;
            box-sizing: border-box;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .form-actions .save-button {
            background-color: #28a745;
            color: white;
        }

        .form-actions .save-button:hover {
            background-color: #1e7e34;
        }

        .form-actions .cancel-button {
            background-color: #dc3545;
            color: white;
        }

        .form-actions .cancel-button:hover {
            background-color: #c82333;
        }

        /* Admin Settings Modal Specific Styles */
        .tab-navigation {
            display: flex;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            font-size: 1em;
            color: #4a5568;
            transition: all 0.3s ease;
        }

        .tab-button.active {
            color: #007bff;
            border-bottom-color: #007bff;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .two-column-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Password strength indicator styles */
        .password-strength {
            height: 5px;
            background-color: #e9ecef;
            margin-top: 5px;
            border-radius: 3px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            background-color: #dc3545;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .password-strength-text {
            font-size: 0.8em;
            margin-top: 5px;
            color: #6c757d;
        }

        .password-requirements {
            font-size: 0.8em;
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border-left: 3px solid #6c757d;
        }

        .password-requirements ul {
            padding-left: 20px;
            margin: 5px 0 0;
        }

        @media (max-width: 768px) {
            .two-column-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <section class="hero-section">
            <div class="profile-picture-hero">
                <img src="https://via.placeholder.com/100" alt="Admin Profile Picture" id="hero-profile-picture">
                <button class="change-picture-button" title="Change Profile Picture">
                    <i class="fas fa-camera"></i>
                    <input type="file" accept="image/*" onchange="previewProfilePicture(this)">
                </button>
            </div>
            <div class="profile-info-hero">
                <a href="admin-dashboard.php" class="btn btn-sm btn-outline-primary"><i class="fas fa-arrow-left me-1"></i> Back to Dashboard</a>

                <h2 class="profile-name-hero" id="hero-name">Admin User <span class="admin-badge">Administrator</span></h2>
                <div class="profile-details-hero">
                    <p><i class="fas fa-envelope"></i> <span id="hero-email">admin@example.com</span></p>
                    <p><i class="fas fa-calendar-alt"></i> Access Level: <span id="hero-access-level">Full Access</span></p>
                    <p><i class="fas fa-clock"></i> Last Login: <span id="hero-last-login">2025-04-02 09:15 AM</span></p>
                </div>
            </div>
            <div class="profile-actions">
                <button class="edit-profile-button" onclick="openEditProfileModal()">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </button>
                <button class="change-password-button" onclick="openChangePasswordModal()">
                    <i class="fas fa-key"></i> Change Password
                </button>
            </div>
        </section>

        <section class="admin-stats-section">
            <div class="stats-card">
                <h3>Total Users</h3>
                <p class="count">1,245</p>
            </div>
            <div class="stats-card">
                <h3>Pending Requests</h3>
                <p class="count">28</p>
            </div>
            <div class="stats-card">
                <h3>Flagged Content</h3>
                <p class="count">7</p>
            </div>
            <div class="stats-card">
                <h3>Admin Actions</h3>
                <p class="count">152</p>
            </div>
        </section>

        <section class="recent-activity-section">
            <h2 class="section-title"><i class="fas fa-history"></i> Recent Admin Activities</h2>
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>Activity ID</th>
                        <th>Date & Time</th>
                        <th>Action</th>
                        <th>Related User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ACT001</td>
                        <td>2025-04-03 14:22</td>
                        <td>User Approved</td>
                        <td>jane.smith@example.com</td>
                        <td class="action-buttons">
                            <button class="view-button"><i class="fas fa-eye"></i></button>
                            <button class="delete-button"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>ACT002</td>
                        <td>2025-04-03 11:45</td>
                        <td>Content Removed</td>
                        <td>robert.jones@example.com</td>
                        <td class="action-buttons">
                            <button class="view-button"><i class="fas fa-eye"></i></button>
                            <button class="delete-button"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>ACT003</td>
                        <td>2025-04-02 16:30</td>
                        <td>User Banned</td>
                        <td>spammer123@example.com</td>
                        <td class="action-buttons">
                            <button class="view-button"><i class="fas fa-eye"></i></button>
                            <button class="delete-button"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>ACT004</td>
                        <td>2025-04-02 10:15</td>
                        <td>Event Published</td>
                        <td>System</td>
                        <td class="action-buttons">
                            <button class="view-button"><i class="fas fa-eye"></i></button>
                            <button class="delete-button"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Edit Profile Modal (Added) -->
        <div id="editProfileModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-user-edit"></i> Edit Admin Profile</h2>
                    <button type="button" class="close-button" onclick="closeModal('editProfileModal')">&times;</button>
                </div>
                <form id="editProfileForm" action="#">
                    <div class="form-group">
                        <label for="edit-name">Full Name</label>
                        <input type="text" id="edit-name" value="Admin User" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email Address</label>
                        <input type="email" id="edit-email" value="admin@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-joining-date">Joining Date</label>
                        <input type="date" id="edit-joining-date" value="2024-01-15">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="save-button" onclick="saveProfileChanges()">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="button" class="cancel-button" onclick="closeModal('editProfileModal')">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Modal -->
        <div id="changePasswordModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-key"></i> Change Admin Password</h2>
                    <button type="button" class="close-button" onclick="closeModal('changePasswordModal')">&times;</button>
                </div>
                <form id="changePasswordForm" action="#">
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" required onkeyup="checkPasswordStrength()">
                        <div class="password-strength">
                            <div class="password-strength-bar" id="passwordStrengthBar"></div>
                        </div>
                        <div class="password-strength-text" id="passwordStrengthText">Password strength: Not entered</div>
                        <div class="password-requirements">
                            <p>Password must contain:</p>
                            <ul>
                                <li>At least 12 characters (admin requires stronger passwords)</li>
                                <li>At least one uppercase letter</li>
                                <li>At least one lowercase letter</li>
                                <li>At least one number</li>
                                <li>At least one special character (@, $, !, %, *, ?, &)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" required onkeyup="checkPasswordsMatch()">
                        <div id="password-match-message" style="font-size: 0.8em; margin-top: 5px;"></div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="save-button" id="change-password-button" onclick="changePassword()" disabled>
                            <i class="fas fa-save"></i> Update Password
                        </button>
                        <button type="button" class="cancel-button" onclick="closeModal('changePasswordModal')">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // General modal functions
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('open');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('open');
        }

        function openEditProfileModal() {
            openModal('editProfileModal');
            // Pre-fill form with current data
            document.getElementById('edit-name').value = document.getElementById('hero-name').textContent.replace('Administrator', '').trim();
            document.getElementById('edit-email').value = document.getElementById('hero-email').textContent;
        }

        function openChangePasswordModal() {
            openModal('changePasswordModal');
            // Reset the form
            document.getElementById('changePasswordForm').reset();
            document.getElementById('passwordStrengthBar').style.width = '0%';
            document.getElementById('passwordStrengthText').textContent = 'Password strength: Not entered';
            document.getElementById('password-match-message').textContent = '';
            document.getElementById('change-password-button').disabled = true;
        }

        function saveProfileChanges() {
            // In a real application, you would send this data to the server
            const newName = document.getElementById('edit-name').value;
            const newEmail = document.getElementById('edit-email').value;
            const newJoiningDate = document.getElementById('edit-joining-date').value;

            // Update the displayed information (for demonstration)
            document.getElementById('hero-name').textContent = newName + ' ';
            const adminBadge = document.createElement('span');
            adminBadge.className = 'admin-badge';
            adminBadge.textContent = 'Administrator';
            document.getElementById('hero-name').appendChild(adminBadge);
            
            document.getElementById('hero-email').textContent = newEmail;

            closeModal('editProfileModal');
            alert('Profile changes saved (demonstration only).');
        }

        // Profile picture preview function
        function previewProfilePicture(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('hero-profile-picture').src = e.target.result;
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Password strength checker
        function checkPasswordStrength() {
            const password = document.getElementById('new-password').value;
            let strength = 0;
            let strengthText = '';
            
            if (password.length === 0) {
                strength = 0;
                strengthText = 'Not entered';
            } else if (password.length < 8) {
                strength = 1;
                strengthText = 'Very weak';
            } else {
                // Add points for complexity
                if (password.length >= 8) strength += 1;
                if (password.match(/[A-Z]/)) strength += 1;
                if (password.match(/[a-z]/)) strength += 1; 
                if (password.match(/[0-9]/)) strength += 1;
                if (password.match(/[^A-Za-z0-9]/)) strength += 1;
                
                // Determine text based on strength score
                if (strength <= 2) strengthText = 'Weak';
                else if (strength <= 3) strengthText = 'Medium';
                else if (strength <= 4) strengthText = 'Strong';
                else strengthText = 'Very strong';
            }
            
            // Update the UI
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthPercentage = (strength / 5) * 100;
            strengthBar.style.width = `${strengthPercentage}%`;
            
            // Set color based on strength
            if (strength <= 1) strengthBar.style.backgroundColor = '#dc3545'; // Red
            else if (strength <= 3) strengthBar.style.backgroundColor = '#ffc107'; // Yellow
            else strengthBar.style.backgroundColor = '#28a745'; // Green
            
            document.getElementById('passwordStrengthText').textContent = `Password strength: ${strengthText}`;
            
            // Check if passwords match and update button state
            checkPasswordsMatch();
        }
        
        function checkPasswordsMatch() {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const matchMessage = document.getElementById('password-match-message');
            const updateButton = document.getElementById('change-password-button');
            
            if (confirmPassword.length === 0) {
                matchMessage.textContent = '';
                updateButton.disabled = true;
                return;
            }
            
            if (newPassword === confirmPassword) {
                matchMessage.textContent = 'Passwords match';
                matchMessage.style.color = '#28a745';
                updateButton.disabled = false;
            } else {
                matchMessage.textContent = 'Passwords do not match';
                matchMessage.style.color = '#dc3545';
                updateButton.disabled = true;
            }
        }
        
        function changePassword() {
            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            
            // In a real application, you would send this data to the server for validation
            // and password update
            
            // For demonstration purposes
            closeModal('changePasswordModal');
            alert('Password successfully changed (demonstration only).');
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Add event listeners to close modals when clicking outside
            window.addEventListener('click', (event) => {
                const editModal = document.getElementById('editProfileModal');
                const passwordModal = document.getElementById('changePasswordModal');
                
                if (event.target === editModal) {
                    closeModal('editProfileModal');
                }
                
                if (event.target === passwordModal) {
                    closeModal('changePasswordModal');
                }
            });
        });
    </script>
</body>
</html>