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
    <title>Contacts Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../../assets/css/dashboard.css">

    <script src="https://kit.fontawesome.com/df57f43f75.js" crossorigin="anonymous"></script>


</head>

<body>
    <style>
        /* Style pour le fond du modal */
        .modal-content {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
        }

        /* Style pour le titre */
        .product-details h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        /* Style pour les paragraphes */
        .product-details p {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        /* Style pour le fond obscurci du modal */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }

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
        <main class="tableau1">
            <div class="content-wrapper">
                <div class="title">
                    <h4 id="toggleButton" style="padding: 20px ;">Contacts Dashboard <i
                            class="fa-solid fa-caret-down"></i>
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
                            <!-- <th style="width:200px;">Contact ID</th> -->
                            <th style="width:400px;">Full Name</th>
                            <th style="width:220px;">Email</th>
                            <th style="width:220px;">Subject</th>
                            <th style="width:520px; maxHeight:100px;">Message</th>
                            <th>action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($contacts as $contact) {
                            echo "<tr>";
                            // echo "<td>" . $contact['Contact ID'] . "</td>";
                            echo "<td>" . $contact['Fullname'] . "</td>";
                            echo "<td>" . $contact['Email'] . "</td>";
                            echo "<td>" . $contact['Subject'] . "</td>";
                            echo "<td>" . $contact['Message'] . "</td>";
                            echo '<td style="width: 250px;">
                            <a href="contactUs.php?codeDisplay=' . $contact['Contact ID'] . '" class="view" title="View" data-target="#DisplayModal' . $contact['Contact ID'] . '" data-toggle="modal"><i class="material-icons" style="color:#dbcc8f">&#xE417;</i></a>
                            </td>';
                            echo '</tr>';
                            echo '<div class="modal fade" id="DisplayModal' . $contact['Contact ID'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                                <div class="product-details pl-md-5 ftco-animate">
                                                    <h3> Full Name: ' . $contact['Fullname'] . '</h3>
                                                    <p><strong>Email:</strong> ' . $contact['Email'] . '</p>
                                                    <p><strong>Subject:</strong> ' . $contact['Subject'] . '</p>
                                                    <p><strong>Message:</strong> ' . $contact['Message'] . '</p>
                                                </div>
                                    </div>
                                </div>
                            </div>';

                        } ?>
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

</body>

</html>