// script.js

// Function to update account details
function updateAccount() {
    // Get the new name entered by the user
    const newName = document.getElementById('newName').value;

    // Check if the input field is empty
    if (newName.trim() === '') {
        alert('Please enter a valid name.');
        return;
    }

    // Update the displayed name
    document.getElementById('userName').innerText = newName;

    // Optionally, you could store this information in local storage to persist it between sessions
    // localStorage.setItem('userName', newName);
    
    // Clear the input field after updating
    document.getElementById('newName').value = '';

    // Display a message to the user
    alert('Account details updated successfully!');
}

// If you'd like to retrieve the saved name from local storage (if applicable), you can use the following code:
// This would load the stored name when the page is refreshed
document.addEventListener('DOMContentLoaded', function () {
    const savedName = localStorage.getItem('userName');
    if (savedName) {
        document.getElementById('userName').innerText = savedName;
    }
});
