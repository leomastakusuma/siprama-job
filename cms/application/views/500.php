<!DOCTYPE html>
<html lang="en">
    <?php $includes = getcwd() . '/application/views/includes/'; ?>
    <?php include($includes . "/header.php"); ?>
    <body class="body-500">

    <div class="container">

      <section class="error-wrapper">
          <i class="icon-500"></i>
          <h1>Ouch!</h1>
          <h2>500 Page Error</h2>
          <p class="page-500">Terjadi kesalahan atau data tidak ditemukan. <a href="<?php echo site_url();?>">Return Home</a></p>
      </section>

    </div>


  </body>
</html>