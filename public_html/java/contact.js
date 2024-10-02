/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/JavaScript.js to edit this template
 */

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form-container form");
    
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the values from the form fields
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const subject = document.getElementById("subject").value;
        const message = document.getElementById("message").value;

        // Simple validation
        if (!name || !email || !subject || !message) {
            alert("Please fill in all fields.");
            return;
        }

        // Example of what you could do with the form data:
        // For demonstration, we are logging it to the console
        console.log("Form submitted successfully!");
        console.log(`Name: ${name}`);
        console.log(`Email: ${email}`);
        console.log(`Subject: ${subject}`);
        console.log(`Message: ${message}`);

        // Display success message
        alert("Your message has been sent successfully! Please wait for the boss to reply! ");

        // Optionally clear the form fields after submission
        form.reset();
    });
});

