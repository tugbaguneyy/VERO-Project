<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <h1>Task List</h1>

    <!-- search box and image modal -->

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search in tasks..." onkeyup="searchTable()" style="flex: 1; margin-right: 10px;">
        <button id="openModalBtn">Upload Image</button>
    </div>

   <!-- image modal -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Upload Image</h2>
        
        <!-- Image Upload Form -->
        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            <input type="file" id="imageInput" name="image" accept="image/*">
            <button type="submit" id="saveImageBtn">Kaydet</button>
        </form>

        <div id="imagePreview"></div>
    </div>
</div>

    <!-- Task Table -->
    <table id="tasksTable">
        <thead>
            <tr>
                <th>Task</th>
                <th>Header</th>
                <th>Description</th>
                <th>Color Code</th>
            </tr>
        </thead>
        <tbody>
            <!-- js -->
        </tbody>
    </table>



<script src="script.js"></script>
</body>
</html>
