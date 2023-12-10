<?php

require_once '..\..\controllers\ControllerDashboard.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <script src="../../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../assets/js/popper.min.js"></script>
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/xhr.js" type="text/javascript"></script>
    <link rel="icon" href="../../../assets/images/icon.png" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books Dashboard</title>
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
    </style>
    <div id="tableJdida">
        <main class="tableau1">
            <div class="content-wrapper">
                <div class="title">
                    <h4 id="toggleButton" style="padding: 20px ;">Books Dashboard <i class="fa-solid fa-caret-down"></i>
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
                <form action="AddBook.php">
                    <button style="padding: 10px ;margin:10px;background-color:#dbcc8f" class="btn ">Ajouter
                        Book</button>
                </form>
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


                <div class="input-group">
                    <input type="search" name="produitName" placeholder="Search Book..."
                        onChange="searchProduct(this.value)">
                </div>
            </section>

            <section class="tableau1__body" id="toChangeOnsearch">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th style="width: 320px">Book ID</th>
                            <th>Title</th>
                            <th style="width: 320px">Author Name</th>
                            <th style="width: 200px">Price</th>
                            <th>Promotion</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th style="width: 500px">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $product) {
                            echo '<td class="image-prod"><img class="img" src="' . '../../../' . $product['Image'] . '" alt="' . $product['Title'] . '"></td>';
                            echo '<td style="width: 100px;">' . $product['Book ID'] . '</td>';
                            echo '<td class="product-name"><p>' . $product['Title'] . '</p></td>';
                            echo '<td>' . $product['Author Name'] . '</td>';
                            echo '<td class="price" style="width: 320px">' . $product['Price'] . ' D' . '</td>';
                            echo '<td>' . $product['Promotion'] . '</td>';
                            echo '<td>' . $product['Status'] . '</td>';
                            echo '<td>' . $product['Quantity'] . '</td>';
                            echo '<td>' . $product['Category'] . '</td>';
                            echo '<td style="width: 500px;">
                                <a href="booksTable.php?codeDisplay=' . $product['Book ID'] . '" class="view" title="View" data-target="#DisplayModal' . $product['Book ID'] . '" data-toggle="modal"><i class="material-icons" style="color:#dbcc8f">&#xE417;</i></a>
                                <a href="UpdateBook.php?codeB=' . $product['Book ID'] . '"><i style="color:#dbcc8f" class="material-icons">&#xE254;</i></a>
                                <a href="booksTable?codeBDelete=' . $product['Book ID'] . '" class="delete" title="Delete" data-toggle="tooltip">
                                <i class="material-icons" style="color:#dbcc8f">&#xE872;</i></a> 
                                </td>';
                            echo '</tr>';
                            echo '<div class="modal fade" id="DisplayModal' . $product['Book ID'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                            <div class="row">
                                                <div class="col-lg-6 mb-5 ftco-animate">
                                                    <a href="#" class="img-prod"><img style="width: 400px;height:500px;" class="img-fluid"
                                                        src="../../../' . $product['Image'] . '">
                                                        <div class="overlay"></div>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                                                    <h3>' . $product['Title'] . '</h3>
                                                    <p>' . $product['Author Name'] . '</p>
                                                    <p>' . $product['Description'] . '</p>
                                                    <p class="price"><span><strong>Price :</strong>' . $product['Price'] . ' D' . '</span></p>
                                                    <p><strong>Promotion:</strong> ' . $product['Promotion'] . '%</p>
                                                    <p><strong>Status:</strong> ' . $product['Status'] . '</p>
                                                    <p><strong>Quantity:</strong> ' . $product['Quantity'] . '</p>
                                                    <p><strong>Category:</strong> ' . $product['Category'] . '</p>

                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>';
                        }
                        ?>

                    </tbody>
                </table>
            </section>

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


    </script>
    <script type="text/javascript">
	function searchProduct(code) {
		var xhr = getXMLHttpRequest();
		obj = document.getElementById("toChangeOnsearch");
		obj.innerHTML = "";
		xhr.open("GET", "searchBook.php?codeSearch=" + code, true);
		xhr.send();
		xhr.onreadystatechange = function () {
			if ((xhr.readyState == 4) && (xhr.status == 200)) {
				obj.innerHTML = xhr.responseText;
			}
		}
	}
</script>

</body>

</html>