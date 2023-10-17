// Function to highlight the searched name in the table
function highlightSearchedName(table, column, searchQuery) {
    const tbody = table.querySelector('tbody');
    const rows = tbody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cell = rows[i].querySelector(`td:nth-child(${column})`);
        const cellText = cell.textContent.toLowerCase();
        const startIndex = cellText.indexOf(searchQuery.toLowerCase());

        if (startIndex !== -1) {
            const matchedText = cellText.substr(startIndex, searchQuery.length);
            const highlightedText = cellText.replace(matchedText, `<span class="highlight">${matchedText}</span>`);
            cell.innerHTML = highlightedText;
        }
    }
}

// Function to remove highlighting from the table
function removeHighlighting(table) {
    const tbody = table.querySelector('tbody');
    const rows = tbody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].querySelectorAll('td');

        for (let j = 0; j < cells.length; j++) {
            const cell = cells[j];
            cell.innerHTML = cell.textContent;
        }
    }
}

// Function to add event listeners for table sorting and highlighting
function addTableListeners(tableId, searchInputId, column) {
    const table = document.querySelector(`#${tableId}`);
    const searchInput = document.querySelector(`#${searchInputId}`);

    if (table && searchInput) {
        const headers = table.querySelectorAll('thead th');

        headers.forEach(header => {
            header.addEventListener('click', () => {
                const column = header.dataset.column;
                const order = header.dataset.order;

                sortTable(table, column, order);
            });
        });

        searchInput.addEventListener('keyup', () => {
            const searchQuery = searchInput.value.trim();
            removeHighlighting(table);

            if (searchQuery !== '') {
                highlightSearchedName(table, column, searchQuery);
            }
        });
    }
}

// Function to sort the table
function sortTable(table, column, order) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const sortedRows = rows.sort((a, b) => {
        const aValue = a.querySelector(`td:nth-child(${column})`).textContent;
        const bValue = b.querySelector(`td:nth-child(${column})`).textContent;

        if (order === 'asc') {
            return aValue.localeCompare(bValue);
        } else {
            return bValue.localeCompare(aValue);
        }
    });

    tbody.innerHTML = '';
    sortedRows.forEach(row => tbody.appendChild(row));
}

// Add table listeners when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    addTableListeners('admitted-patients', 'admitted-patient-search', 2); // Assuming the name is in the second column (index 2)
    addTableListeners('appointments', 'appointment-search', 2); // Assuming the name is in the second column (index 2)
});

// Function to handle form submission and display preview
document.getElementById("admissionForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission
    displayAdmissionFormPreview();
});

// Function to handle form submission and display preview
document.getElementById("admissionForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission
    displayAdmissionFormPreview();
});

// Function to display the admission form preview
function displayAdmissionFormPreview() {
    const form = document.getElementById("admissionForm");
    const previewSection = document.getElementById("admission-form-preview");
    const previewContent = document.getElementById("preview-content");

    // Generate the preview content based on the form data
    const previewHTML = `
        <p><strong>Full Name:</strong> ${form["patient_name"].value}</p>
        <p><strong>Age:</strong> ${form["patient_age"].value}</p>
        <p><strong>Gender:</strong> ${form["patient_gender"].value}</p>
        <p><strong>Admission Date:</strong> ${form["admission_date"].value}</p>
        <p><strong>Email:</strong> ${form["contact_email"].value}</p>
        <p><strong>Phone Number:</strong> ${form["contact_phone"].value}</p>
        <!-- Include additional form fields here -->
        <h2>Medical Information</h2>
        <p><strong>Symptoms:</strong></p>
        <p>${form["symptoms"].value}</p>
        <p><strong>Medical History:</strong></p>
        <p>${form["medical_history"].value}</p>
        <p><strong>Insurance Information:</strong></p>
        <p>${form["insurance_info"].value}</p>
        <!-- You can customize the preview format as needed -->
    `;

    // Display the preview content
    previewContent.innerHTML = previewHTML;
    previewSection.style.display = "block";
}

// Function to handle the "Print" button
document.getElementById("print-button").addEventListener("click", function () {
    const previewSection = document.getElementById("admission-form-preview");

    // Hide the print button in the print view
    const printCSS = `
        <style>
            #print-button {
                display: none;
            }
        </style>
    `;

    const printWindow = window.open("", "_blank");
    printWindow.document.open();
    printWindow.document.write('<html><head>' + printCSS + '</head><body onload="window.print()">' + previewSection.innerHTML + '</body></html>');
    printWindow.document.close();
});
