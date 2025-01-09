function updateAccount() {
   const formData = new FormData();
formData.append("newName", name);
formData.append("newDOB", dob);
formData.append("newAddress", address);
formData.append("newIC", ic);
formData.append("newWorkplace", workplace);
formData.append("newReligion", religion);
formData.append("newTelNo", telNo);
formData.append("newEmail", email);
formData.append("newOccupation", occupation);
    // Display updated details
    for (let key in details) {
        document.getElementById(`display${key.charAt(0).toUpperCase() + key.slice(1)}`).innerText = details[key] || "Nil";
    }

    // Prevent page reload (if you're not using form submission)
    return false;
}
