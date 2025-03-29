<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaSphere Tools - Prelanding Setup</title>
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
            width: 90%;
            max-width: 800px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 25px;
            text-align: left;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .section h2 {
            color: #555;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .page-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .page-item:last-child {
            border-bottom: none;
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
            font-size: 1.2em;
            margin-left: 10px;
            vertical-align: middle;
        }

        .box-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-wrapper {
            display: inline-block;
            position: relative;
            padding-left: 35px;
            margin-right: 15px;
            cursor: pointer;
            font-size: 1em;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .checkbox-wrapper input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 4px;
        }

        .checkbox-wrapper:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .checkbox-wrapper input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-wrapper input:checked ~ .checkmark:after {
            display: block;
        }

        .checkbox-wrapper .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .button {
            background-color: #007bff; /* Blue */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .disabled-label {
            color: #777;
            font-style: italic;
            margin-left: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h1>VocaSphere Tools - Prelanding Setup</h1>
        <p>Configure the activation status of pages and features.</p>

        <div class="section">
            <h2>Page Activation</h2>
            <p>Enable or disable prelanding pages as needed.</p>
            <div class="page-item">
                <span>Homepage</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="homepageToggle" checked>
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="homepageIcon"></i>
            </div>
            <div class="page-item">
                <span>About Us</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="aboutUsToggle">
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="aboutUsIcon" style="display:none;"></i>
            </div>
            <div class="page-item">
                <span>Services</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="servicesToggle" checked>
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="servicesIcon"></i>
            </div>
            <div class="page-item">
                <span>Contact Us</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="contactUsToggle">
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="contactUsIcon" style="display:none;"></i>
            </div>
            <div class="page-item">
                <span>Pricing <span class="disabled-label">(Coming Soon)</span></span>
                <label class="toggle-switch">
                    <input type="checkbox" id="pricingToggle" disabled>
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-eye-slash icon-activate" style="color: red;"></i>
            </div>
            </div>

        <div class="section">
            <h2>Feature Box Activation</h2>
            <p>Select the feature boxes you want to display.</p>
            <div class="box-item">
                <label class="checkbox-wrapper">
                    Show Testimonials Box
                    <input type="checkbox" id="testimonialsCheckbox" checked>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="box-item">
                <label class="checkbox-wrapper">
                    Show Latest News Box
                    <input type="checkbox" id="newsCheckbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="box-item">
                <label class="checkbox-wrapper">
                    Show Call to Action Box
                    <input type="checkbox" id="ctaCheckbox" checked>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="box-item">
                <label class="checkbox-wrapper">
                    Show Social Media Links Box <span class="disabled-label">(Not Configured)</span>
                    <input type="checkbox" id="socialCheckbox" disabled>
                    <span class="checkmark"></span>
                </label>
            </div>
            </div>

        <button class="button">Save Configuration</button>

        <p style="margin-top: 20px; font-size: 0.8em; color: #777;">Currently located in Barohal Union, Sylhet Division, Bangladesh.</p>
    </div>

    <script>
        // Page Activation Toggles
        const pageToggles = {
            homepageToggle: 'homepageIcon',
            aboutUsToggle: 'aboutUsIcon',
            servicesToggle: 'servicesIcon',
            contactUsToggle: 'contactUsIcon'
            // Add more toggle IDs and their corresponding icon IDs
        };

        for (const toggleId in pageToggles) {
            const toggle = document.getElementById(toggleId);
            const iconId = pageToggles[toggleId];
            const icon = document.getElementById(iconId);

            if (toggle && icon) {
                toggle.addEventListener('change', function() {
                    icon.style.display = this.checked ? 'inline-block' : 'none';
                });
            }
        }

        // Save Configuration Functionality (Without Database Connection)
        const saveButton = document.querySelector('.button');
        saveButton.addEventListener('click', function() {
            const pageStatuses = {};
            for (const toggleId in pageToggles) {
                pageStatuses[toggleId.replace('Toggle', '')] = document.getElementById(toggleId).checked;
            }

            const boxStatuses = {
                testimonialsBox: document.getElementById('testimonialsCheckbox').checked,
                latestNewsBox: document.getElementById('newsCheckbox').checked,
                callToActionBox: document.getElementById('ctaCheckbox').checked,
                socialMediaLinksBox: document.getElementById('socialCheckbox').checked
                // Add more checkbox IDs here
            };

            console.log('Page Activation Status:', pageStatuses);
            console.log('Feature Box Activation Status:', boxStatuses);
            alert('Configuration Saved (Check console for status)');

            // In a real application, you would send this data to your backend
            // to be stored in a database.
        });
    </script>
</body>
</html>