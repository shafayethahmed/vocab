<?php
include_once('connection.php');
$AttachmentByWeb= $_GET['attach'];
//finding the Value Of Edit Word.
if ($AttachmentByWeb === 'editword') {
    //This DB is called for Edit Word.
    $wid = $_GET['wid'];
    $query = "SELECT * FROM vocab WHERE wid=$wid";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} 
elseif($AttachmentByWeb === 'edituser'){
    //This DB is called for Edit User Profile!
    $uid =  $_GET['id'];
    $query = "SELECT * FROM users WHERE id=$uid";
    $result = mysqli_query($conn, $query);
    $urow = mysqli_fetch_assoc($result);
}
elseif($AttachmentByWeb === 'cvcheck'){
    $cvid =  $_GET['applicantid'];
    $query = "SELECT * FROM `cv` WHERE cv_id=$cvid";
    $result = mysqli_query($conn, $query);
    $crow = mysqli_fetch_assoc($result);
}
//Else is Must be add for update the user Cv id here.
else {
    echo "Invalid Request!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($AttachmentByWeb); ?> | Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --danger-color: #e74a3b;
            --card-border-radius: 0.75rem;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: var(--card-border-radius);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1.5rem;
            border-top-left-radius: var(--card-border-radius) !important;
            border-top-right-radius: var(--card-border-radius) !important;
        }
        
        .card-body {
            padding: 1.75rem;
        }
        
        .page-title {
            color: #5a5c69;
            font-weight: 700;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
            padding-left: 1rem;
        }
        
        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
            font-size: 0.9rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: #6e707e;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn {
            border-radius: 0.5rem;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;  /* Smaller size for status badges */
            border-radius: 50rem;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-block;
        }
        
        .status-active {
            background-color: rgba(28, 200, 138, 0.2);
            color: #1cc88a;
        }
        
        .status-inactive {
            background-color: rgba(231, 74, 59, 0.2);
            color: #e74a3b;
        }
        
        .status-hold {
            background-color: rgba(246, 194, 62, 0.2);
            color: #f6c23e;
        }
        
        .info-box {
            background-color: #f8f9fc;
            border-left: 4px solid #4e73df;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        
        select.form-select {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
            font-size: 0.9rem;
            height: auto;
        }
        
        .field-group {
            margin-bottom: 1.5rem;
        }
        
        .readonly-field {
            background-color: #f8f9fc;
        }
        
        .required-label {
            color: var(--danger-color);
            font-weight: bold;
        }
        
        .profile-pic-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 1.5rem;
            border: 5px solid #f8f9fc;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .profile-pic {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .cv-preview {
            width: 100%;
            height: 500px;
            border: 1px solid #e3e6f0;
            border-radius: 0.5rem;
        }
        
        .status-dropdown {
            width: auto;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <?php if('editword' === $AttachmentByWeb): ?>
    <!-- Keep the edit word section mostly unchanged as requested -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Edit Word</h3>
            <a href="dashboard.php?valofmenu=words" class="btn btn-danger" >Cancel</a>
        </div>
        <div class="card-body">
            <form action="updateword&userdata.php" method="POST">
                <label for="wordid">Word ID:</label>
                <input type="text" name="wid" class="form-control" value="<?php echo $row['wid']; ?>" readonly >

                <label for="word">Word:</label>
                <input type="text" name="word" class="form-control" value="<?php echo $row['word']; ?>" required>

                <label for="meaning" class="mt-2">Meaning:</label>
                <input type="text" name="meaning" class="form-control" value="<?php echo $row['meaning']; ?>" required>
                
                <label for="bangla" class="mt-2">Bangali:</label>
                <input type="text" name="bangla" class="form-control" value="<?php echo $row['bangla']; ?>" required>

                <label for="synonym" class="mt-2">Synonym:</label>
                <input type="text" name="synonym" class="form-control" value="<?php echo $row['synonym']; ?>" required>

                <label for="meaning" class="mt-2">Example:</label>
                <textarea name="example" class="form-control"><?php echo $row['example']; ?></textarea>
                 
                <button type="submit" class="btn btn-success mt-3" name="updateword">Update</button>
                <a href="dashboard.php?valofmenu=words" class="btn btn-danger mt-3" >Cancel</a>
            </form>
        </div>
    </div>
    
    <?php elseif('edituser' === $AttachmentByWeb): ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Edit User Profile</h4>
            <a href="dashboard.php?valofmenu=memberlist" class="btn btn-sm btn-outline-primary"><i class="fas fa-arrow-left me-1"></i> Back to Members</a>
        </div>
        <div class="card-body">
            <div class="info-box mb-4">
                <p class="mb-0"><i class="fas fa-info-circle me-2"></i> Fields marked with <span class="required-label">*</span> are editable. Other fields are read-only.</p>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-4 text-center">
                    <!-- Added display picture section -->
                    <div class="profile-pic-container">
                        <img src="<?php echo isset($urow['profile_pic']) ? $urow['profile_pic'] : 'assets/img/default-profile.jpg'; ?>" alt="Profile Picture" class="profile-pic">
                    </div>
                    <div class="mb-3">
                        <div class="status-badge <?php echo ($urow['status'] == 1) ? 'status-active' : 'status-inactive'; ?>">
                            <i class="fas <?php echo ($urow['status'] == 1) ? 'fa-check-circle' : 'fa-times-circle'; ?> me-1"></i> 
                            <?php echo ($urow['status'] == 1) ? 'Active' : 'Inactive'; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">User Information</h5>
                            <div class="d-flex mb-2">
                                <div style="width: 40px;"><i class="fas fa-id-card text-primary"></i></div>
                                <div>
                                    <small class="text-muted d-block">User ID</small>
                                    <strong><?php echo $urow['id']; ?></strong>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div style="width: 40px;"><i class="fas fa-user text-primary"></i></div>
                                <div>
                                    <small class="text-muted d-block">Username</small>
                                    <strong><?php echo $urow['username']; ?></strong>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div style="width: 40px;"><i class="fas fa-envelope text-primary"></i></div>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <strong><?php echo $urow['email']; ?></strong>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div style="width: 40px;"><i class="fas fa-calendar-alt text-primary"></i></div>
                                <div>
                                    <small class="text-muted d-block">Joined On</small>
                                    <strong>
                                        <?php
                                            $res = strtotime($urow['createdate']);
                                            $stndForm = date("jS M, Y", $res);
                                            echo $stndForm;
                                        ?>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Added display picture upload section -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Update Profile Picture <span class="required-label">*</span></h5>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="profile_pic" name="profile_pic">
                        <small class="text-muted">Recommended size: 300x300 pixels, JPG or PNG format</small>
                    </div>
                </div>
            </div>
            
            <form action="updateword&userdata.php" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="uid" value="<?php echo $urow['id']; ?>">
                        <input type="hidden" name="email" value="<?php echo $urow['email']; ?>">
                        <input type="hidden" name="username" value="<?php echo $urow['username']; ?>">
                        <input type="hidden" name="joiningDate" value="<?php echo $stndForm; ?>">
                        
                        <div class="field-group">
                            <label for="acstatus" class="form-label">Account Status <span class="required-label">*</span></label>
                            <select id="action" name="acstatus" class="form-select status-dropdown">
                                <option value="1" <?php echo ($urow['status'] == 1) ? "selected" : ""; ?>>Active</option>
                                <option value="0" <?php echo ($urow['status'] == 0) ? "selected" : ""; ?>>Deactivate</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex mt-4">
                    <button type="submit" class="btn btn-success me-2" name="updateprofile"><i class="fas fa-save me-1"></i> Update Profile</button>
                    <a href="dashboard.php?valofmenu=memberlist" class="btn btn-danger"><i class="fas fa-times me-1"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <?php elseif('cvcheck' === $AttachmentByWeb): ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-file-alt me-2"></i>CV Review</h4>
            <a href="dashboard.php?valofmenu=recruit" class="btn btn-sm btn-outline-primary"><i class="fas fa-arrow-left me-1"></i> Back to Recruitment</a>
        </div>
        <div class="card-body">
            <div class="info-box mb-4">
                <p class="mb-0"><i class="fas fa-info-circle me-2"></i> Fields marked with <span class="required-label">*</span> are editable. Other fields are read-only.</p>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Applicant Information</h5>
                            <div class="d-flex mb-2">
                                <div style="width: 40px;"><i class="fas fa-id-card text-primary"></i></div>
                                <div>
                                    <small class="text-muted d-block">CV ID</small>
                                    <strong><?php echo $crow['cv_id']; ?></strong>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div style="width: 40px;"><i class="fas fa-user text-primary"></i></div>
                                <div>
                                    <small class="text-muted d-block">Name</small>
                                    <strong><?php echo $crow['cv_name']; ?></strong>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div style="width: 40px;"><i class="fas fa-envelope text-primary"></i></div>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <strong><?php echo $crow['cv_Email']; ?></strong>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <div class="status-badge <?php 
                                    if($crow['cv_review'] == 1) echo 'status-active';
                                    elseif($crow['cv_review'] == 2) echo 'status-hold';
                                    else echo 'status-inactive';
                                ?>">
                                    <i class="fas <?php 
                                        if($crow['cv_review'] == 1) echo 'fa-check-circle';
                                        elseif($crow['cv_review'] == 2) echo 'fa-pause-circle';
                                        else echo 'fa-times-circle';
                                    ?> me-2"></i> 
                                    <?php 
                                        if($crow['cv_review'] == 1) echo 'Hired';
                                        elseif($crow['cv_review'] == 2) echo 'On Hold';
                                        elseif($crow['cv_review'] == 0) echo 'Rejected';
                                        else echo 'On Review';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Added CV preview section -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">CV Preview</h5>
                            <iframe id="cv-preview" src="http://localhost/Vocab/mainDashboard/<?php echo htmlspecialchars($crow['cv_pdf'], ENT_QUOTES, 'UTF-8'); ?>" width="100%" height="600px"></iframe>
                             <?php print($crow['cv_pdf']); //Location of Cv in DB.?> 
                        </div>
                    </div>
                </div>
            </div>
            
            <form action="updateword&userdata.php" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="cv_id" value="<?php echo $crow['cv_id']; ?>" readonly>
                        <input type="hidden" name="cv_Email" value="<?php echo $crow['cv_Email']; ?>">
                        <input type="hidden" name="cv_name" value="<?php echo $crow['cv_name']; ?>">
                        
                        <div class="field-group">
                            <label for="acstatus" class="form-label">Application Status <span class="required-label">*</span></label>
                            <select id="action" name="cv_acstatus" class="form-select status-dropdown">
                                <option value="1" <?php echo ($crow['cv_review'] == 1) ? "Hired" : ""; ?>>Hired</option>
                                <option value="2" <?php echo ($crow['cv_review'] == 2) ? "Hold" : ""; ?>>On Hold</option>
                                <option value="0" <?php echo ($crow['cv_review'] == 0) ? "Rejected" : ""; ?>>Reject</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex mt-4">
                    <button type="submit" class="btn btn-success me-2" name="updatecvprofile"><i class="fas fa-save me-1"></i> Update Status</button>
                    <a href="dashboard.php?valofmenu=recruit" class="btn btn-danger"><i class="fas fa-times me-1"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>