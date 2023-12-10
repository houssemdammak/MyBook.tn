<?php

require_once '..\..\controllers\ControllerDashboard.php';
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['editCategoryID'])) {
    $editCategoryID = $_POST['editCategoryID'];
    $editCategoryName = $_POST['editCategoryName'];
    $controller->UpdateCategory($editCategoryID, $editCategoryName);
    //var_dump($editDiscount,$editCategoryID,$editCategoryName);
    //exit();
}
//var_dump($_POST);
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['addCategoryName'])) {
    $addCategoryName = $_POST["addCategoryName"];
    $addDiscount = $_POST["addDiscount"];
    $controller->AddCategory($addCategoryName);


    //var_dump($editDiscount,$editCategoryID,$editCategoryName);
    //exit();
}
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['CategoryIDtodelete'])) {
    $CategoryID = $_POST["CategoryIDtodelete"];

    $controller->DeleteCategory($CategoryID);

    //var_dump($editDiscount,$editCategoryID,$editCategoryName);
    //exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <script src="../../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../assets/js/popper.min.js"></script>
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/xhr.js" type="text/javascript"></script>
	<link rel="icon" href="../../../assets/images/icon.png" type="image/x-icon"/>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../../assets/css/dashboard.css">

    <script src="https://kit.fontawesome.com/df57f43f75.js" crossorigin="anonymous"></script>


</head>

<body>
<style>
    .content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .title {
            flex-basis: 50%;
            /* Ajuster la largeur du titre */
        }

        .image-container {
            flex-basis: 45%;
            /* Ajuster la largeur de l'image */
            text-align: right;
            margin-top: 20px;
        }

        .image-container img {
            max-width: 100%;
            /* Ajuster la largeur de l'image pour rester dans son conteneur */
            height: auto;

        }
</style>
    <div id="tableJdida">
        <main class="tableau1" style="width: 850px;">
        <div class="content-wrapper">
                <div class="title">
                    <h4 id="toggleButton" style="padding: 20px ;">Categories Dashboard <i class="fa-solid fa-caret-down"></i>
                    </h4>
                </div>
                <div class="image-container">
                    <a href="../../../index.php">
                        <img src="../../../assets/images/logo.png" style="width:200px;height:90px"
                            alt="Description de l'image">
                    </a>
                </div>
            </div>
            <section class="tableau1__header">
              
                <button style="padding: 10px ;margin:10px;background-color:#dbcc8f"
                    class="btn btn-ajouter-produit">Ajouter Category</button>

           
                <div class="container" id="scrollContainer">
                    <ul>
                        <li><a href="booksTable.php">Books</a></li>
                        <li><a href="categoriesTable.php">Categories</a> </li>
                        <li><a href="promotionsTable.php">Promotions</a></li>
                        <li><a href="usersTable.php">Users</a></li>
                        <li><a href="commandeTable.php">Orders </a></li>
                        <li><a href="contactUs.php">Contacts </a></li>


                    </ul>
                </div>


                <!-- <div class="input-group">
                    <input type="search" placeholder="Search Data...">
                </div> -->
            </section>

            <section class="tableau1__body">
                <table>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($categories as $category) {


                           // echo "<td>".$category['Category ID']."</td>";
                            echo "<td>".$category['Category Name']."</td>";

                            echo '<td style="width: 200px;">
                            <a href="#" class="edit" title="Edit" data-toggle="modal" data-target="#editModal" onclick="fillEditModal(\'' . $category['Category ID'] . '\', \'' .$category['Category Name']. '\')">
                            <i class="material-icons" style="color:#dbcc8f">&#xE254;</i></a>
                            <a href="#" onclick="deleteCategory(\''. $category['Category ID'] .'\')">
                            <i class="material-icons" style="color:#dbcc8f">&#xE872;</i></a> 
									</td>';
                            echo '</tr>';

                         
                        }
                        ?>

                    </tbody>
                </table>
            </section>

        </main>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for editing promotion -->
                            <form id="editForm">
                                <div class="form-group">
                                    <label for="editCategoryName">Category Name</label>
                                    <input type="text" class="form-control" id="editCategoryName"
                                        name="editCategoryName">
                                </div>
                                
                                <input type="hidden" id="editCategoryID" name="editCategoryID">
                                <button type="button" style="padding: 10px ;margin:10px;background-color:#dbcc8f"  class="btn" onclick="submitEditForm()">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Add Promotion Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding promotion -->
                    <form id="addForm">
                        <div class="form-group">
                            <label for="addCategoryName">Category Name</label>
                            <input type="text" class="form-control" id="addCategoryName" name="addCategoryName"
                                required>
                        </div>
                        
                        <button type="button" style="padding: 10px ;margin:10px;background-color:#dbcc8f" class="btn" onclick="submitAddForm()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function attachToggleListener() {
            const toggleButton = document.getElementById('toggleButton');
            const scrollContainer = document.getElementById('scrollContainer');

            toggleButton.addEventListener('click', () => {
                scrollContainer.classList.toggle('show');
                if (scrollContainer.classList.contains('show')) {
                    scrollContainer.style.maxHeight = scrollContainer.scrollHeight + 'px';
                    toggleButton.querySelector('i').classList.replace('fa-caret-down', 'fa-caret-up');
                } else {
                    scrollContainer.style.maxHeight = '0';
                    toggleButton.querySelector('i').classList.replace('fa-caret-up', 'fa-caret-down');
                }
            });
        }

        attachToggleListener(); 
        function fillEditModal(categorieID, categorieName) {
            document.getElementById('editCategoryID').value = categorieID;
            document.getElementById('editCategoryName').value = categorieName;
        }
        $(document).ready(function () {
            $(".btn-ajouter-produit").click(function () {
                $("#addModal").modal("show");
            });
        });

        function submitEditForm() {
            // Fetch data from the form
            var categorieID = $("#editCategoryID").val();
            var categorieName = $("#editCategoryName").val();
            

            // AJAX request to send data to ControllerDashboard.php for processing
            $.ajax({
                type: "POST",
                url: "categoriesTable.php",
                data: {
                    editCategoryID: categorieID,
                    editCategoryName: categorieName,
                },
                success: function (response) {
                    // Handle the success response
                    //alert("Function called");
                    location.reload();
                },
                error: function (error) {
                    // Handle the error
                    console.error("Error:", error);
                }
            });
        }
        function submitAddForm() {
            var CategoryName = $("#addCategoryName").val();

            // AJAX request
            $.ajax({
                type: "POST",
                url: "categoriesTable.php", // Remplacez cela par le chemin vers votre script PHP
                data: {
                    addCategoryName: CategoryName,
                },
                success: function (response) {
                   // console.log(promotionName, discount);
                    $("#addModal").modal("hide");
                    location.reload();
                },
                error: function (error) {
                    // Gérez les erreurs ici (par exemple, afficher un message d'erreur)
                    alert("Une erreur s'est produite lors de l'ajout de la promotion.");
                }
            });
        }

        function deleteCategory (code){
            $.ajax({
                type: "POST",
                url: "categoriesTable.php", // Remplacez cela par le chemin vers votre script PHP
                data: {
                    CategoryIDtodelete: code,
                },
                success: function (response) {
                    console.log(code);
                    location.reload();
                },
                error: function (error) {
                    alert("Une erreur s'est produite lors de l'ajout de la promotion.");
                }
            });

        }
    
    </script>

</body>

</html>