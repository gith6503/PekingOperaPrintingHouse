// trackjob.js

document.addEventListener('DOMContentLoaded', function () {
    // Add an event listener to the form
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function (event) {
        // Prevent the form from submitting the traditional way
        event.preventDefault();

        // Get the Job ID entered by the user
        const jobIdInput = document.getElementById('job_id');
        const jobId = jobIdInput.value;

        // Check if the Job ID is valid (simple validation)
        if (jobId.trim() === '') {
            alert('Please enter a valid Job ID.');
            return;
        }

        // Display a message (in real use-case, you would send this to a server to fetch the job status)
        alert('Your Job is pending!');

      
        
    });
});
