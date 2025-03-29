<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere Recruit - Circular Notice Control</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .control-section {
            margin-bottom: 25px;
            text-align: left;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .control-section h2 {
            color: #555;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
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
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .icon-activate {
            color: green;
            font-size: 1.5em;
            margin-left: 10px;
            vertical-align: middle;
        }

        /* Basic styling for the notice bar input */
        #noticeBarText {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .hidden-page-control {
            margin-top: 20px;
            text-align: left;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .hidden-page-control h2 {
            color: #555;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .button {
            background-color: #5cb85c; /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #4cae4c;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h1>VocaSphere Recruit - Prelanding Setup</h1>
        <p>Configure key features before going live.</p>

        <div class="control-section">
            <h2>Circular Notice Bar Control</h2>
            <label for="noticeBarToggle">Enable Notice Bar:</label>
            <label class="toggle-switch">
                <input type="checkbox" id="noticeBarToggle">
                <span class="slider round"></span>
            </label>
            <i class="fa fa-check-circle icon-activate" id="noticeBarIcon" style="display:none;"></i>
            <br><br>
            <label for="noticeBarText">Notice Bar Text:</label>
            <input type="text" id="noticeBarText" placeholder="Enter text for the notice bar">
        </div>

        <div class="hidden-page-control">
            <h2>Hidden Prelanding Page Control</h2>
            <p>Control the visibility of other prelanding pages that are not yet ready.</p>
            <div class="page-control-item">
                <label for="page1Toggle">Enable Page 1 (Example):</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="page1Toggle" disabled>
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-eye-slash icon-activate" style="color: red;"></i> <small>(Not yet functional)</small>
            </div>
            </div>

        <button class="button">Save Configuration</button>

        <p style="margin-top: 20px; font-size: 0.8em; color: #777;">Currently located in Barohal Union, Sylhet Division, Bangladesh.</p>
    </div>

    <script>
        const noticeBarToggle = document.getElementById('noticeBarToggle');
        const noticeBarIcon = document.getElementById('noticeBarIcon');

        noticeBarToggle.addEventListener('change', function() {
            if (this.checked) {
                noticeBarIcon.style.display = 'inline-block';
            } else {
                noticeBarIcon.style.display = 'none';
            }
            // In a real application, you would save this state.
        });

        // For the "Save Configuration" button, you would typically have JavaScript
        // that sends the data from the form to your backend to save the settings.
        const saveButton = document.querySelector('.button');
        saveButton.addEventListener('click', function() {
            const isNoticeBarEnabled = noticeBarToggle.checked;
            const noticeBarText = document.getElementById('noticeBarText').value;

            console.log('Notice Bar Enabled:', isNoticeBarEnabled);
            console.log('Notice Bar Text:', noticeBarText);
            alert('Configuration Saved (Console output for details)');
            // In a real application, you would send this data to your server.
        });
    </script>
</body>
</html>