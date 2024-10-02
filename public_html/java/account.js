// Show notification
const notification = document.getElementById('notification');
notification.style.display = 'block';

// Hide notification after 3 seconds
setTimeout(() => {
    notification.style.display = 'none';
}, 3000);

// Function to update account details
function updateAccount() {
    // Get the new details entered by the user
    const newName = document.getElementById('newName').value;
    const newDOB = document.getElementById('newDOB').value;
    const newSex = document.getElementById('newSex').value;
    const newAge = document.getElementById('newAge').value;
    const newAddress = document.getElementById('newAddress').value;
    const newIC = document.getElementById('newIC').value;
    const newWorkplace = document.getElementById('newWorkplace').value;
    const newReligion = document.getElementById('newReligion').value;
    const newHeight = document.getElementById('newHeight').value;
    const newWeight = document.getElementById('newWeight').value;
    const newOccupation = document.getElementById('newOccupation').value;

    // Validate input fields
    if (newName.trim() === '') {
        alert('Please enter a valid name.');
        return;
    }
     if (newDOB.trim() === '') {
        alert('Please enter date of birth.');
        return;
    }
    if (newSex.trim() === '') {
        alert('Please enter a valid sex.');
        return;
    }
    if (newAge.trim() === '') {
        alert('Please enter your age.');
        return;
    }
    if (newAddress.trim() === '') {
        alert('Please enter a valid address.');
        return;
    }
    if (newIC.trim() === '') {
        alert('Please enter your IC Number.');
        return;
    }
    if (newWorkplace.trim() === '') {
        alert('Please enter your workplace.');
        return;
    }
    if (newReligion.trim() === '') {
        alert('Please enter your religion.');
        return;
    }
    if (newHeight.trim() === '') {
        alert('Please enter your height.');
        return;
    }
    if (newWeight.trim() === '') {
        alert('Please enter your weight.');
        return;
    }
    if (newOccupation.trim() === '') {
        alert('Please enter your occupation.');
        return;
    }
    // Add validation for other fields...

    // Save all details to local storage
    localStorage.setItem('userName', newName);
    localStorage.setItem('userDOB', newDOB);
    localStorage.setItem('userSex', newSex);
    localStorage.setItem('userAge', newAge);
    localStorage.setItem('userAddress', newAddress);
    localStorage.setItem('userIC', newIC);
    localStorage.setItem('userWorkplace', newWorkplace);
    localStorage.setItem('userReligion', newReligion);
    localStorage.setItem('userHeight', newHeight);
    localStorage.setItem('userWeight', newWeight);
    localStorage.setItem('userOccupation', newOccupation);

    // Display the updated details on the webpage
    document.getElementById('displayName').innerText = `${newName}`;
    document.getElementById('displayDOB').innerText = ` ${newDOB}`;
    document.getElementById('displaySex').innerText = ` ${newSex}`;
    document.getElementById('displayAge').innerText = `${newAge}`;
    document.getElementById('displayAddress').innerText = `${newAddress}`;
    document.getElementById('displayIC').innerText = `${newIC}`;
    document.getElementById('displayWorkplace').innerText = `${newWorkplace}`;
    document.getElementById('displayReligion').innerText = `${newReligion}`;
    document.getElementById('displayHeight').innerText = ` ${newHeight} `;
    document.getElementById('displayWeight').innerText = ` ${newWeight} `;
    document.getElementById('displayOccupation').innerText = ` ${newOccupation}`;
    
    // Display success alert
    alert('Account updated successfully!');

    // Optionally clear the input fields after updating
    document.getElementById('newName').value = '';
    document.getElementById('newDOB').value = '';
    document.getElementById('newSex').value = '';
    document.getElementById('newAge').value = '';
    document.getElementById('newAddress').value = '';
    document.getElementById('newIC').value = '';
    document.getElementById('newWorkplace').value = '';
    document.getElementById('newReligion').value = '';
    document.getElementById('newHeight').value = '';
    document.getElementById('newWeight').value = '';
    document.getElementById('newOccupation').value = '';
}
