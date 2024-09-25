// script.js

document.addEventListener('DOMContentLoaded', function () {
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
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const amount = document.getElementById('amount').value;

        // Validate top-up amount
        if (amount < 1) {
            alert('Please enter a valid top-up amount.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Validate PayPal email if PayPal is selected
        if (paymentMethod === 'paypal') {
            const paypalEmail = document.getElementById('paypal_email').value.trim();
            if (paypalEmail === '') {
                alert('Please enter your PayPal email.');
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Simple email format validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(paypalEmail)) {
                alert('Please enter a valid PayPal email.');
                event.preventDefault(); // Prevent form submission
                return;
            }
        }

        // Allow form submission if all validations pass
        alert('Payment details submitted successfully!');
    });
});

