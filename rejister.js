// script.js

// Function to handle form submission
function handleFormSubmission(event) {
    event.preventDefault(); // Prevent the default form submission behavior
  
    // Get form input values
    const patientName = document.getElementById("patientName").value;
    const contactNumber = document.getElementById("contactNumber").value;
    const email = document.getElementById("email").value;
    const dateOfBirth = document.getElementById("dateOfBirth").value;
    const admissionReason = document.getElementById("admissionReason").value;
  
    // Perform validation or other actions here
  
    // You can also send the form data to a server using AJAX or fetch
  
    // Example: Display an alert with the form data
    alert(`Patient Name: ${patientName}\nContact Number: ${contactNumber}\nEmail: ${email}\nDate of Birth: ${dateOfBirth}\nAdmission Reason: ${admissionReason}`);
  }
  
  // Add a submit event listener to the form
  const form = document.querySelector("form");
  form.addEventListener("submit", handleFormSubmission);
  