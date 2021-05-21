<?php
  include './session.php';
?>
<script>
  $(".alert").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
<nav class="navbar sticky-top shadow navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <a class="navbar-brand" href="../index.php">
        <div class="d-flex align-items-center">
          <img src="../../images/logo.png" width="50" height="50" alt="">
          <h4 class="mb-0 ml-4">De klapschaats</h4>
        </div>
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['gebruikersnaam'])) : ?>
        <li class="nav-item active">
          <a class="nav-link text-primary" href="../includes/logout.php">Uitloggen<span class="sr-only"></span></a>
        </li>
        <?php else : ?>
          <li class="nav-item active">
            <a class="nav-link text-primary" href="../admin/overzicht.php">Admin pagina<span class="sr-only"></span></a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>