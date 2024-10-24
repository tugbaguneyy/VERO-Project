// Start all actions when page loads
window.onload = function() {
    fetchAndUpdateTasks();

    // Select modal and related elements
    const modal = document.getElementById("imageModal");
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModal = document.getElementsByClassName("close")[0];
    const imageInput = document.getElementById("imageInput");
    const imagePreview = document.getElementById("imagePreview");
    const saveImageBtn = document.getElementById("saveImageBtn");

    // open model
    openModalBtn.onclick = function() {
        modal.style.display = "block";
    }

    // close modal
    closeModal.onclick = function() {
        modal.style.display = "none";
    }

    // Close the modal when the user clicks outside the window
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    // save button
    saveImageBtn.onclick = function(event) {
        event.preventDefault();
        const formData = new FormData();
        const file = imageInput.files[0];
        if (file) {
            formData.append("image", file);

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Image saved!");
                    modal.style.display = "none"; 
                    imagePreview.innerHTML = ""; 
                    imageInput.value = ""; 
                } else {
                    alert("An error occurred while saving the image.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        } else {
            alert("Please upload a picture!");
        }
    }
};

// Fetch data every 60 minutes (3600000 ms) and update the table
setInterval(fetchAndUpdateTasks, 3600000);

// Retrieve tasks from fetchData.php and update the table
function fetchAndUpdateTasks() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetchData.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const tasks = JSON.parse(xhr.responseText);
            updateTable(tasks);
        }
    };
    xhr.send();
}

function updateTable(tasks) {
    const tableBody = document.querySelector('#tasksTable tbody');
    tableBody.innerHTML = ''; // clear the table

    tasks.forEach(task => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${task.task}</td>
            <td>${task.title}</td>
            <td>${task.description}</td>
            <!-- Sets the color of the cell according to the color code selected -->
            <td style="background-color: ${task.colorCode};">${task.colorCode}</td>
        `;

        tableBody.appendChild(row);
    });
    // Write log to console when table update process is completed
    console.log('Table updated. Number of tasks:', tasks.length);
}

function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll('#tasksTable tbody tr');

    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        let found = false;

        for (let i = 0; i < cells.length; i++) {
            if (cells[i].textContent.toLowerCase().includes(filter)) {
                found = true;
                break;
            }
        }

        if (found) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
