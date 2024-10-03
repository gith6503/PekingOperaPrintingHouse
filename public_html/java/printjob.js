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

            // Custom validation for Sticker Shape and Binding Type
         // Check if binding is 'Nil' but sticker shape or size is selected
    if (binding === 'nil' && (shape !== 'nil' || size !== 'nil')) {
        errorMessages.push('If you are not selecting a binding type, you cannot choose a sticker shape or size.');
    }

    // Additional validation if necessary (e.g., checking if shape or size is valid when binding is not Nil)
    if (binding !== 'nil' && (shape === 'nil' || size === 'nil')) {
        errorMessages.push('If you are selecting a binding type, you must select both a sticker shape and size.');
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