document.addEventListener('DOMContentLoaded', function() {
    // Get form element
    const contactForm = document.querySelector('form');

    // Add event listener to handle form submission
    contactForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get form field values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        // Initialize an empty array to hold error messages
        let errorMessages = [];

        // Validate name (required)
        if (name === '') {
            errorMessages.push('Please enter your name.');
        }

        // Validate email (required and basic email format)
        if (email === '') {
            errorMessages.push('Please enter your email address.');
        } else if (!validateEmail(email)) {
            errorMessages.push('Please enter a valid email address.');
        }

        // Validate subject (required)
        if (subject === '') {
            errorMessages.push('Please enter a subject.');
        }

        // Validate message (required)
        if (message === '') {
            errorMessages.push('Please enter your message.');
        }

        // Display error messages if any, or submit the form
        if (errorMessages.length > 0) {
            alert(errorMessages.join('\n'));
        } else {
            alert('Your message has been sent successfully! Please wait for the boss to reply!');
            contactForm.reset(); // Clear the form
        }
    });

    // Function to validate email format
    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
});
