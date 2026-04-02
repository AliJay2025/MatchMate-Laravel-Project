// Client-side validation for MatchMate forms
document.addEventListener('DOMContentLoaded', function() {
    
    // Player Form Validation
    const playerForm = document.querySelector('form[action*="players"]');
    if (playerForm) {
        playerForm.addEventListener('submit', function(e) {
            let isValid = true;
            const name = document.querySelector('input[name="name"]');
            const teamId = document.querySelector('select[name="team_id"]');
            
            // Clear previous errors
            clearErrors(playerForm);
            
            // Validate player name
            if (!name.value.trim()) {
                showError(name, 'Player name is required');
                isValid = false;
            } else if (name.value.trim().length < 2) {
                showError(name, 'Player name must be at least 2 characters');
                isValid = false;
            }
            
            // Validate team selection
            if (teamId && !teamId.value) {
                showError(teamId, 'Please select a team');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
    
    // Registration Form Validation
    const registerForm = document.querySelector('form[action*="register"]');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            const name = document.querySelector('input[name="name"]');
            const email = document.querySelector('input[name="email"]');
            const password = document.querySelector('input[name="password"]');
            const passwordConfirm = document.querySelector('input[name="password_confirmation"]');
            
            clearErrors(registerForm);
            
            // Validate name
            if (!name.value.trim()) {
                showError(name, 'Name is required');
                isValid = false;
            } else if (name.value.trim().length < 2) {
                showError(name, 'Name must be at least 2 characters');
                isValid = false;
            }
            
            // Validate email
            const emailPattern = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
            if (!email.value.trim()) {
                showError(email, 'Email is required');
                isValid = false;
            } else if (!emailPattern.test(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }
            
            // Validate password
            if (!password.value) {
                showError(password, 'Password is required');
                isValid = false;
            } else if (password.value.length < 8) {
                showError(password, 'Password must be at least 8 characters');
                isValid = false;
            }
            
            // Validate password confirmation
            if (password.value !== passwordConfirm.value) {
                showError(passwordConfirm, 'Passwords do not match');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
    
    // Team Form Validation
    const teamForm = document.querySelector('form[action*="teams"]');
    if (teamForm) {
        teamForm.addEventListener('submit', function(e) {
            let isValid = true;
            const name = document.querySelector('input[name="name"]');
            
            clearErrors(teamForm);
            
            if (!name.value.trim()) {
                showError(name, 'Team name is required');
                isValid = false;
            } else if (name.value.trim().length < 2) {
                showError(name, 'Team name must be at least 2 characters');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
});

// Helper functions for validation
function showError(input, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-red-600 text-sm mt-1';
    errorDiv.innerText = message;
    input.classList.add('border-red-500');
    input.parentNode.appendChild(errorDiv);
}

function clearErrors(form) {
    const errors = form.querySelectorAll('.error-message');
    errors.forEach(error => error.remove());
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => input.classList.remove('border-red-500'));
}