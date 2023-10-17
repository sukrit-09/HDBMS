// Function to update the preview section with form data and show it
function showPreview(event) {
    event.preventDefault(); // Prevent form submission

    // Define an object to map form field IDs to their corresponding preview paragraph IDs
    const fieldMapping = {
        doctor_name: "preview_doctor_name",
        admission_date: "preview_admission_date",
        planned_procedure: "preview_planned_procedure",
        patient_name: "preview_patient_name",
        date_of_birth: "preview_date_of_birth",
        parent_name: "preview_parent_name",
        gender: "preview_gender",
        marital_status: "preview_marital_status",
        employment_status: "preview_employment_status",
        phone_number: "preview_phone_number",
        emergency_phone_number: "preview_emergency_phone_number",
        email: "preview_email",
        address: "preview_address",
    };

    // Update the preview section with form data
    for (const field in fieldMapping) {
        const fieldValue = document.getElementById(field).value;
        document.getElementById(fieldMapping[field]).textContent = fieldValue;
    }

    // Show the preview section
    document.getElementById("admission-form-preview").style.display = "block";
}

// Function to print the preview
function printPreview() {
    const printContents = document.getElementById("admission-form-preview").innerHTML;
    const originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
