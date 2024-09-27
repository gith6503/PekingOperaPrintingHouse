// Get the form and attach an event listener for the submit event
document.getElementById('orderForm').addEventListener('submit', function(event) {
    // Prevent the form from being submitted immediately
    event.preventDefault();

    // Collect form fields
    const fileInput = document.getElementById('file');
    const amountInput = document.getElementById('amount');
    const bindingInput = document.getElementById('binding');
    const shapeInput = document.getElementById('shape');

    // Array to store error messages
    let errorMessages = [];

    // Validate File Input
    if (!fileInput.value) {
        errorMessages.push('Please select a file to upload.');
    }

    // Validate Quantity (Amount) Input
    if (amountInput.value <= 0) {
        errorMessages.push('Please enter a valid quantity greater than 0.');
    }

    // Custom validation for Sticker Shape and Binding Type
    if (shapeInput.value !== 'nil' && bindingInput.value === 'nil') {
        errorMessages.push('If you are printing stickers, please select a binding type.');
    }

    // If there are any error messages, display them
    if (errorMessages.length > 0) {
        alert(errorMessages.join('\n'));
    } else {
        // If validation passed, allow form submission
        alert('Form submitted successfully! Please check your printing status on the track-job page and come to my house and collect your documents after 3 days!');
        event.target.submit(); // Submit the form
    }
});

       