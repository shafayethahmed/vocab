<?php 
//if password or email are mot fouund in  DB  for login Then Display this Error!
  echo "
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          let alertBox = document.createElement('div');
          alertBox.innerHTML = 'Congratulations! Your account has been created successfully.<br>You can now log in using your email and password';     
          // Styling the alert box
          alertBox.style.position = 'fixed';
          alertBox.style.top = '120px';
          alertBox.style.left = '62%';
          alertBox.style.transform = 'translateX(-50%)';
          alertBox.style.backgroundColor = '#91EE91';
          alertBox.style.color = 'black';
          alertBox.style.padding = '12px 20px';
          alertBox.style.borderRadius = '8px';
          alertBox.style.boxShadow = '0 4px 10px rgba(0,0,0,0.3)';
          alertBox.style.fontSize = '13px';
          alertBox.style.fontWeight = 'bold';
          alertBox.style.textAlign = 'center';
          alertBox.style.zIndex = '1000';
          alertBox.style.opacity = '0';
          alertBox.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
  
          document.body.appendChild(alertBox);
  
          // Fade-in effect
          setTimeout(() => {
              alertBox.style.opacity = '1';
              alertBox.style.transform = 'translateX(-50%) translateY(0)';
          }, 100);
  
          // Fade-out effect after 5 seconds
          setTimeout(() => {
              alertBox.style.opacity = '0';
              alertBox.style.transform = 'translateX(-50%) translateY(-20px)';
              setTimeout(() => {
                  alertBox.remove();
              }, 500);
          }, 5000);
      });
  </script>
  ";
?>