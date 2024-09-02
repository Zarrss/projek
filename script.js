document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const rectangleBox = document.querySelector('.rectangle-box');
    const tableBody = document.getElementById('dataTable').querySelector('tbody');
    const insertBtn = document.getElementById('insertBtn');
    const deactivateBtn = document.getElementById('deactivateBtn');
    const floatingButtons = document.getElementById('floatingButtons');

     // Update the rectangle box based on selected checkboxes
     function updateRectangleBox() {
        rectangleBox.innerHTML = ''; // Clear existing content
        rowCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const row = checkbox.closest('tr');
                const data = {
                    title: row.cells[1].textContent,
                    no_tsrf: row.cells[1].textContent,
                    date: row.cells[2].textContent,
                    target_date: row.cells[3].textContent,
                    work_category: row.cells[4].textContent,
                    divisi: row.cells[5].textContent,
                    costumer: row.cells[6].textContent,
                    end_costumer: row.cells[7].textContent,
                    judul: row.cells[8].textContent,
                    status: row.cells[9].textContent
                };

                const accordion = createAccordion(data);
                rectangleBox.appendChild(accordion);
            }
        });
    }

    // Function to create accordion
    function createAccordion(data) {
        const accordion = document.createElement('div');
        accordion.className = 'accordion';

        const header = document.createElement('div');
        header.className = 'accordion-header';
        header.textContent = data.title;

        const body = document.createElement('div');
        body.className = 'accordion-body';
        body.innerHTML = `
            <p>TSF: ${data.no_tsrf}</p>
            <p>Date: ${data.date}</p>
            <p>Target Date: ${data.target_date}</p>
            <p>WC: ${data.work_category}</p>
            <p>Divisi: ${data.divisi}</p>
            <p>Customer: ${data.costumer}</p>
            <p>End Customer: ${data.end_costumer}</p>
            <p>Judul: ${data.judul}</p>
            <p>Status: ${data.status}</p>
        `;

        accordion.appendChild(header);
        accordion.appendChild(body);

        header.addEventListener('click', function () {
            body.classList.toggle('active');
        });

        return accordion;
    }

    // Handle checkbox change event for "Select All"
    selectAllCheckbox.addEventListener('change', function () {
        const isChecked = selectAllCheckbox.checked;
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateRectangleBox();
    });

    // Handle individual row checkbox change event
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            updateRectangleBox();
        });
    });

    // Attach event listeners to the table body for actions button using event delegation
    tableBody.addEventListener('click', function (event) {
        if (event.target.closest('.actions-btn')) {
            const button = event.target.closest('.actions-btn');
            const row = button.closest('tr');
            showFloatingButtons(event, floatingButtons);
            event.stopPropagation(); // Prevent click event from hiding the buttons
        }
    });

    // Function to handle showing floating buttons
    function showFloatingButtons(event, floatingButtons) {
        const rect = event.target.getBoundingClientRect();
        const top = rect.top + window.scrollY + rect.height;
        const left = rect.left + window.scrollX - 20; // Adjusted to move slightly to the left

        floatingButtons.style.top = `${top}px`;
        floatingButtons.style.left = `${left}px`;
        floatingButtons.style.display = 'block';
    }

    // Insert button functionality
    insertBtn.addEventListener('click', function () {
        const clickedRow = document.querySelector('.actions-btn')?.closest('tr');

        if (clickedRow) {
            const newRow = document.createElement('tr');

            newRow.innerHTML = `    
                <td class='checkbox-column'><input type='checkbox' class='row-checkbox'></td>
                <td contenteditable='true'></td>
                <td contenteditable='true'></td>
                <td contenteditable='true'></td>
                <td contenteditable='true'></td>
                <td contenteditable='true'></td>
                <td contenteditable='true'></td>    
                <td contenteditable='true'></td>
                <td contenteditable='true'></td>
                <td contenteditable='true'></td>
                <td class='actions-column'>
                    <button class='actions-btn'>
                        <img src='elipses.png' alt='Actions'>
                    </button>
                    <button class='save-btn'>Save</button> <!-- Save button -->
                </td>
            `;

            clickedRow.parentNode.insertBefore(newRow, clickedRow.nextSibling);

            // Attach event listener for the Save button on the new row
            const saveButton = newRow.querySelector('.save-btn');
            saveButton.addEventListener('click', function () {
                console.log('Save button clicked'); // Debugging log
                saveNewRowData(newRow); // Call function to save data
            });

            // Hide floating buttons after insertion
            floatingButtons.style.display = 'none';
        }
    });

    // Function to save new row data
    function saveNewRowData(newRow) {
        const cells = newRow.querySelectorAll('td[contenteditable]');
        const data = {
            no_tsrf: cells[0].innerText,
            date: cells[1].innerText,
            target_date: cells[2].innerText,
            work_category: cells[3].innerText,
            divisi: cells[4].innerText,
            costumer: cells[5].innerText,
            end_costumer: cells[6].innerText,
            judul: cells[7].innerText,
            status: cells[8].innerText
        };

        console.log('Data to save:', data); // Debugging log

        // Send data to the server to be saved
        fetch('insert_row.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Data saved successfully!');
                    console.log('Save response:', data); // Debugging log
                } else {
                    alert('Failed to save data.');
                    console.error('Save failed:', data); // Debugging log
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Deactivate button functionality
        document.getElementById('deactivateBtn').addEventListener('click', function() {
        // Mengambil semua kolom dengan class 'deactivate-column'
        var columns = document.querySelectorAll('.deactivate-column');
        
        // Menyembunyikan kolom
        columns.forEach(function(column) {
            column.style.display = 'none';
        });
        
        // Menyembunyikan sel pada setiap baris
        var rows = document.querySelectorAll('#dataTable td');
        rows.forEach(function(cell) {
            if (cell.classList.contains('deactivate-column')) {
                cell.style.display = 'none';
            }
        });
    });
});