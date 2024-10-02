document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('topup-form');
    const alertMessage = document.getElementById('alert-message');
    const paymentMethods = document.getElementsByName('payment_method');
    const paypalDetails = document.getElementById('paypal-details');

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
    form.addEventListener('submit', function (event) {
        // Clear previous alert messages
        alertMessage.style.display = 'none'; // Hide alert message initially
        alertMessage.innerHTML = ''; // Clear alert message text

        const amount = document.getElementById('amount').value;
        const name = document.getElementById('name').value.trim();
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        // Validate top-up amount
        if (amount < 1) {
            alertMessage.innerHTML += 'Please enter a valid top-up amount.<br>'; // Append error message
            alertMessage.style.display = 'block'; // Show the alert message
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Validate name
        if (name === '') {
            alertMessage.innerHTML += 'Please enter your name.<br>'; // Append error message
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
        alertMessage.style.color = 'green'; // Change message color to green for success
        alertMessage.innerHTML = 'Payment details submitted successfully! Thank you for topping up your account. If you top up by cash, please come to my (Rachel Ng) house as stated in the location on the homepage when you are available and transfer your payment to me (Rachel Ng)! Your amount balance will be updated once your payment is submitted!'; // Success message
        alertMessage.style.display = 'block'; // Show the alert message
    });
});


      