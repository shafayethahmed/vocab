<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Marquee Styling */
        .marquee {
            width: 100%;
            background: #007bff;
            color: #fff;
            padding: 10px 0;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            position: absolute;
            top: 0px;
        }
        
        /*Notice Bar */
        .notice-item-for-recruit{
            width: 100%;
            background:white;
            color: black;
            padding: 4px;
            font-size: 16px;
            font-weight:normal;
            text-align: center;
            position:absolute;
            top: 40px;
        }
        /* Dictionary Container */
        .dictionary-container {
            width: 50%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .dictionary-container:hover {
            transform: scale(1.02);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #007bff;
        }

        /* Search Box */
        .search-box {
            width: 90%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #007bff;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            border-color: #0056b3;
            box-shadow: 0px 0px 10px rgba(0, 91, 187, 0.3);
        }

        /* Result Box */
        .result-container {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.5s, transform 0.5s;
        }

        .show-result {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .word-title {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }

        .definition {
            font-size: 16px;
            margin-top: 5px;
            color: #555;
        }

        /* Auth Icons Below Search */
        .auth-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .auth-container a {
            text-decoration: none;
            font-size: 20px;
            color: #007bff;
            background: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: opacity 0.3s;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }

        .auth-container a:hover {
            opacity: 0.7;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="marquee">
    Welcome to the VocaSphere - Enhance Your Word Power! Login Here For Test Your Vocabulary Skill <a href="../LoginPage.php"><button class="modal-btn"><b style="color: red; padding:5px; margin-top:-10px;">Login!</b></button></a>
</div>

<div class="notice-item-for-recruit">
           <marquee behavior="slow" direction="left">"VocaSphere is hiring! Join our dynamic team and take your career to the next level. Recruitment ends in just 7 days, so don’t miss this opportunity! Hurry up and send your CV and other relevant information to <a href="recruit.php"><button class="modal-btn"> <b style="color: red;">Hire Me!</b></button></a> ."</marquee>
    </div>
<div class="dictionary-container">
    <h1>Vocasphere</h1>
    <input type="text" id="search-box" class="search-box" placeholder="Type a word..." autocomplete="off">
    <div id="result" class="result-container"></div>
</div>

<script>
$(document).ready(function(){
    $("#search-box").on("keyup", function(){
        let query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: "search.php",
                type: "POST",
                data: { search: query },
                success: function(data) {
                    $("#result").html(data);
                    $("#result").addClass("show-result");
                }
            });
        } else {
            $("#result").removeClass("show-result").html("");
        }
    });
});
</script>

</body>
</html>
