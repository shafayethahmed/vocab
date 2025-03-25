<?php include_once("../connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>this is testing of the Home page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <style>
             #table {
                                width: 75%;
                                border-radius: 10px;
                                margin-top: 100px;
                                margin-left: 180px;
                                 height: 70%;
                        }

                        #data {
                            background-color: lightblue;
                            text-align: center;
                        }

                        #selectbar {
                            font-size: 20px;
                            position: absolute; /* টেবিলের উপরে বা পাশে আনতে */
                            top: 70px; /* টেবিলের কাছাকাছি আনার জন্য adjust করুন */
                            left: 200px; /* প্রয়োজন অনুযায়ী পরিবর্তন করুন */
                            z-index: 10; /* টেবিলের উপরে রাখার জন্য */
                        }

    </style>
</head>

<body> 
             <!-- displaying the Data -->
             
              <div class="container">
                         <select name="selectbar" id="selectbar">
                            <option value="AA">All Word</option>
                            <option value="A">#A</option>
                            <option value="B">#B</option>
                            <option value="C">#C</option>
                         </select>
              <table id="table" border="3" class="words">
                <thead>
                    <tr>
                        <th>Word</th>
                        <th>Meaning</th>
                        <th>Bangla</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $sql = "SELECT * FROM `vocab`";
                           $query = mysqli_query($conn,$sql);
                           while($row = mysqli_fetch_assoc($query)){
                            ?>
                                    <tr id="data">
                                        <td><?php print $row['word'];?></td>
                                        <td><?php print $row['meaning'];?></td>
                                        <td><?php print $row['bangla'];?></td>
                                    </tr>
                            <?php
                           }          
                         ?>
               
                </tbody>
            </table>
              </div>

              <script>
                    $(document).ready(function(){
    $("#selectbar").on('change', function(){
        var char = $(this).val().toLowerCase();
        
        if (char === "aa") {
            $(".words tr").show(); // সব ওয়ার্ড দেখাও
        } else {
            $(".words tr:gt(0)").hide(); // প্রথম হেডার বাদে সব লুকাও
            $(".words tr").filter(function(){
                return $(this).find("td:first").text().trim().toLowerCase().startsWith(char);
            }).show();
        }
    });
});

           </script>
</body>
</html>