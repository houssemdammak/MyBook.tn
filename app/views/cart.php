<?php

require_once '..\controllers\ControllerCart.php';
require('header.php');
?>
<div class="hero-wrap hero-bread" style="background-image: url('../../assets/images/cart-bg.jpg');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h1 class="mb-0 bread">My Wishlist</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($products as $product) {
                // Utilisation des clés existantes du tableau
                echo '<tr class="text-center" id="ligne_'.$product['id_cd'].'">';
                echo '<td class="product-remove"><a href="" onclick="deleteRow('.$product['id_cd'].')"><span class="ion-ios-close"></span></a></td>';

                //echo '<tr class="text-center">';
                //echo '<td class="product-remove"><button type="button" class="btn btn-link delete-btn"><span class="ion-ios-close"></span></button></td>';
                echo '<td class="image-prod"><img class="img" src="'.'../../'.$product['Image'].'" alt="'.$product['Product'].'"></td>';
                echo '<td class="product-name">';
                echo '<h3>'.$product['Product'].'</h3>';
                echo '<td class="price">'.$product['Price unit'].' D'.'</td>';
                echo '<td class="quantity">';
                echo '<div class="input-group mb-3">';
                echo '<div class="input-group-prepend">';
                echo '<button class="quantity-left-minus btn btn-outline-danger" type="button" data-action="decrement" ><i class="ion-ios-remove"></i></button>';
                echo '</div>';
                echo '<input type="text" name="quantity" class="quantity form-control input-number" data-product-id="'.$product['id_cd'].'" value="'.$product['Quantity'].'" min="1" max="100" onChange="update(this.data-product-id,this.value)" readonly>';
                echo '<input type="hidden" name="id_cd" value="'.$product['id_cd'].'">';
                echo '<input type="hidden" name="stock" value="'.$product['stock'].'">';
                echo '<div class="input-group-append">';
                echo '<button type="submit" class="quantity-right-plus btn btn-outline-success" data-action="increment" ><i class="ion-ios-add"></i></button>';
                echo '<span class="error-message"></span>';
                echo '</div>';
                echo '</div>';
                echo '<span class="error-message" id="error_message_'.$product['id_cd'].'"></span>';

                echo '</td>';
                echo '<td class="total" id="total_'.$product['id_cd'].'">'.$product['Total'].' D'.'</td>';
                echo '</tr>';

              }
              ?>

            </tbody>
          </table>
        </div>

      </div>
    </div>

    <div class="row justify-content-start">
      <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Cart Totals</h3>
          <!-- Subtotal -->
          <p class="d-flex">
            <span>Subtotal</span>
            <span id="subtotal">
              <?php
              if(isset($cartData['Total'])) {
                echo number_format($cartData['Total'], 2).'D';
              } else {
                echo '0.00D';
              }
              ?>
            </span>
          </p>
          <!-- Delivery -->
          <p class="d-flex">
            <span>Delivery</span>
            <span>0.00 D</span>
          </p>
          <!-- Discount -->
          <p class="d-flex">
            <span>Discount</span>
            <span id="discount">
              <?php //echo number_format($cartData['Total Discount Amount'], 2).'D'; 
              if(isset($cartData['Total Discount Amount'])) {
                echo number_format($cartData['Total Discount Amount'], 2).'D';
              } else {
                echo '0.00D';
              }
              ?>
            </span>

          </p>
          <hr>
          <!-- Total -->
          <p class="d-flex total-price">
            <span>Total</span>
            <span id="totalPrice">
              <?php // echo number_format($cartData['Total Discounted Price'], 2).'D';
              if(isset($cartData['Total Discounted Price'])) {
                echo number_format($cartData['Total Discounted Price'], 2).'D';
              } else {
                echo '0.00D';
              }
               ?>
            </span>
          </p>
        </div>
        <!-- Proceed to Checkout Button -->
        <p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
      </div>
    </div>
  </div>
</section>

<?php require('footer.php'); ?>
<script>
  function update(productId, newQuantity) {
    var xhr = getXMLHttpRequest();
    var data = new FormData();
    //data.append('action', 'update');
    data.append('id_cd', productId);
    data.append('quantity', newQuantity);

    xhr.open("POST", "../controllers/ControllerCart.php", true);

    xhr.send(data);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          if (xhr.responseText.trim() !== '') {
            var jsonResponse = JSON.parse(xhr.responseText);

            // Mettez à jour les quantités dans le DOM
            updateQuantityInDOM(jsonResponse.newproducts);

            // Mettez à jour les totaux dans le DOM
            updateTotalsInDOM(jsonResponse.newproducts);

          } else {
            console.error('La réponse JSON est vide.');
          }
        } else {
          console.error('Erreur de la requête AJAX :', xhr.status);
        }
      }
    }
  }
  function updateQuantityInDOM(newproducts) {

    newproducts.forEach(function (product) {
      var productIdCd = product.id_cd;
      var newTotal = product.Total + ' D';
      /*var totalElement = document.getElementById('total_' + productIdCd);
      var quantityElement = document.getElementById('quantity_' + productIdCd);
      var errorMessageElement = document.getElementById('error_message_' + productIdCd);
      console.log(product.stock);
      if (product.stock < product.Quantity) {
        console.log('product.stock:', product.stock);
        console.log('product.Quantity:', product.Quantity);
          // Afficher le message d'erreur dans le span à côté de l'input
          if (errorMessageElement) {
            errorMessageElement.textContent = 'Insufficient Stock ';
              errorMessageElement.classList.add('error-message');
              errorMessageElement.style.fontSize = '12px'; // Ajuster la taille de la police à 12 pixels comme exemple
              errorMessageElement.style.color = 'red'; 
              
          }
          return;
      } else {
  // Réinitialiser le message d'erreur si le stock est suffisant
  if (errorMessageElement) {
      errorMessageElement.textContent = '';
      errorMessageElement.classList.remove('error-message');
  }

  // Mettre à jour le total si le stock est suffisant
  if (totalElement) {
      totalElement.textContent = newTotal;
  }
}*/
      // Remplacez "id_cd" par le véritable identifiant utilisé dans votre HTML
      var totalElement = document.getElementById('total_' + productIdCd);
      if (totalElement) {
        totalElement.textContent = newTotal;
      }
    });
  }
  function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function (n, prec) {
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };

    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }

    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }

    return s.join(dec);
  }

  function updateTotalsInDOM(newproducts) {
    var totalTotal = 0.0;
    var totalDiscountAmount = 0.0;
    var totalDiscountedPrice = 0.0;

    // Assurez-vous que cartData est un tableau non vide

    newproducts.forEach(function (product) {
      // Assurez-vous que les clés nécessaires existent dans chaque élément du tableau
      if (product['Total'] !== undefined && product['Discount'] !== undefined && product['Discounted Price'] !== undefined) {
        // Effectuez vos opérations ici avec les propriétés de chaque élément
        var productIdCd = product.id_cd;
        var newTotal = product.Total + ' D';

        // Mettez à jour les totaux comme souhaité
        totalTotal += parseFloat(product['Total']);
        totalDiscountAmount += (parseFloat(product['Price unit']) - parseFloat(product['Discounted Price'])) * parseFloat(product['Quantity']);
        totalDiscountedPrice += parseFloat(product['Discounted Price']) * parseFloat(product['Quantity']);

      }
    });

    console.log(totalDiscountAmount, totalTotal, totalDiscountedPrice);
    var subtotalElement = document.getElementById('subtotal');
    var discountElement = document.getElementById('discount');
    var totalPriceElement = document.getElementById('totalPrice');
    subtotalElement.textContent = number_format(totalTotal, 2) + ' D';
    discountElement.textContent = number_format(totalDiscountAmount, 2) + ' D';
    totalPriceElement.textContent = number_format(totalDiscountedPrice, 2) + ' D';
  }

  $('.quantity-left-minus').click(function (e) {
    e.preventDefault();
    updateQuantity($(this), -1);
  });

  // Gestion du clic sur le bouton d'augmentation de la quantité
  $('.quantity-right-plus').click(function (e) {
    e.preventDefault();
    updateQuantity($(this), 1);
  });

  /*function updateQuantity(button, increment) {
      var input = button.closest('.input-group').find('.quantity');
      var newQuantity = parseInt(input.val()) + increment;
      if (newQuantity >= 1) {
          input.val(newQuantity);
          console.log(newQuantity);            
          // Récupérez l'identifiant du produit
          var productId = parseInt($(input).data('product-id'));
          console.log(productId);
          // Appelez la fonction update avec l'identifiant du produit et la nouvelle quantité
          update(productId, newQuantity);
          //console.log("aaaaaaaaaaaaaaaaaaaaaa");
      }
  }*/
  function updateQuantity(button, increment) {
    var input = button.closest('.input-group').find('.quantity');
    var stockInput = button.closest('.input-group').find('[name="stock"]');
    var newQuantity = parseInt(input.val()) + increment;
    var stock = parseInt(stockInput.val());
    var productId = parseInt($(input).data('product-id'));
    var errorMessageElement = document.getElementById('error_message_' + productId);

    if (newQuantity >= 1 && newQuantity <= stock) {
      input.val(newQuantity);
      console.log(newQuantity);

      // Récupérez l'identifiant du produit
      console.log(productId);

      // Appelez la fonction update avec l'identifiant du produit et la nouvelle quantité
      update(productId, newQuantity);

      // Effacez le message d'erreur s'il existe
      if (errorMessageElement) {
        errorMessageElement.textContent = '';
        errorMessageElement.classList.remove('error-message');
      }
    } else if (newQuantity === 0) {
      // Traitement spécial si la nouvelle quantité est égale à 0
      // Vous pouvez ajouter ici le code que vous souhaitez exécuter lorsque newQuantity est égal à 0
      // Dans cet exemple, nous effaçons simplement le message d'erreur s'il existe
      if (errorMessageElement) {
        errorMessageElement.textContent = '';
        errorMessageElement.classList.remove('error-message');
      }
    }
    else {
      // Affichez un message d'erreur si le stock est insuffisant
      if (errorMessageElement) {
        errorMessageElement.textContent = 'Insufficient Stock ';
        errorMessageElement.classList.add('error-message');
        errorMessageElement.style.fontSize = '12px'; // Ajuster la taille de la police à 12 pixels comme exemple
        errorMessageElement.style.color = 'red';
      }
    }
  }


  function deleteRow(rowId) {

    var xhr = getXMLHttpRequest();
    var data = new FormData();
    data.append('rowId', rowId);
    xhr.open("POST", "../controllers/ControllerCart.php", true);
    xhr.send(data);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          if (xhr.responseText.trim() !== '') {
            var jsonResponse = JSON.parse(xhr.responseText);
            $('#ligne_' + rowId).remove();
            updateQuantityInDOM(jsonResponse.newproducts);
            // Mettez à jour les totaux dans le DOM
            updateTotalsInDOM(jsonResponse.newproducts);
            var itemCountElement = document.getElementById('cartItemCount');
            var newCount = jsonResponse.count;
            console.log(newCount);
            if (itemCountElement) {
              itemCountElement.innerHTML = '<a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span> [' + newCount + ']</a>';

            }
            //location.reload();
          } else {
            console.error('La réponse JSON est vide.');
          }
        } else {
          console.error('Erreur de la requête AJAX :', xhr.status);
        }
      }
    }

  }

</script>