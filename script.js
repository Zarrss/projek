document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const rectangleBox = document.querySelector('.rectangle-box');

    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            updateRectangleBox();
        });
    });

    selectAllCheckbox.addEventListener('change', function () {
        const isChecked = selectAllCheckbox.checked;
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateRectangleBox();
    });

    function updateRectangleBox() {
        rectangleBox.innerHTML = '';
        const checkedRows = document.querySelectorAll('.row-checkbox:checked');

        checkedRows.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const cells = row.querySelectorAll('td');

            const accordionItem = `
                <div class="accordion">
                    <div class="accordion-header">TSRF No: ${cells[1].innerText} | ${cells[7].innerText}</div>
                    <div class="accordion-body">
                        <p>Date: ${cells[2].innerText}</p>
                        <p>Target Date: ${cells[3].innerText}</p>
                        <p>Work Category: ${cells[4].innerText}</p>
                        <p>Divisi: ${cells[5].innerText}</p>
                        <p>Customer: ${cells[6].innerText}</p>
                        <p>End Customer: ${cells[7].innerText}</p>
                        <p>Status: ${cells[9].innerText}</p>
                    </div>
                </div>
            `;
            rectangleBox.insertAdjacentHTML('beforeend', accordionItem);
        });

        const accordionHeaders = document.querySelectorAll('.accordion-header');
        accordionHeaders.forEach(header => {
            header.addEventListener('click', function () {
                const body = this.nextElementSibling;
                body.classList.toggle('active');
            });
        });
    }

    document.querySelectorAll('.editable-table td[contenteditable]').forEach(cell => {
        cell.addEventListener('blur', function () {
            const row = this.closest('tr');
            const id = row.dataset.rowId;
            const columnIndex = this.cellIndex;
            const newValue = this.innerText;
    
            const columns = [
                'no_tsrf', 'date', 'target_date', 'work_category', 'divisi',
                'costumer', 'end_costumer', 'judul', 'status'
            ];

            // Adjust index for editable columns (starting from columnIndex 1)
            const columnName = columns[columnIndex - 1];
    
            if (columnName) {
                fetch('update_table.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        column: columnName,
                        value: newValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Update successful');
                    } else {
                        console.error('Update failed');
                    }
                })
                .catch(error => console.error('Error:', error));
            } else {
                console.error('Invalid column index');
            }
        });
    });

    document.getElementById('insertButton').addEventListener('click', function() {
        var tableBody = document.querySelector('#dataTable tbody');
        var newRow = document.createElement('tr');

        for (var i = 0; i < 10; i++) {
            var newCell = document.createElement('td');
            var inputField = document.createElement('input');
            inputField.setAttribute('type', 'text');
            inputField.classList.add('form-control');
            newCell.appendChild(inputField);
            newCell.contentEditable = true;
            newRow.appendChild(newCell);
        }

        tableBody.appendChild(newRow);
    });
});
