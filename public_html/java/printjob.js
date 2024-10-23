document.getElementById('orderForm').addEventListener('submit', function(event) {
            // Prevent the form from being submitted immediately
            event.preventDefault();

            // Collect form fields
            const fileInput = document.getElementById('file');
            const amountInput = document.getElementById('amount');
            const bindingInput = document.getElementById('binding');
            const shapeInput = document.getElementById('shape');
             const binding = document.getElementById('binding').value;
    const shape = document.getElementById('shape').value;
    const size = document.getElementById('size').value;

            // Array to store error messages
            let errorMessages = [];

            // Validate File Input
            const allowedExtensions = /(\.jpg|\.png|\.pdf)$/i;
            const filePath = fileInput.value;

            if (!filePath) {
                errorMessages.push('Please select a file to upload.');
            } else if (!allowedExtensions.exec(filePath)) {
                errorMessages.push('Invalid file type. Please upload a .jpg, .png, or .pdf file.');
                fileInput.value = ''; // Clear the file input
            }

            // Validate Quantity (Amount) Input
            if (amountInput.value <= 0) {
                errorMessages.push('Please enter a valid quantity greater than 0.');
            }


            // If there are any error messages, display them
            if (errorMessages.length > 0) {
                alert(errorMessages.join('\n'));
            } else {
                // If validation passed, allow form submission
                alert('Form submitted successfully! Please check your printing status on the track-job page and come to Peking Opera Printing House and collect your documents after 3 days!');
                event.target.submit(); // Submit the form
            }
        });
        
        //Form submitted successfully! Please check your printing status on the track-job page and come to my house and collect your documents after 3 days!
