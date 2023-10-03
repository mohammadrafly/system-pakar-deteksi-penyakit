<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="relative isolate px-6 lg:px-8 flex justify-start">
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Selamat datang <?= session()->get('username') ?>. Silahkan pilih menu yang diinginkan</h1>
      </div>
    </div>
</div>

<?= $this->endSection() ?>