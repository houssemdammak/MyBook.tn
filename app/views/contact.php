<?php
require 'header.php';
require_once '../controllers/ControllerContact.php';
?>

<div class="hero-wrap hero-bread" style="background-image: url('../../assets/images/contact_bg.jpg');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2">
            <h1 class="mb-0 bread">Contact Us</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section contact-section bg-light">
  <div class="container">
    <div class="row d-flex mb-5 contact-info">
      <div class="w-100"></div>
      <div class="col-md-3 d-flex">
        <div class="info bg-white p-4">
          <p><span>Address:</span> Sfax-Tunsia</p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="info bg-white p-4">
          <p><span>Phone:</span> <a href="tel://1234567920">+216 20 22 03 04</a></p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="info bg-white p-4">
          <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@mybook.tn</a></p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="info bg-white p-4">
          <p><span>Website</span> <a href="#">Mybook.tn</a></p>
        </div>
      </div>
    </div>
    <div class="row block-9">
      <div class="col-md-6 order-md-last d-flex">
        <form action="#" method="post" class="bg-white p-5 contact-form">
          <div class="form-group">
            <input type="text" name="name_contact" class="form-control" placeholder="Your Name" required>
          </div>
          <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Your Email" required>
          </div>
          <div class="form-group">
            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
          </div>
          <div class="form-group">
            <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
          </div>
        </form>

      </div>

      <div class="col-md-6 d-flex">
        <img class="one-third order-md-last img-fluid" src="../../assets/images/read_contact" alt=""
          style="height: 600px;">
        <div class="one-forth d-flex align-items-center ftco-animate"
          data-scrollax=" properties: { translateY: '70%' }">
        </div>
      </div>
    </div>
</section>



<?php require 'footer.php'; ?>