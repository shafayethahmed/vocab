
<?php 
include_once('connection.php');
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