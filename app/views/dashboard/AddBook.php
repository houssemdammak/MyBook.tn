<?php
require_once '..\..\controllers\ControllerDashboard.php';



?>

<head>

<link rel="icon" href="../../../assets/images/icon.png" type="image/x-icon"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Book</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="../../../assets/js/xhr.js" type="text/javascript"></script>

    <script src="https://kit.fontawesome.com/df57f43f75.js" crossorigin="anonymous"></script>



</head>

<body>
    <style>
        body {
            min-height: 90vh;
            background: url(../../../assets/images/books-shop_bg.jpg) center / cover;
            font-family: sans-serif, Arial, Helvetica;
        }

        /* Style for form content */
        .form-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            height: auto;

        }

        /* Style for form groups */
        .form-group {
            margin-bottom: 15px;
        }

        /* Style for labels */
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Style for form controls */
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Style for the update button */

        img {
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #ec971f;
        }

        /* Style for the icon */
        .btn .glyphicon {
            margin-right: 5px;
        }

        .btn {
            width: 100%;
            display: inline-block;
            padding: 10px 0px;
            font-size: 16px;
            text-align: center;
            color: #fff;
            background-color: #f0ad4e;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
    </style>
    <form action="booksTable.php" method="post" enctype="multipart/form-data">
        <div class="form-content">
            <div class="form-group">
                <input type="hidden" name="book_id_add">
                <label for="title">Title:</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label for="author">Author Name:</label>
                <input class="form-control" type="text" name="author" id="author" placeholder="Enter Author Name">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category" id="category">
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c['Category ID'] ?>">
                            <!-- Assuming 'Category ID' is the actual ID field name -->
                            <?= $c['Category Name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="promotion">Promotion:</label>
                <select class="form-control" name="promotion" id="promotion">
                    <?php foreach ($promotions as $p): ?>
                        <option value="<?= $p['Promotion ID'] ?>">
                            <!-- Assuming 'Promotion ID' is the actual ID field name -->
                            <?= $p['Promotion Name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" name="price" id="price">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" class="form-control" name="quantity" id="quantity">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" id="description">
            </div>
            <div class="form-group">
                <input type="hidden" name="image">
                <label for="image">New image:</label>
                <input type="file" id="image" name="image" accept="image/*"><br>
            </div>
            <div class="form-footer">
                <!-- <a href="#" onclick="Update(<?= $products['Book ID'] ?>)" class="btn-update" style="width: 100%;">
                    <span class="glyphicon glyphicon-ok-sign"></span> Update
                </a> -->
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>
</body>