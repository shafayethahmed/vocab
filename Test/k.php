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
            background-color: #f0f8ff; /* Light Blue Background */
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #333; /* Dark Sidebar */
            color: #fff;
            width: 250px;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .sidebar h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        .sidebar-link {
            color: #ddd;
            text-decoration: none;
            padding: 10px 0;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .sidebar-link:hover {
            background-color: #555;
        }

        .content-area {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .content-area h1 {
            color: #337ab7; /* Blue Heading */
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #d4d4d4;
            border-radius: 4px;
            background-color: #f9f9f9; /* Light Gray Section Background */
        }

        .section h2 {
            color: #5cb85c; /* Green Section Title */
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 2px solid #5cb85c;
            padding-bottom: 5px;
        }

        .control-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .control-item:last-child {
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
            background-color: #5bc0de; /* Cyan Toggle */
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #5bc0de;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .icon-activate {
            color: #5cb85c; /* Green Activate Icon */
            font-size: 1.2em;
            margin-left: 10px;
            vertical-align: middle;
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
            background-color: #ddd;
            border-radius: 4px;
        }

        .checkbox-wrapper:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .checkbox-wrapper input:checked ~ .checkmark {
            background-color: #5bc0de; /* Cyan Checkbox */
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
            background-color: #5bc0de; /* Cyan Button */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #46b8da;
        }

        .disabled-label {
            color: #777;
            font-style: italic;
            margin-left: 5px;
        }

        /* New Tool Styles */
        .tool-input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .tool-textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            min-height: 80px;
        }

        .color-picker {
            margin-top: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="sidebar">
        <h2>VocaSphere Tools</h2>
        <a href="#" class="sidebar-link">Dashboard</a>
        <a href="#" class="sidebar-link">Page Settings</a>
        <a href="#" class="sidebar-link">Feature Control</a>
        <a href="#" class="sidebar-link">User Management</a>
        <a href="#" class="sidebar-link">Support</a>
        <a href="#" class="sidebar-link">Logout</a>
    </div>

    <div class="content-area">
        <h1>Prelanding Setup & Tools</h1>
        <p>Configure your prelanding pages and access various tools.</p>

        <div class="section">
            <h2>Page Activation</h2>
            <p>Enable or disable prelanding pages.</p>
            <div class="control-item">
                <span>Homepage</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="homepageToggle" checked>
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="homepageIcon"></i>
            </div>
            <div class="control-item">
                <span>About Us</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="aboutUsToggle">
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="aboutUsIcon" style="display:none;"></i>
            </div>
            <div class="control-item">
                <span>Services</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="servicesToggle" checked>
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="servicesIcon"></i>
            </div>
            <div class="control-item">
                <span>Contact Us</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="contactUsToggle">
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-check-circle icon-activate" id="contactUsIcon" style="display:none;"></i>
            </div>
            <div class="control-item">
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
            <p>Select the feature boxes to display.</p>
            <div class="control-item">
                <label class="checkbox-wrapper">
                    Show Testimonials Box
                    <input type="checkbox" id="testimonialsCheckbox" checked>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="control-item">
                <label class="checkbox-wrapper">
                    Show Latest News Box
                    <input type="checkbox" id="newsCheckbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="control-item">
                <label class="checkbox-wrapper">
                    Show Call to Action Box
                    <input type="checkbox" id="ctaCheckbox" checked>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="control-item">
                <label class="checkbox-wrapper">
                    Show Social Media Links Box <span class="disabled-label">(Not Configured)</span>
                    <input type="checkbox" id="socialCheckbox" disabled>
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <div class="section">
            <h2>Announcement Bar Tool</h2>
            <p>Control the display and content of the announcement bar.</p>
            <div class="control-item">
                <span>Enable Announcement Bar</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="announcementToggle">
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-bullhorn icon-activate" id="announcementIcon" style="color: orange; display: none;"></i>
            </div>
            <label for="announcementText">Announcement Text:</label>
            <input type="text" id="announcementText" class="tool-input" placeholder="Enter announcement text">
            <label for="announcementColor">Bar Background Color:</label>
            <input type="color" id="announcementColor" class="color-picker" value="#fceabb">
            <label for="announcementTextColor">Text Color:</label>
            <input type="color" id="announcementTextColor" class="color-picker" value="#333">
        </div>

        <div class="section">
            <h2>SEO Meta Tags Tool</h2>
            <p>Manage meta title and description for SEO.</p>
            <label for="metaTitle">Meta Title:</label>
            <input type="text" id="metaTitle" class="tool-input" placeholder="Enter meta title">
            <label for="metaDescription">Meta Description:</label>
            <textarea id="metaDescription" class="tool-textarea" placeholder="Enter meta description"></textarea>
        </div>

        <div class="section">
            <h2>Custom CSS Tool</h2>
            <p>Add custom CSS to your prelanding pages.</p>
            <label for="customCss">Custom CSS:</label>
            <textarea id="customCss" class="tool-textarea" placeholder="Enter your custom CSS code"></textarea>
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

        // Announcement Bar Toggle
        const announcementToggle = document.getElementById('announcementToggle');
        const announcementIcon = document.getElementById('announcementIcon');

        if (announcementToggle && announcementIcon) {
            announcementToggle.addEventListener('change', function() {
                announcementIcon.style.display = this.checked ? 'inline-block' : 'none';
            });
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
            };

            const announcementSettings = {
                enabled: document.getElementById('announcementToggle').checked,
                text: document.getElementById('announcementText').value,
                backgroundColor: document.getElementById('announcementColor').value,
                textColor: document.getElementById('announcementTextColor').value
            };

            const seoSettings = {
                metaTitle: document.getElementById('metaTitle').value,
                metaDescription: document.getElementById('metaDescription').value
            };

            const customCss = document.getElementById('customCss').value;

            console.log('Page Activation Status:', pageStatuses);
            console.log('Feature Box Activation Status:', boxStatuses);
            console.log('Announcement Bar Settings:', announcementSettings);
            console.log('SEO Meta Tags:', seoSettings);
            console.log('Custom CSS:', customCss);
            alert('Configuration Saved (Check console for status)');

            // In a real application, you would send this data to your backend.
        });
    </script>
</body>
</html>