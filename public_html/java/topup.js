document.addEventListener('DOMContentLoaded', function () {
    const paymentMethods = document.getElementsByName('payment_method');
    const paypalDetails = document.getElementById('paypal-details');
    const alertMessage = document.getElementById('alert-message'); // Alert message container

    // Add event listener for payment method selection
    paymentMethods.forEach(method => {
        method.addEventListener('change', function () {
            if (this.value === 'paypal') {
                paypalDetails.style.display = 'block'; // Show PayPal email input
            } else {
                paypalDetails.style.display = 'none'; // Hide PayPal email input
            }
        });
    });

    // Add an event listener for form submission to validate the inputs
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        // Clear previous alert messages
        alertMessage.style.display = 'none'; // Hide alert message initially
        alertMessage.innerHTML = ''; // Clear alert message text

        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const amount = document.getElementById('amount').value;

        // Validate top-up amount
        if (amount < 1) {
            alertMessage.innerHTML += 'Please enter a valid top-up amount.<br>'; // Append error message
            alertMessage.style.display = 'block'; // Show the alert message
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Validate PayPal email if PayPal is selected
        if (paymentMethod === 'paypal') {
            const paypalEmail = document.getElementById('paypal_email').value.trim();
            if (paypalEmail === '') {
                alertMessage.innerHTML += 'Please enter your PayPal email.<br>'; // Append error message
                alertMessage.style.display = 'block'; // Show the alert message
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Simple email format validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(paypalEmail)) {
                alertMessage.innerHTML += 'Please enter a valid PayPal email.<br>'; // Append error message
                alertMessage.style.display = 'block'; // Show the alert message
                event.preventDefault(); // Prevent form submission
                return;
            }
        }

        // Allow form submission if all validations pass
        alert('Payment details submitted successfully! If you top up by cash, please come to Peking Opera Printing house as stated in the location on the homepage when you are available and transfer your payment to me (Rachel Ng)! Your amount balance will be updated once your payment is submitted!');
    });
});
