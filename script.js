/*document.addEventListener('DOMContentLoaded', function() {
    // Add event listener for the "Export to Excel" button
    const excelButton = document.querySelector('.excel-submit');
    if (excelButton) {
        excelButton.addEventListener('click', exportToExcel);
    } else {
        console.error('Export to Excel button not found');
    }

    // Function to export form data to Excel
    function exportToExcel() {
        const form = document.querySelector('#dataForm');
        if (!form) {
            console.error('Form not found!');
            return;
        }

        // Collect form data
        const inputs = form.querySelectorAll('input, select');
        const formData = {};

        inputs.forEach(input => {
            if (input.name) {
                formData[input.name] = input.value;
            }
        });

        // Create a worksheet and workbook
        const ws = XLSX.utils.json_to_sheet([formData]);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

        // Write to file
        XLSX.writeFile(wb, "FormData.xlsx");
    }*/
document.addEventListener('DOMContentLoaded', function() {
    const dataForm = document.getElementById('dataForm');
    const pdfForm = document.getElementById('pdfForm');
    const excelForm = document.getElementById('excelForm');

    function populateHiddenFields() {
        const fields = dataForm.querySelectorAll('input, select');
        fields.forEach(field => {
            const hiddenField = pdfForm.querySelector(`#pdf${field.name}`);
            if (hiddenField) {
                hiddenField.value = field.value;
            }
        });
    }

    // Add event listeners to update hidden fields when forms are submitted
    dataForm.addEventListener('submit', populateHiddenFields);
    pdfForm.addEventListener('submit', populateHiddenFields);
    excelForm.addEventListener('submit', populateHiddenFields);
});


    // Add event listener for the "Save as PDF" button
    const pdfButton = document.querySelector('.pdf-submit');
    if (pdfButton) {
        pdfButton.addEventListener('click', function() {
            const form = document.querySelector('#dataForm');
            if (!form) {
                console.error('Form not found!');
                return;
            }

            document.getElementById('pdfTKno').value = document.querySelector('input[name="TKno"]').value;
            document.getElementById('pdfObservations').value = document.querySelector('input[name="Observations"]').value;
            document.getElementById('pdfWO').value = document.querySelector('input[name="WO"]').value;
            document.getElementById('pdfStatus').value = document.querySelector('input[name="Status"]').value;
            document.getElementById('pdfTypeofdefects').value = document.querySelector('input[name="Typeofdefects"]').value;
            document.getElementById('pdfAssignedto').value = document.querySelector('input[name="Assignedto"]').value;
            document.getElementById('pdfLastmonthchecked').value = document.querySelector('input[name="Lastmonthchecked"]').value;
            document.getElementById('pdfNextDuedate').value = document.querySelector('input[name="NextDuedate"]').value;
            document.getElementById('pdfTestedBy').value = document.querySelector('input[name="TestedBy"]').value;
            document.getElementById('pdfETC').value = document.querySelector('input[name="ETC"]').value;
            document.getElementById('pdfTypeoftank').value = document.querySelector('select[name="Typeoftank"]').value;
            document.getElementById('pdfTankservice').value = document.querySelector('input[name="Tankservice"]').value;
            document.getElementById('pdfPetroleumclass').value = document.querySelector('select[name="Petroleumclass"]').value;
        });
    } else {
        console.error('PDF button not found');
    }

  

