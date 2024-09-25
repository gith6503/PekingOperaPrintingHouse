document.addEventListener("DOMContentLoaded", function () {
    const orderForm = document.getElementById("orderForm");

    orderForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission behavior

        // Get form field values
        const fileInput = document.getElementById("file").files;
        const color = document.getElementById("color").value;
        const sides = document.getElementById("sides").value;
        const paperType = document.getElementById("papertype").value;
        const shape = document.getElementById("shape").value;

        // Validate file input
        if (fileInput.length === 0) {
            alert("Please select a file to print.");
            return;
        }

        // Show a confirmation message (can be customized)
        if (confirm("Are you sure you want to submit this print order?")) {
            // Simulate form submission or file upload
            submitOrder({
                file: fileInput[0].name,
                color: color,
                sides: sides,
                paperType: paperType,
                shape: shape,
            });
        }
    });

    function submitOrder(orderDetails) {
        // Simulate form submission or print order processing
        console.log("Order details:", orderDetails);
        
        // Display order submission confirmation
        alert("Order submitted successfully! Your document will be ready after 3 days! ");

        // Reset the form after submission
        orderForm.reset();
    }
});