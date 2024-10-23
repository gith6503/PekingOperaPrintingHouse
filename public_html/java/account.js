// account.js

function updateAccount() {
    // Get the input values
    let name = document.getElementById("newName").value.trim();
    let dob = document.getElementById("newDOB").value;
    let sex = document.getElementById("size").value;
    let age = document.getElementById("newAge").value.trim();
    let address = document.getElementById("newAddress").value.trim();
    let icNumber = document.getElementById("newIC").value.trim();
    let workplace = document.getElementById("newWorkplace").value.trim();
    let religion = document.getElementById("newReligion").value.trim();
    let height = document.getElementById("newHeight").value.trim();
    let weight = document.getElementById("newWeight").value.trim();
     let SugarLevel = document.getElementById("newSugarLevel").value.trim();
     let PressureLevel = document.getElementById("newPressureLevel").value.trim();
    let occupation = document.getElementById("newOccupation").value.trim();
    
    // Perform validation for empty fields
    if (!name || !dob || !age || !address || !icNumber || !workplace || !religion || !height || !weight || !SugarLevel || !PressureLevel || !occupation) {
        alert("Please fill in all required fields.");
        return;
    }
    
    // Validate age, height, and weight to ensure they are numbers and reasonable values
    if (isNaN(age) || age <= 0 || age > 120) {
        alert("Please enter a valid age.");
        return;
    }
    if (isNaN(height) || height <= 0) {
        alert("Please enter a valid height in cm.");
        return;
    }
    if (isNaN(weight) || weight <= 0) {
        alert("Please enter a valid weight in kg.");
        return;
    }

    // Update the displayed account details
    document.getElementById("displayName").innerText = name;
    document.getElementById("displayDOB").innerText = dob;
    document.getElementById("displaySex").innerText = sex;
    document.getElementById("displayAge").innerText = age;
    document.getElementById("displayAddress").innerText = address;
    document.getElementById("displayIC").innerText = icNumber;
    document.getElementById("displayWorkplace").innerText = workplace;
    document.getElementById("displayReligion").innerText = religion;
    document.getElementById("displayHeight").innerText = height;
    document.getElementById("displayWeight").innerText = weight;
    document.getElementById("displaySugarLevel").innerText = SugarLevel;
    document.getElementById("displayPressureLevel").innerText = PressureLevel;
    document.getElementById("displayOccupation").innerText = occupation;

    alert("Account updated successfully! Please check your account details below!");
}
