<?php include_once("../connection.php"); ?>
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

        #selectbar, #searchbar {
            font-size: 20px;
            position: absolute;
            top: 70px;
            z-index: 10;
        }

        #selectbar {
            left: 200px;
        }

        #searchbar {
            left: 400px;
            padding: 5px;
            width: 200px;
        }
    </style>
</head>

<body> 
    <!-- displaying the Data -->
    <div class="container">
        <!-- Dropdown for Alphabet Filter -->
        <select name="selectbar" id="selectbar">
            <option value="AA">All Word</option>
            <option value="A">#A</option>
            <option value="B">#B</option>
            <option value="C">#C</option>
        </select>

        <!-- Search Bar -->
        <input type="text" id="searchbar" placeholder="Search by word...">

        <table id="table" border="3" class="words">
            <thead>
                <tr>
                    <th>Word</th>
                    <th>Meaning</th>
                    <th>Bangla</th>
                </tr>
            </thead> 
            <tbody>
                <?php 
                $sql = "SELECT * FROM `vocab`";
                $query = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr class="data-row">
                        <td><?php print $row['word']; ?></td>
                        <td><?php print $row['meaning']; ?></td>
                        <td><?php print $row['bangla']; ?></td>
                    </tr>
                <?php
                }          
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Filter by Alphabet Selection
            $("#selectbar").on('change', function() {
                var char = $(this).val().toLowerCase();
                
                if (char === "aa") {
                    $(".data-row").show(); // সব দেখাও
                } else {
                    $(".data-row").hide(); // সব লুকাও
                    $(".data-row").filter(function() {
                        return $(this).find("td:first").text().trim().toLowerCase().startsWith(char);
                    }).show();
                }
            });

            // Search by Word (Live Filtering)
            $("#searchbar").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();
                
                $(".data-row").hide();
                
                $(".data-row").filter(function() {
                    return $(this).find("td:first").text().toLowerCase().includes(searchText);
                }).show();
            });
        });
    </script>
</body>
</html>
