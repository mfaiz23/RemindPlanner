<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="<?= base_url('./public/assets/css/style.css') ?>" rel="stylesheet">
    <title>Remind Planner</title>
  </head>
  <body
    x-data="{ page: 'comingSoon', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
  >
    <!-- ===== Preloader Start ===== -->
    <include src="./public/assets/partials/preloader.html"></include>

<body>
        

    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('./public/assets/js/index.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>

</body>
</html>
