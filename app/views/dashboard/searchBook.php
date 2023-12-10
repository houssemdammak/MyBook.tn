<?php
require_once '..\..\controllers\ControllerDashboard.php';
?>


<section class="tableau1__body">
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
                        foreach ($filteredbooks as $product) {
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