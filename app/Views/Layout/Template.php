<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar | <?= !empty($title) ? "$title" : "Default Title" ?></title>
    <link href="<?= base_url('dist/output.css') ?>" rel="stylesheet">
    
</head>
<body class="bg-slate-200">

    <?= $this->include('Layout/Header') ?>
    
    <?= $this->renderSection('content') ?>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url('js/Main.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $this->renderSection('js') ?>
</body>
</html>