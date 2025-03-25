<?php 
    session_start();
    $userId = $_SESSION['id'];
    if(!$userId){
        header('location:./mainDashboard/index.php');
    }
    error_reporting(0);
    include_once('connection.php');
    if(isset($_GET['task']) && 'logout' == $_GET['task']){
        session_unset();
        session_destroy();
        header('location:./mainDashboard/index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere-Dashboard</title> 
    <link rel="stylesheet" href="./asset/CSS/dash.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <!--- library --->


    
    
</head>
<body>
<div class="sidebar">
    <div class="brand">VocaSphere</div>
    <nav>
        <a href="?valofmenu=dashboard" class="active">Dashboard</a>
        <a href="?valofmenu=words">Words</a>
        <a href="?valofmenu=memberlist">Members</a>
        <a href="?valofmenu=event">Events</a>
        <a href="profile.php">Profile</a>
        <a href="?valofmenu=team">Team Management</a>
        <a href="?valofmenu=recruit">Recruit</a>
        <a href="#">Support</a>
        <b><a href="?task=logout" style="color:red">Logout</a></b>
    </nav>
</div>

   <?php  $itemFromDash = $_GET['valofmenu']; ?> <!-- using for displaying the location of navbar-->  
    <div class="main-content">
        <div class="header">
            <br>
            <h1>
                <!--Adding the Section for Sidebar Menu display in the Top-->
                 <?php print( ucwords($itemFromDash," "));?> 
            </h1>
            <div class="user-info">
                <img src="https://via.placeholder.com/40" alt="User">
                <div>
                    <p class="font-semibold">Shafayeth Ahmed</p>
                    <p class="text-xs text-gray-500"><?php print $userId ;?></p>
                </div>
            </div>
        </div>
  <!-- Adding section here for maintaing the inside dashbaord Menubar Process --> 
     <?php 
        $takingMenuItem = $_GET['manumassage']; 
        if('dashboard' === $takingMenuItem || 'dashboard' === $itemFromDash){
            ?>
               <!-- Summary Statistics -->
         
         
          <!-- Leaderboard -->
          <div class="leaderboard">
            <h2>Leaderboard</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>U101</td>
                        <td>1</td>
                        <td>Alice Johnson</td>
                        <td>980</td>
                    </tr>
                    <tr>
                        <td>U102</td>
                        <td>2</td>
                        <td>Bob Smith</td>
                        <td>950</td>
                    </tr>
                    <tr>
                        <td>U103</td>
                        <td>3</td>
                        <td>Charlie Davis</td>
                        <td>920</td>
                    </tr>
                    <tr>
                        <td>U104</td>
                        <td>4</td>
                        <td>David Lee</td>
                        <td>890</td>
                    </tr>
                    <tr>
                        <td>U105</td>
                        <td>5</td>
                        <td>Ella Martinez</td>
                        <td>860</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Live Score -->
        <div class="live-score">
            <h2>Live Score</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Problem Set</th>
                        <th>Score</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>U101</td>
                        <td>Set A</td>
                        <td>100</td>
                        <td>2025-02-06 14:30</td>
                    </tr>
                    <tr>
                        <td>U102</td>
                        <td>Set B</td>
                        <td>95</td>
                        <td>2025-02-06 14:32</td>
                    </tr>
                </tbody>
            </table>
        </div>
            <?php 
        } 
        if ('memberlist' === $itemFromDash) {
            ?>
            <link rel="stylesheet" href="./asset/CSS/word.css">
            <marquee behavior="normal" direction="left" style="background-color: lightgreen; padding: 5px;">
            Pagination,Searchbox Order by email ,Edit user account test is successfully passed on 26-FEB-2025 at 12.59 AM.
            </marquee>
                    <!-- Search Bar -->
                    <input type="text" id="searchbar" placeholder="Search by email..." style="padding: 10px; width: 200px; margin-top:6px">
            <!-- Words Table -->
            <table id="words-table">
                <thead>
                   <tr >
                        <th>User ID</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Created Date</th>
                        <th>Account Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            // Fetching Data
            $query = "SELECT * FROM `users`";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
               <tr class="data-row">
                                <td>U-<?php echo $row['id']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $stndForm = date("jS M, Y", (strtotime($row['createdate'])));?></td>  
                                <td><?php echo ($row['status']) == 1 ? 'Active' : 'Deactive'; ?> </td>
                                <td><a href="edit.php?attach=edituser&id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a></td>
                            </tr>

            <?php
            }
            ?>
        </tbody>
    </table>
              <!--Pagination bar -->
               <!--Pagination bar -->
               <style>
                         #pagination-container{
                            padding: 7px;
                            margin-top: 10px;
                            width: auto;
                            text-align: center; 
                         }
                         #prev-page{
                            background-color:lavender;
                            color: black;
                         }
                         #next-page{
                            background-color:lavender;
                            color: black;
                         }
                         #page-numbers{
                            color: red;
                         }
                       </style>
              <div id="pagination-container">
                            <button id="prev-page">⟨ Previous</button>
                            <span id="page-numbers"></span>
                            <button id="next-page">Next ⟩</button>
                        </div>

        <?php
        }        
       elseif ('words' === $itemFromDash) {
        ?>
            <link rel="stylesheet" href="./asset/CSS/word.css">
            <marquee behavior="normal" direction="left" style="background-color: lightgreen; padding: 5px;">
               Pagination,Searchbox Order by word , Add new word & Edit word  test is successfully passed on 26-FEB-2025 at 12.04 AM.
            </marquee>

            <!-- Button trigger modal -->
            <button id="model-btn-edit-word">Add New Word</button>
           <!-- Modal -->
<div id="example-modal-container" style="display: none;">
    <div id="example-modal-content">
        <span id="example-modal-close-btn">&times;</span>
        <h1 id="tittle-name">Add New Word</h1>
        <form action="save_word.php" method="post" id="addWordData">
            <input type="hidden" name="sub" value="wordsub">
            <label for="word" id="modal-word-label">Word:</label>
            <input type="text" name="word" id="modal-word-input" required>
            <label for="meaning" id="modal-meaning-label">Meaning:</label>
            <textarea name="meaning" id="modal-meaning-textarea" required></textarea>
            <br>
            <br>
            <label for="bangla">Bangali:</label>
            <input type="text" name="bangla" id="modal-bangla-input" required>
            <br>
            <br>
            <label for="synonym">Synonym:</label>
            <input type="text" name="synonym" id="modal-synonym-input" required>
            <br>
            <br>
            <label for="example">Example:</label>
            <textarea name="example" id="modal-example-textarea" required></textarea>
            <div id="example-modal-footer">
                <button type="button" id="example-modal-cancel-btn">Cancel</button>
                <button type="submit" id="example-modal-save-btn">Save Word</button>
            </div>
        </form>
    </div>
</div>

              <!-- Search Bar -->
                    <input type="text" id="searchbar" placeholder="Search by word..." style="padding: 10px; width: 200px; margin-top:6px">
            <!-- Words Table -->
            <table id="words-table">
                <thead>
                    <tr>
                        <th>Word ID</th>
                        <th>Word</th>
                        <th>Meaning</th>
                        <th>Bangla</th>
                        <th>Parts Of Speech</th>
                        <th>Example</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM `vocab`"; // Limit এবং Offset বাদ দিন
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr class="data-row">
                            <td>W-<?php echo $row['wid']; ?></td>
                            <td><?php echo $row['word']; ?></td>
                            <td><?php echo $row['meaning']; ?></td>
                            <td><?php echo $row['bangla']; ?></td>
                            <td><?php echo $row['synonym']; ?></td>
                            <td><?php echo $row['example']; ?></td>
                            <td>
                                <a href="edit.php?attach=editword&wid=<?php echo $row['wid']; ?>" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
             
         <?php
                    }
                    ?>
                       </tbody>
                       </table>
                       <!--Pagination bar -->
                       <style>
                         #pagination-container{
                            padding: 7px;
                            margin-top: 10px;
                            width: auto;
                            text-align: center; 
                         }
                         #prev-page{
                            background-color:lavender;
                            color: black;
                         }
                         #next-page{
                            background-color:lavender;
                            color: black;
                         }
                         #page-numbers{
                            color: red;
                         }
                       </style>
                       <div id="pagination-container">
                            <button id="prev-page">⟨ Previous</button>
                            <span id="page-numbers"></span>
                            <button id="next-page">Next ⟩</button>
                        </div>


              <script>
                        //All Script for Add New Word
                        document.addEventListener("DOMContentLoaded", function() {
                            document.getElementById('model-btn-edit-word').addEventListener('click', function() {
                                document.getElementById('example-modal-container').style.display = 'block';
                            });
                            
                            document.getElementById('example-modal-close-btn').addEventListener('click', function() {
                                document.getElementById('example-modal-container').style.display = 'none';
                            });
                            
                            document.getElementById('example-modal-cancel-btn').addEventListener('click', function() {
                                document.getElementById('example-modal-container').style.display = 'none';
                            });
                        });
            </script>

                       <?php
                }
                    
         //Team Management Start From Here : 
          elseif('team' === $itemFromDash){//if the menu is team.
            //working for role set: 
                $sql = "SELECT * FROM `userrole`";
                $result = mysqli_query($conn,$sql);
              ?>
              <link rel="stylesheet" href="./asset/CSS/team.css">
              <marquee behavior="normal" direction="left" style="background-color: lightgoldenrodyellow;">This Page is used for team management currently working on backend. New Role Create And Count Of Total Role is done.</marquee>
              
                <!-- Dashboard Cards -->
    <div class="dashboard-card-for-open">
        <div class="card"><img src="./asset/Contexts/user.png" alt="" style="width: 70px; "><h3>Total Employees</h3><p>10</p></div>
        <div class="card"><img src="./asset/Contexts/role.png" alt="" style="width: 70px; "><h3>Total User Roles</h3><p><?php if($result){$rows=mysqli_num_rows($result);echo $rows;}?></p></div>
        <div class="card"><img src="./asset/Contexts/active.png" alt="" style="width: 60px; "><h3>Active Employee</h3><p>8</p></div>
        <div class="card"><img src="./asset/Contexts/block.png" alt="" style="width: 60px; "><h3>Deactivated Employee</h3><p>2</p></div>
    </div>
       
      <!-- User Role Table -->
    <h2>User Roles</h2>
    <button class="add-btn-role" onclick="openModal('roleModal')">+ Add Role</button>
    <table id="roleTable" class="roleTable">
                 <tr><th>ID</th><th>Role Name</th></tr>
        <?php
          while($row = mysqli_fetch_assoc($result)){
            ?>
                    <tr><td>UR-<?php print $row['id'];?></td><td><?php print $row['role'];?></td></tr>
            <?php 
          }
        ?>
      
    </table>

    <!-- Employees Table -->
    <h2>Employees</h2>
    <input type="text" class="search-box" id="search" placeholder="Search by name..." onkeyup="searchTable()">
    <button class="add-btn-employee" onclick="openModal('employeeModal')">+ Add Employee</button>
    <table class="employeeTable" id="employeeTable" >
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>
        <tr><td>1</td><td>Shafayeth Ahmed</td><td>shafayeth@example.com</td><td>Admin</td><td><button class="edit-btn" onclick="editEmployee(1)">Edit</button></td></tr>
        <tr><td>2</td><td>John Doe</td><td>john@example.com</td><td>Editor</td><td><button class="edit-btn" onclick="editEmployee(2)">Edit</button></td></tr>
    </table>

    <!-- Add Employee Modal -->
    <div class="modal" id="employeeModal">
        <div class="modal-header">Add New Employee</div>
        <form action="form_handle.php" method="post">
            <link rel="stylesheet" href="./asset/CSS/team.css">
        <label for="emailSelect">Select Email:</label>
        <select id="emailSelect" name="emailoption" class="email-dropdown" style="width:100%; background-color:salmon">
          <?php  $sql1 = "SELECT * FROM `users` WHERE `status` = 1";
                $result1 = mysqli_query($conn,$sql1);
                 while($rowa_role1 = mysqli_fetch_assoc($result1)){
                    ?> 
                    <option value="<?php echo $rowa_role1['email'];?>"><?php echo $rowa_role1['email'];?></option>
                    <?php
                 }
                ?>
    </select>
        <select id="empRole" name="roleoption" style="padding: 10px; width:100%; font-size:large">
          <?php  $sql = "SELECT * FROM `userrole`";
                $result = mysqli_query($conn,$sql);
                 while($rowa_role = mysqli_fetch_assoc($result)){
                    ?>
                    <option value="<?php echo $rowa_role['role'];?>"><?php echo $rowa_role['role'];?></option>
                    <?php
                 }
                ?>
     </select>
    <button class="add-btn-confirm" id="addEmployeeBtn" >Add</button>
</form>
     <button class="close-btn" onclick="closeModal('employeeModal')" >Close</button>
    </div>
 
    <!-- Edit Employee Modal -->
    <div class="modal" id="editEmployeeModal">
        <div class="modal-header">Edit Employee</div>
        <input type="hidden" id="editEmpId">
        <input type="text" id="editEmpName">
        <input type="email" id="editEmpEmail">
        <select id="editEmpRole">
            <option value="Admin">Admin</option>
            <option value="Editor">Editor</option>
        </select>
        <button class="add-btn-confirm" onclick="updateEmployee()">Update</button>
        <button class="close-btn" onclick="closeModal('editEmployeeModal')">Close</button>
    </div>

    <!--User Role Modal-->
     <!-- Modals -->
     <div class="modal" id="roleModal" style="width: 20%; height:13%; background-color:lavender">
     <form action="form_handle.php" method="POST">
        <div class="modal-header">Add New Role</div>
        <input type="text" id="roleName" placeholder="Enter Role Name" name="roleadd" required>
        <button  class="add-btn-confirm">Add</button>
        <button  class="close-btn" onclick="closeModal('roleModal')" name="closerole">Close</button>
        </form> 
    </div>
   <?php  
          } //mew elseif start from there!
          elseif('recruit' == $itemFromDash){
              ?>
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                 <!-- Collect Data From Recruit Section In Front Page--> 
                  <table>
                     <thead>
                     <tr >
                            <th>AP-Id</th>
                            <th>Applicant Name</th>
                            <th>Applicant Email</th>
                            <th>Applicant Status</th>
                            <th>Actions</th>
                        </tr>
                     </thead>

                     <tbody>
                     <?php
                    $query = "SELECT * FROM `cv`"; // Limit এবং Offset বাদ দিন
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr class="data-row">
                         <td><?php echo $row['cv_id']; ?></td>
                         <td><?php echo $row['cv_name']; ?></td>
                         <td><?php echo $row['cv_Email']; ?></td>
                         <td><?php if($row['cv_review'] == 0){
                            print('<p style="color:red;">Rejected</p>');}
                            elseif($row['cv_review'] == 1){
                                print('<p style="color:green;">Selected</p>');}
                                elseif($row['cv_review'] == 2){
                                    print('<p style="color:orange;">On Hold</p>');}
                            ?></td>
                        <td><a href="edit.php?attach=cvcheck&applicantid=<?php print($row['cv_id']);?>"><i class="fa fa-edit" style="font-size: 22px;"></i></a></td>
                        </tr>
                    <?php
                       } //Table For Client id Ended Here!                  
                    ?>
                     </tbody>
                  </table>
              <?php
          }
     ?>
       
    </div>
    <script src="./asset/JS/Script.js" defer></script>   
</body>
</html>
