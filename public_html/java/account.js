function updateAccount() {
    // Get the input values
    let name = document.getElementById("newName").value.trim();
    let dob = document.getElementById("newDOB").value;
    let sex = document.getElementById("size").value;
    let address = document.getElementById("newAddress").value.trim();
    let icNumber = document.getElementById("newIC").value.trim();
    let workplace = document.getElementById("newWorkplace").value.trim();
    let religion = document.getElementById("newReligion").value.trim();
    let telNo = document.getElementById("newTelNo").value.trim();
    let email = document.getElementById("newEmail").value.trim();
    let occupation = document.getElementById("newOccupation").value.trim();
    
    // Perform validation for empty fields
    if (!name || !dob || !address || !icNumber || !workplace || !religion || !telNo || !email || !occupation) {
        alert("Please fill in all required fields.");
        return;
    }

    // Update the displayed account details
    document.getElementById("displayName").innerText = name;
    document.getElementById("displayDOB").innerText = dob;
    document.getElementById("displaySex").innerText = sex;
    document.getElementById("displayAddress").innerText = address;
    document.getElementById("displayIC").innerText = icNumber;
    document.getElementById("displayWorkplace").innerText = workplace;
    document.getElementById("displayReligion").innerText = religion;
    document.getElementById("displayTelNo").innerText = telNo;
    document.getElementById("displayEmail").innerText = email;
    document.getElementById("displayOccupation").innerText = occupation;

    alert("Account updated successfully! Please check your account details below!");
}

function toggleRole() {
    const roleButton = document.getElementById('roleButton');

    // Check if the element is found
    if (roleButton) {
        // Toggle button text between "Boss" and "Customer"
        if (roleButton.innerHTML.trim() === "Boss") {
            roleButton.innerHTML = "Customer";
            alert('Switched to Customer Mode');
        } else {
            roleButton.innerHTML = "Boss";
            alert('Switched to Boss Mode');
        }
    } else {
        console.error("Button with ID 'roleButton' not found.");
    }
}
