<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/vocab/asset/CSS/adminProfile.css">
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
<script src="/vocab/asset/JS/adminProfile.js"></script>
</body>
</html>