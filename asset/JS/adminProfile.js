   // General modal functions
   function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('open');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('open');
}

function openEditProfileModal() {
    openModal('editProfileModal');
    // Pre-fill form with current data
    document.getElementById('edit-name').value = document.getElementById('hero-name').textContent.replace('Administrator', '').trim();
    document.getElementById('edit-email').value = document.getElementById('hero-email').textContent;
}

function openChangePasswordModal() {
    openModal('changePasswordModal');
    // Reset the form
    document.getElementById('changePasswordForm').reset();
    document.getElementById('passwordStrengthBar').style.width = '0%';
    document.getElementById('passwordStrengthText').textContent = 'Password strength: Not entered';
    document.getElementById('password-match-message').textContent = '';
    document.getElementById('change-password-button').disabled = true;
}

function saveProfileChanges() {
    // In a real application, you would send this data to the server
    const newName = document.getElementById('edit-name').value;
    const newEmail = document.getElementById('edit-email').value;
    const newJoiningDate = document.getElementById('edit-joining-date').value;

    // Update the displayed information (for demonstration)
    document.getElementById('hero-name').textContent = newName + ' ';
    const adminBadge = document.createElement('span');
    adminBadge.className = 'admin-badge';
    adminBadge.textContent = 'Administrator';
    document.getElementById('hero-name').appendChild(adminBadge);
    
    document.getElementById('hero-email').textContent = newEmail;

    closeModal('editProfileModal');
    alert('Profile changes saved (demonstration only).');
}

// Profile picture preview function
function previewProfilePicture(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('hero-profile-picture').src = e.target.result;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Password strength checker
function checkPasswordStrength() {
    const password = document.getElementById('new-password').value;
    let strength = 0;
    let strengthText = '';
    
    if (password.length === 0) {
        strength = 0;
        strengthText = 'Not entered';
    } else if (password.length < 8) {
        strength = 1;
        strengthText = 'Very weak';
    } else {
        // Add points for complexity
        if (password.length >= 8) strength += 1;
        if (password.match(/[A-Z]/)) strength += 1;
        if (password.match(/[a-z]/)) strength += 1; 
        if (password.match(/[0-9]/)) strength += 1;
        if (password.match(/[^A-Za-z0-9]/)) strength += 1;
        
        // Determine text based on strength score
        if (strength <= 2) strengthText = 'Weak';
        else if (strength <= 3) strengthText = 'Medium';
        else if (strength <= 4) strengthText = 'Strong';
        else strengthText = 'Very strong';
    }
    
    // Update the UI
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthPercentage = (strength / 5) * 100;
    strengthBar.style.width = `${strengthPercentage}%`;
    
    // Set color based on strength
    if (strength <= 1) strengthBar.style.backgroundColor = '#dc3545'; // Red
    else if (strength <= 3) strengthBar.style.backgroundColor = '#ffc107'; // Yellow
    else strengthBar.style.backgroundColor = '#28a745'; // Green
    
    document.getElementById('passwordStrengthText').textContent = `Password strength: ${strengthText}`;
    
    // Check if passwords match and update button state
    checkPasswordsMatch();
}

function checkPasswordsMatch() {
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const matchMessage = document.getElementById('password-match-message');
    const updateButton = document.getElementById('change-password-button');
    
    if (confirmPassword.length === 0) {
        matchMessage.textContent = '';
        updateButton.disabled = true;
        return;
    }
    
    if (newPassword === confirmPassword) {
        matchMessage.textContent = 'Passwords match';
        matchMessage.style.color = '#28a745';
        updateButton.disabled = false;
    } else {
        matchMessage.textContent = 'Passwords do not match';
        matchMessage.style.color = '#dc3545';
        updateButton.disabled = true;
    }
}

function changePassword() {
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    
    // In a real application, you would send this data to the server for validation
    // and password update
    
    // For demonstration purposes
    closeModal('changePasswordModal');
    alert('Password successfully changed (demonstration only).');
}

document.addEventListener('DOMContentLoaded', () => {
    // Add event listeners to close modals when clicking outside
    window.addEventListener('click', (event) => {
        const editModal = document.getElementById('editProfileModal');
        const passwordModal = document.getElementById('changePasswordModal');
        
        if (event.target === editModal) {
            closeModal('editProfileModal');
        }
        
        if (event.target === passwordModal) {
            closeModal('changePasswordModal');
        }
    });
});