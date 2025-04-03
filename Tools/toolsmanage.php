<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere Tools - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --accent-color: #e74c3c;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #3498db;
            --border-radius: 4px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Admin Authentication Overlay */
        .admin-auth-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        .admin-login-form {
            background-color: white;
            padding: 2.5rem;
            border-radius: var(--border-radius);
            width: 100%;
            max-width: 400px;
            box-shadow: var(--box-shadow);
            text-align: center;
        }

        .admin-login-form h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .admin-form-group {
            margin-bottom: 1.25rem;
            text-align: left;
        }

        .admin-form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }

        .admin-form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .admin-form-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .admin-login-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 0.5rem;
        }

        .admin-login-btn:hover {
            background-color: #2980b9;
        }

        .admin-error-message {
            color: var(--danger-color);
            background-color: rgba(231, 76, 60, 0.1);
            padding: 0.75rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.25rem;
            display: none;
        }

        .admin-form-logo {
            margin-bottom: 1.5rem;
        }

        .admin-form-logo i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        /* Admin status indicator */
        .admin-status {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background-color: var(--success-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            font-size: 0.875rem;
            z-index: 100;
            display: none;
            box-shadow: var(--box-shadow);
        }

        .admin-logout {
            margin-left: 0.5rem;
            text-decoration: underline;
            cursor: pointer;
            font-weight: 500;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            transition: var(--transition);
        }

        .dashboard-blur {
            filter: blur(5px);
            pointer-events: none;
            user-select: none;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--dark-color);
            color: white;
            padding: 1.5rem 0;
            position: fixed;
            height: 100vh;
            transition: var(--transition);
            z-index: 100;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-header h2 {
            color: white;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }

        .sidebar-header h2 i {
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .sidebar-nav {
            padding: 0 1.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            border-radius: var(--border-radius);
            margin-bottom: 0.25rem;
        }

        .sidebar-link i {
            margin-right: 0.75rem;
            width: 1.25rem;
            text-align: center;
        }

        .sidebar-link:hover, .sidebar-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-link.active {
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
            transition: var(--transition);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-header h1 {
            color: var(--dark-color);
            font-size: 1.75rem;
        }

        .page-description {
            color: #666;
            margin-bottom: 2rem;
        }

        /* Cards */
        .card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            color: var(--dark-color);
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }

        .card-header h2 i {
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-description {
            color: #666;
            margin-bottom: 1rem;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: var(--transition);
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: var(--transition);
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--success-color);
        }

        input:focus + .slider {
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.3);
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #219653;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        /* Status Indicators */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.active {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--success-color);
        }

        .status-badge.inactive {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .status-badge i {
            margin-right: 0.25rem;
            font-size: 0.625rem;
        }

        /* Control Items */
        .control-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .control-item:last-child {
            border-bottom: none;
        }

        .control-label {
            display: flex;
            align-items: center;
        }

        .control-label i {
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .disabled-label {
            color: #999;
            font-size: 0.875rem;
            margin-left: 0.5rem;
            font-style: italic;
        }

        /* Color Picker */
        .color-picker {
            width: 50px;
            height: 30px;
            padding: 0;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            cursor: pointer;
        }

        /* Form Row */
        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem;
            }
            
            .card-header, .card-body {
                padding: 1rem;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 576px) {
            .admin-login-form {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-header h1 {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Admin Authentication Overlay -->
    <div class="admin-auth-overlay" id="adminAuthOverlay">
        <div class="admin-login-form">
            <div class="admin-form-logo">
                <i class="fas fa-lock"></i>
                <h2>Admin Authentication</h2>
            </div>
            <div class="admin-error-message" id="adminErrorMessage">
                <i class="fas fa-exclamation-circle"></i> Invalid credentials. Please try again.
            </div>
            <div class="form-group">
                <label for="adminUsername">Username</label>
                <input type="text" id="adminUsername" class="form-control" placeholder="admin">
            </div>
            <div class="form-group">
                <label for="adminPassword">Password</label>
                <input type="password" id="adminPassword" class="form-control" placeholder="admin2025">
            </div>
            <button class="btn btn-primary btn-block" id="adminLoginBtn">
                <i class="fas fa-sign-in-alt"></i> Authenticate
            </button>
        </div>
    </div>
    
    <!-- Admin Status Indicator -->
    <div class="admin-status" id="adminStatus">
        <i class="fas fa-user-shield"></i> Admin Mode 
        <span class="admin-logout" id="adminLogout">Logout</span>
    </div>

    <!-- Main Dashboard Content -->
    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cubes"></i> VocaSphere</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="sidebar-link active" data-section="page-control">
                    <i class="fas fa-file-alt"></i> Page Control
                </a>
                <a href="#" class="sidebar-link" data-section="announcement-control">
                    <i class="fas fa-bullhorn"></i> Announcement Control
                </a>
                <a href="#" class="sidebar-link" data-section="emergency-control">
                    <i class="fas fa-exclamation-triangle"></i> Emergency Control
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content" id="mainContent">
            <!-- Page Control Section -->
            <?php
// Database connection (replace with your actual credentials)
       include_once('../connection.php');

// Function to fetch the activation status for a given page function
function getPageStatus($conn, $pageFunction) {
    $stmt = $conn->prepare("SELECT val FROM pagecontrol WHERE pagefunction = ?");
    $stmt->bind_param("s", $pageFunction);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return (int)$row["val"]; // Cast to integer for comparison
    } else {
        return 0; // Default to off if not found
    }
    $stmt->close();
}

// Fetch the activation status for each page
$signupStatus = getPageStatus($conn, 'signupauth'); // Assuming 'signupauth' maps to Services
$loginStatus = getPageStatus($conn, 'loginauth'); // Assuming 'loginauth' maps to Contact Us
$contactusStatus = getPageStatus($conn, 'contactus');; // Pricing is disabled, so default to off

$conn->close();
?>

<section id="page-control-section" class="content-section">
    <div class="page-header">
        <h1>Page Control</h1>
    </div>

    <p class="page-description">
        Manage the activation status of your website pages.
    </p>

    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-toggle-on"></i> Page Activation</h2>
            <span class="status-badge <?php if ($signupStatus == 1 || $loginStatus == 1 || $contactusStatus == 1 ) echo 'active'; else echo 'inactive'; ?>">
                <i class="fas fa-circle"></i> <?php if ($signupStatus == 1 || $contactusStatus == 1 || $loginStatus == 1 ) echo 'Active'; else echo 'Inactive'; ?>
            </span>
        </div>
        <div class="card-body">
            <p class="card-description">
                Enable or disable pages for your website.
            </p>
            <form action="toolsDataHandler.php" method="post">
                <div class="control-item">
                    <div class="control-label">
                        <i class="fas fa-home"></i> Login
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="homepageToggle" name="loginToggle" <?php if ($loginStatus == 1) echo 'checked'; ?>>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="control-item">
                    <div class="control-label">
                        <i class="fas fa-info-circle"></i> Signup
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="aboutUsToggle" name="signupToggle" <?php if ($signupStatus == 1) echo 'checked'; ?>>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="control-item">
                    <div class="control-label">
                        <i class="fas fa-envelope"></i> Contact Us
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="contactUsToggle" name="contactUsToggle" <?php if ($contactusStatus == 1) echo 'checked'; ?>>
                        <span class="slider"></span>
                    </label>
                </div>
             <!--- If i need to control another Services i need to add here -->

                <div class="form-group" style="margin-top: 1.5rem;">
                    <button class="btn btn-success btn-block" id="savePageConfig" type="submit">
                        <i class="fas fa-save"></i> Save Page Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
            <!-- Announcement Control Section -->
            <section id="announcement-control-section" class="content-section" style="display: none;">
                <div class="page-header">
                    <h1>Announcement Control</h1>
                </div>
                
                <p class="page-description">
                    Manage the announcement bar settings for your website.
                </p>

                <!-- Announcement Bar Card -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-bullhorn"></i> Announcement Bar</h2>
                        <span class="status-badge inactive" id="announcementStatus">
                            <i class="fas fa-circle"></i> Inactive
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-description">
                            Control the display and content of the announcement bar.
                        </p>
                        
                        <div class="control-item">
                            <div class="control-label">
                                <i class="fas fa-power-off"></i> Enable Announcement Bar
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="announcementToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label for="announcementText">Announcement Text</label>
                            <input type="text" id="announcementText" class="form-control" 
                                   placeholder="Enter your announcement message">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="announcementColor">Background Color</label>
                                <input type="color" id="announcementColor" class="color-picker" value="#fceabb">
                            </div>
                            <div class="form-group">
                                <label for="announcementTextColor">Text Color</label>
                                <input type="color" id="announcementTextColor" class="color-picker" value="#333333">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Second Announcement Bar Card -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-bullhorn"></i> Secondary Announcement</h2>
                        <span class="status-badge inactive" id="announcement2Status">
                            <i class="fas fa-circle"></i> Inactive
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-description">
                            Control the display and content of the secondary announcement bar.
                        </p>
                        
                        <div class="control-item">
                            <div class="control-label">
                                <i class="fas fa-power-off"></i> Enable Secondary Announcement
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="announcement2Toggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label for="announcement2Text">Announcement Text</label>
                            <input type="text" id="announcement2Text" class="form-control" 
                                   placeholder="Enter your secondary announcement message">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="announcement2Color">Background Color</label>
                                <input type="color" id="announcement2Color" class="color-picker" value="#fceabb">
                            </div>
                            <div class="form-group">
                                <label for="announcement2TextColor">Text Color</label>
                                <input type="color" id="announcement2TextColor" class="color-picker" value="#333333">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <button class="btn btn-success btn-block" id="saveAnnouncement1Config">
                            <i class="fas fa-save"></i> Save Main Announcement
                        </button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block" id="saveAnnouncement2Config">
                            <i class="fas fa-save"></i> Save Secondary Announcement
                        </button>
                    </div>
                </div>
            </section>

            <!-- Emergency Control Section -->
            <section id="emergency-control-section" class="content-section" style="display: none;">
                <div class="page-header">
                    <h1>Emergency Control</h1>
                </div>
                
                <p class="page-description">
                    Manage emergency settings for your website.
                </p>

                <!-- Emergency Page Activation Card -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-exclamation-triangle"></i> Emergency Page Control</h2>
                        <span class="status-badge inactive">
                            <i class="fas fa-circle"></i> Inactive
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-description">
                            Enable or disable pages during emergency situations.
                        </p>
                        
                        <div class="control-item">
                            <div class="control-label">
                                <i class="fas fa-home"></i> Homepage
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="emergencyHomepageToggle" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="control-item">
                            <div class="control-label">
                                <i class="fas fa-info-circle"></i> About Us
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="emergencyAboutUsToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="control-item">
                            <div class="control-label">
                                <i class="fas fa-concierge-bell"></i> Services
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="emergencyServicesToggle" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="control-item">
                            <div class="control-label">
                                <i class="fas fa-envelope"></i> Contact Us
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="emergencyContactUsToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 1.5rem;">
                    <button class="btn btn-success btn-block" id="saveEmergencyConfig">
                        <i class="fas fa-save"></i> Save Emergency Configuration
                    </button>
                </div>
            </section>
            
            <footer style="margin-top: 2rem; text-align: center; color: #666; font-size: 0.875rem;">
                <p>VocaSphere Admin Portal &copy; 2025 | Barohal Union, Sylhet Division, Bangladesh</p>
            </footer>
        </main>
    </div>

    <script>
        // Admin Authentication
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const adminAuthOverlay = document.getElementById('adminAuthOverlay');
            const mainContent = document.getElementById('mainContent');
            const sidebar = document.getElementById('sidebar');
            const adminLoginBtn = document.getElementById('adminLoginBtn');
            const adminErrorMessage = document.getElementById('adminErrorMessage');
            const adminStatus = document.getElementById('adminStatus');
            const adminLogout = document.getElementById('adminLogout');
            
            // Section navigation elements
            const navLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');
            
            // Admin credentials
            const adminCredentials = {
                username: 'admin',
                password: 'admin2025'
            };
            
            // Check if already logged in
            if (sessionStorage.getItem('adminAuthenticated') === 'true') {
                adminAuthOverlay.style.display = 'none';
                adminStatus.style.display = 'block';
            } else {
                mainContent.classList.add('dashboard-blur');
                sidebar.classList.add('dashboard-blur');
            }
            
            // Admin login authentication
            adminLoginBtn.addEventListener('click', function() {
                const username = document.getElementById('adminUsername').value.trim();
                const password = document.getElementById('adminPassword').value.trim();
                
                if (username === adminCredentials.username && password === adminCredentials.password) {
                    // Successful login
                    adminAuthOverlay.style.display = 'none';
                    mainContent.classList.remove('dashboard-blur');
                    sidebar.classList.remove('dashboard-blur');
                    adminStatus.style.display = 'block';
                    
                    // Store auth state
                    sessionStorage.setItem('adminAuthenticated', 'true');
                } else {
                    // Failed login
                    adminErrorMessage.style.display = 'block';
                }
            });
            
            // Admin logout - redirect to dashboard.php
            adminLogout.addEventListener('click', function() {
                // Clear auth state
                sessionStorage.removeItem('adminAuthenticated');
                window.location.href='../dashboard.php?valofmenu=dashboard';
                
                // Redirect to dashboard.php
            });
            
            // Allow Enter key for login
            document.getElementById('adminPassword').addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    adminLoginBtn.click();
                }
            });
            
            // Navigation between sections
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    navLinks.forEach(navLink => {
                        navLink.classList.remove('active');
                    });
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Hide all content sections
                    contentSections.forEach(section => {
                        section.style.display = 'none';
                    });
                    
                    // Show the selected section
                    const sectionId = this.getAttribute('data-section') + '-section';
                    document.getElementById(sectionId).style.display = 'block';
                });
            });
            
            // Announcement Bar Toggle
            const announcementToggle = document.getElementById('announcementToggle');
            const announcementStatus = document.getElementById('announcementStatus');
            
            announcementToggle.addEventListener('change', function() {
                if (this.checked) {
                    announcementStatus.className = 'status-badge active';
                    announcementStatus.innerHTML = '<i class="fas fa-circle"></i> Active';
                } else {
                    announcementStatus.className = 'status-badge inactive';
                    announcementStatus.innerHTML = '<i class="fas fa-circle"></i> Inactive';
                }
            });
            
            // Secondary Announcement Bar Toggle
            const announcement2Toggle = document.getElementById('announcement2Toggle');
            const announcement2Status = document.getElementById('announcement2Status');
            
            announcement2Toggle.addEventListener('change', function() {
                if (this.checked) {
                    announcement2Status.className = 'status-badge active';
                    announcement2Status.innerHTML = '<i class="fas fa-circle"></i> Active';
                } else {
                    announcement2Status.className = 'status-badge inactive';
                    announcement2Status.innerHTML = '<i class="fas fa-circle"></i> Inactive';
                }
            });
            
            // Save Page Configuration
            document.getElementById('savePageConfig').addEventListener('click', function() {
                // Check if authenticated
                if (sessionStorage.getItem('adminAuthenticated') !== 'true') {
                    alert('You must be authenticated as admin to save configuration.');
                    return;
                }
                
                const pageConfig = {
                    homepage: document.getElementById('homepageToggle').checked,
                    aboutUs: document.getElementById('aboutUsToggle').checked,
                    services: document.getElementById('servicesToggle').checked,
                    contactUs: document.getElementById('contactUsToggle').checked
                };
                
                console.log('Page configuration saved:', pageConfig);
                showSuccessFeedback(this, 'Page Configuration Saved');
            });
            
            // Save Main Announcement Configuration
            document.getElementById('saveAnnouncement1Config').addEventListener('click', function() {
                if (sessionStorage.getItem('adminAuthenticated') !== 'true') {
                    alert('You must be authenticated as admin to save configuration.');
                    return;
                }
                
                const announcementConfig = {
                    enabled: document.getElementById('announcementToggle').checked,
                    text: document.getElementById('announcementText').value,
                    bgColor: document.getElementById('announcementColor').value,
                    textColor: document.getElementById('announcementTextColor').value
                };
                
                console.log('Main announcement configuration saved:', announcementConfig);
                showSuccessFeedback(this, 'Main Announcement Saved');
            });
            
            // Save Secondary Announcement Configuration
            document.getElementById('saveAnnouncement2Config').addEventListener('click', function() {
                if (sessionStorage.getItem('adminAuthenticated') !== 'true') {
                    alert('You must be authenticated as admin to save configuration.');
                    return;
                }
                
                const announcementConfig = {
                    enabled: document.getElementById('announcement2Toggle').checked,
                    text: document.getElementById('announcement2Text').value,
                    bgColor: document.getElementById('announcement2Color').value,
                    textColor: document.getElementById('announcement2TextColor').value
                };
                
                console.log('Secondary announcement configuration saved:', announcementConfig);
                showSuccessFeedback(this, 'Secondary Announcement Saved');
            });
            
            // Save Emergency Configuration
            document.getElementById('saveEmergencyConfig').addEventListener('click', function() {
                if (sessionStorage.getItem('adminAuthenticated') !== 'true') {
                    alert('You must be authenticated as admin to save configuration.');
                    return;
                }
                
                const emergencyConfig = {
                    homepage: document.getElementById('emergencyHomepageToggle').checked,
                    aboutUs: document.getElementById('emergencyAboutUsToggle').checked,
                    services: document.getElementById('emergencyServicesToggle').checked,
                    contactUs: document.getElementById('emergencyContactUsToggle').checked
                };
                
                console.log('Emergency configuration saved:', emergencyConfig);
                showSuccessFeedback(this, 'Emergency Configuration Saved');
            });
            
            // Helper function to show success feedback
            function showSuccessFeedback(button, message) {
                const originalText = button.innerHTML;
                button.innerHTML = `<i class="fas fa-check"></i> ${message}`;
                button.style.backgroundColor = '#27ae60';
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.backgroundColor = '';
                }, 2000);
            }
            
            // Responsive sidebar toggle (for mobile)
            const menuToggle = document.createElement('button');
            menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
            menuToggle.style.position = 'fixed';
            menuToggle.style.top = '1rem';
            menuToggle.style.left = '1rem';
            menuToggle.style.zIndex = '101';
            menuToggle.style.background = 'var(--primary-color)';
            menuToggle.style.color = 'white';
            menuToggle.style.border = 'none';
            menuToggle.style.borderRadius = '50%';
            menuToggle.style.width = '40px';
            menuToggle.style.height = '40px';
            menuToggle.style.display = 'none';
            menuToggle.style.justifyContent = 'center';
            menuToggle.style.alignItems = 'center';
            menuToggle.style.cursor = 'pointer';
            menuToggle.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
            document.body.appendChild(menuToggle);
            
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
            
            // Show/hide menu toggle based on screen size
            function handleResize() {
                if (window.innerWidth < 992) {
                    menuToggle.style.display = 'flex';
                    sidebar.classList.remove('active');
                } else {
                    menuToggle.style.display = 'none';
                    sidebar.classList.add('active');
                }
            }
            
            window.addEventListener('resize', handleResize);
            handleResize(); // Initialize
            
            // Show the first section by default
            document.querySelector('.sidebar-link.active').click();
        });
    </script>
</body>
</html>