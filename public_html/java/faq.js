/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
function toggleRole() {
    const roleButton = document.getElementById('roleButton');

    // Check if the element is found
    if (roleButton) {
        // Toggle button text between "Boss" and "Customer"
        if (roleButton.innerHTML.trim() === "Boss") {
            roleButton.innerHTML = "Customer";
            alert('Switched to Customer Mode');
        } else {
            roleButton.innerHTML = "Boss";
            alert('Switched to Boss Mode');
        }
    } else {
        console.error("Button with ID 'roleButton' not found.");
    }
}



