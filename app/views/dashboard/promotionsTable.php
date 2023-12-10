<?php

require_once '..\..\controllers\ControllerDashboard.php';
//var_dump($_POST);
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['editPromotionID'])) {
    $editPromotionID = $_POST['editPromotionID'];
    $editPromotionName = $_POST['editPromotionName'];
    $editDiscount = $_POST['editDiscount'];
    $controller->UpdatePromo($editPromotionID, $editPromotionName, $editDiscount);
    //var_dump($editDiscount,$editPromotionID,$editPromotionName);
    //exit();
}
//var_dump($_POST);
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['addPromotionName'])) {
    $addPromotionName = $_POST["addPromotionName"];
    $addDiscount = $_POST["addDiscount"];
    $controller->AddPromo($addPromotionName, $addDiscount);

    //var_dump($editDiscount,$editPromotionID,$editPromotionName);
    //exit();
}
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['promoIDtodelete'])) {
    $promoID = $_POST["promoIDtodelete"];

    $controller->DeletePromo($promoID);

    //var_dump($editDiscount,$editPromotionID,$editPromotionName);
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
    <title>Promotions Dashboard</title>
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
    <div id="tableJdida" >
        <main class="tableau1" style="width: 850px;">
        <div class="content-wrapper">
                <div class="title">
                    <h4 id="toggleButton" style="padding: 20px ;">Promotions Dashboard <i class="fa-solid fa-caret-down"></i>
                    </h4>
                </div>
                <div class="image-container">
                    <a href="../../../index.php">
                        <img src="../../../assets/images/logo.png" style="width:200px;height:90px"
                            alt="Description de l'image">
                    </a>
                </div>
            </div>            </h4>
            <section class="tableau1__header">

                <button style="padding: 10px ;margin:10px;background-color:#dbcc8f"
                    class="btn btn-ajouter-produit">Ajouter Promotion</button>

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

            <section class="tableau1__body" style="width: 800px;">
                <table>
                    <thead>
                        <tr>
                            <th>Promotion Name</th>
                            <th>Discount</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($promotions as $promotion) {
                            //echo "<td>" . $promotion['Promotion ID'] . "</td>";
                            echo "<td>" . $promotion['Promotion Name'] . "</td>";
                            echo "<td>" . $promotion['Discount'] . "</td>";

                            echo '<td style="width: 200px;">
                            <a href="#" class="edit" title="Edit" data-toggle="modal" data-target="#editModal" onclick="fillEditModal(\'' . $promotion['Promotion ID'] . '\', \'' . $promotion['Promotion Name'] . '\', \'' . $promotion['Discount'] . '\')">
                            <i class="material-icons" style="color:#dbcc8f">&#xE254;</i></a>
                            <a href="#" onclick="deletePromo(\''. $promotion['Promotion ID'] .'\')">
                            <i class="material-icons" style="color:#dbcc8f">&#xE872;</i></a> 
									</td>';
                            echo '</tr>';
                        }

                        ?>

                    </tbody>
                </table>
            </section>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Promotion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for editing promotion -->
                            <form id="editForm">
                                <div class="form-group">
                                    <label for="editPromotionName">Promotion Name</label>
                                    <input type="text" class="form-control" id="editPromotionName"
                                        name="editPromotionName">
                                </div>
                                <div class="form-group">
                                    <label for="editDiscount">Discount</label>
                                    <input type="text" class="form-control" id="editDiscount" name="editDiscount">
                                </div>
                                <input type="hidden" id="editPromotionID" name="editPromotionID">
                                <button type="button" style="padding: 10px ;margin:10px;background-color:#dbcc8f" class="btn " onclick="submitEditForm()">Save</button>
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
                    <h5 class="modal-title" id="addModalLabel">Add Promotion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding promotion -->
                    <form id="addForm">
                        <div class="form-group">
                            <label for="addPromotionName">Promotion Name</label>
                            <input type="text" class="form-control" id="addPromotionName" name="addPromotionName"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="addDiscount">Discount</label>
                            <input type="text" class="form-control" id="addDiscount" name="addDiscount" required>
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
        function fillEditModal(promotionID, promotionName, discount) {
            document.getElementById('editPromotionID').value = promotionID;
            document.getElementById('editPromotionName').value = promotionName;
            document.getElementById('editDiscount').value = discount;
        }
        $(document).ready(function () {
            $(".btn-ajouter-produit").click(function () {
                $("#addModal").modal("show");
            });
        });

        function submitEditForm() {
            // Fetch data from the form
            var promotionID = $("#editPromotionID").val();
            var promotionName = $("#editPromotionName").val();
            var discount = $("#editDiscount").val();
            console.log(promotionID);
            console.log(promotionName);
            console.log(discount);

            // AJAX request to send data to ControllerDashboard.php for processing
            $.ajax({
                type: "POST",
                url: "promotionsTable.php",
                data: {
                    editPromotionID: promotionID,
                    editPromotionName: promotionName,
                    editDiscount: discount
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
            var promotionName = $("#addPromotionName").val();
            var discount = $("#addDiscount").val();

            // AJAX request
            $.ajax({
                type: "POST",
                url: "promotionsTable.php", // Remplacez cela par le chemin vers votre script PHP
                data: {
                    addPromotionName: promotionName,
                    addDiscount: discount
                },
                success: function (response) {
                    console.log(promotionName, discount);
                    $("#addModal").modal("hide");
                    location.reload();
                },
                error: function (error) {
                    // Gérez les erreurs ici (par exemple, afficher un message d'erreur)
                    alert("Une erreur s'est produite lors de l'ajout de la promotion.");
                }
            });
        }

        function deletePromo (code){
            $.ajax({
                type: "POST",
                url: "promotionsTable.php", // Remplacez cela par le chemin vers votre script PHP
                data: {
                    promoIDtodelete: code,
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