
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/fullcalendar.css') ?>" rel="stylesheet">
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/materialdesignicons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/morris.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/loading-bar.min.css') ?>" rel="stylesheet">
    <title>Remind Planner</title>
  </head>
  <body
  >
  <?= $this->include ('templates/navbar'); ?>
  <?= $this->include ('templates/sidebar'); ?>

    <?= $this->renderSection('content') ?>
   

    <?= $this->include('templates/footer') ?>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="<?= base_url('assets/js/fullcalendar.js') ?>"></script>
    <script src="<?= base_url('assets/js/jvectormap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/loading-bar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/polyfill.js') ?>"></script>
    <script src="<?= base_url('assets/js/world-merc.js') ?>"></script>

  </body>
</html>
