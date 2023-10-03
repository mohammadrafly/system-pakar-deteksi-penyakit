<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pakar</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="<?= base_url('dist/output.css') ?>">

    <body class="bg-gray-900">
        <div class="min-h-screen flex items-center justify-center mx-auto">
            <div class="max-w-md w-full">
                <?= $this->renderSection('content') ?>
                <div class="mt-10 text-center">
                    <a href="<?= base_url('/') ?>" class="bg-white hover:bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded">Home</a>
                </div>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <?= $this->renderSection('script-js') ?>
    <script src="<?= base_url('js/Main.js') ?>"></script>
    <script src="<?= base_url('js/Auth.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>