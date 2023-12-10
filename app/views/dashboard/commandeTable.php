<?php

require_once '..\..\controllers\ControllerDashboard.php';



if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['editCommandeID'])) {
    $editCommandeID = $_POST['editCommandeID'];
    $editClientID = $_POST['editClientID'];
    $editstatus = $_POST['editstatus'];
    //var_dump($editstatus);
    $controller->UpdateCommande($editCommandeID, $editClientID, $editstatus);
    if($editstatus=="Refunded"){
        $controller->deleteFromTable($editCommandeID, $editClientID);
    }
    if($editstatus=="Cancelled"){
        $controller->DeleteCommande($editCommandeID);
    }

}
//var_dump($_POST);
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['commandeIDtodelete'])) {
    $commandeID = $_POST["commandeIDtodelete"];
    $controller->DeleteCommande($commandeID);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../../../assets/css/style.css"> -->
	<link rel="icon" href="../../../assets/images/icon.png" type="image/x-icon"/>

    <script src="../../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../assets/js/popper.min.js"></script>
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/xhr.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders Dashboard</title>
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
        /* Style pour la modal */
        /* Style pour la modal */
        .modal-dialog {
            max-width: 1000px;
            max-height: 600px;
        }

        /* Style pour l'image */
        .img-prod img {
            display: block;
            /* Pour gérer la marge automatique */
            margin: auto;
            /* Centre l'image horizontalement */
            max-width: 100%;
            /* Pour s'assurer que l'image ne dépasse pas la largeur de son conteneur */
            height: auto;
            /* Maintient le rapport hauteur/largeur */
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 20px;
        }

        /* Style pour le contenu de la modal */
        .product-details {
            padding: 40px;
            /* Espacement intérieur */
            text-align: center;
            /* Centre le texte à l'intérieur de la colonne */
        }

        .product-details h3 {
            font-size: 24px;
            /* Taille de police pour le titre */
            margin-bottom: 10px;
            /* Marge en bas du titre */
        }

        .product-details p {
            font-size: 16px;
            /* Taille de police pour le texte */
            line-height: 1.6;
            /* Hauteur de ligne pour une lecture facile */
        }

        img {
            max-width: 10%;
            height: auto;
        }
    </style>
    <div id="tableJdida">
        <main class="tableau1" style="width: 900px;">
        <div class="content-wrapper">
                <div class="title">
                    <h4 id="toggleButton" style="padding: 20px ;">Orders Dashboard <i class="fa-solid fa-caret-down"></i>
                    </h4>
                </div>
                <div class="image-container">
                    <a href="../../../index.php">
                        <img src="../../../assets/images/logo.png" style="width:200px;height:90px"
                            alt="Description de l'image">
                    </a>
                </div>
            </div>            <section class="tableau1__header">
                <div class="container" id="scrollContainer">
                    <ul>
                        <li><a href="booksTable.php">Books</a></li>
                        <li><a href="categoriesTable.php">Categories</a> </li>
                        <li><a href="promotionsTable.php">Promotions</a></li>
                        <li><a href="usersTable.php">Users</a></li>
                        <li><a href="commandeTable.php">Orders </a></li>
                        <li><a href="contactUs.php">Contacts</a></li>


                    </ul>
                </div>

            </section>

            <section class="tableau1__body">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Client Name</th>
                            <th>Order Status </th>
                            <th style="width: 200px">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $order) {
                            $commandeID = $order['Commande ID'];
                            $commandeDetails = $controller->getOrderDetails($commandeID);
                        
                            // Ajouter les détails de la commande au tableau associatif
                            $commandeDetailsAll[$commandeID] = $commandeDetails; 
                            echo '<td>' . $order['Commande ID'] . '</td>';
                            echo '<td>' . $order['Client Name'] . '</td>';
                            echo '<td>'.$order['Status']. '</td>';
                            
                            echo '</td>';
                            echo '<td style="width: 200px;">
                                <a href="#"  class="view" title="View" data-toggle="modal" data-target="#DisplayModal' . $order['Commande ID'] . '"><i class="material-icons" style="color:#dbcc8f">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="modal" data-target="#editModal" onclick="fillEditModal(\'' . $order['Commande ID'] . '\', \'' . $order['Client ID'] . '\', \'' . $order['Client Name'] . '\', \'' . $order['Status'] . '\')">
                            <i class="material-icons" style="color:#dbcc8f">&#xE254;</i></a>
                            <a href="#" onclick="deleteCommande(\'' . $order['Commande ID'] . '\')">
                            <i class="material-icons" style="color:#dbcc8f">&#xE872;</i></a> 
                                </td>';
                            echo '</tr>';
                            
                            
                        }
                        ?>

            </tbody></table>       
            </section>

        </main>
    </div>
    <?php
foreach ($orders as $order) {
    $commandeID = $order['Commande ID'];
    $commandeDetails = $controller->getOrderDetails($commandeID);
    $commandeDetailsAll[$commandeID] = $commandeDetails;

    echo '<div class="modal fade" id="DisplayModal' . $order['Commande ID'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Details for Order ID: ' . $order['Commande ID'] . '</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                        <p><strong>Client Name: </strong>' . $order['Client Name'] . '</p>
                        <p><strong>Order Status: </strong>'.$order['Status']. '</p>
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>';

    foreach ($commandeDetailsAll[$commandeID] as $detail) {
        echo '<tr>
                <td><img style="width: 80px;height:100px;" class="img-fluid" src="../../../' . $detail['Image'] . '" alt="' . $detail['Title'] . '" class="img-fluid"></td>
                <td >' . $detail['Title'] . '</td>
                <td style="width: 100px;">' . $detail['Quantity'] . '</td>
            </tr>';
    }

    echo '</tbody>
            </table>
        </div>
    </div>
</div>
</div>';
}
?>
<!-------------------------edit ------------------------->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing promotion -->
                    <form id="editForm">
                        <div class="form-group">
                            <label for="editCommandeID">Order ID</label>
                            <input type="text" class="form-control" id="editCommandeID" name="editCommandeID" readonly>
                        </div>
                        <div class="form-group">
                            <label for="editClientName">Client Name</label>
                            <input type="hidden" class="form-control" id="editClientID" name="editClientID" readonly>

                            <input type="text" class="form-control" id="editClientName" name="editClientName" readonly>
                        </div>
                        <div class="form-group" style="width: 200px;">
                            <label for="editStatus">Status</label>
                            <select class="form-control" id="editStatus" name="editStatus">
                                <option value="Waiting Payment">Waiting Payment</option>
                                <option value="Refunded">Refunded</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <button type="button" style="padding: 10px ;margin:10px;background-color:#dbcc8f" class="btn"
                            onclick="submitEditForm()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>
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
        function fillEditModal(CommandeID, clientID, clientName, status) {
            document.getElementById('editCommandeID').value = CommandeID;
            document.getElementById('editClientName').value = clientName;
            document.getElementById('editClientID').value = clientID;
            document.getElementById('editStatus').value = status;

           
        }


        function submitEditForm() {
            // Fetch data from the form
            var CommandeID = $("#editCommandeID").val();
            var clientID = $("#editClientID").val();
            var selectElement = document.getElementById("editStatus");
            var status = selectElement.value;
            console.log(CommandeID);
            console.log(clientID);
            console.log(status);

            // AJAX request to send data to ControllerDashboard.php for processing
            $.ajax({
                type: "POST",
                url: "commandeTable.php",
                data: {
                    editCommandeID: CommandeID,
                    editClientID: clientID,
                    editstatus: status
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
       
        function deleteCommande(code) {
            $.ajax({
                type: "POST",
                url: "commandeTable.php", // Remplacez cela par le chemin vers votre script PHP
                data: {
                    commandeIDtodelete: code,
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