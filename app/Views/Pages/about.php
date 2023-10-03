<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="relative isolate px-6 lg:px-8 flex justify-start">
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"><?= $title ?></h1>
      </div>
      <div class="mt-6 bg-white rounded-lg p-6 border border-gray-300 shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Dibuat oleh:</h2>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Nama</dt>
                <dd class="mt-1 text-lg leading-8 text-gray-700 sm:col-span-2 sm:mt-0">Maula Qosdus Sabil</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">NIM</dt>
                <dd class="mt-1 text-lg leading-8 text-gray-700 sm:col-span-2 sm:mt-0">1910651095</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Prodi</dt>
                <dd class="mt-1 text-lg leading-8 text-gray-700 sm:col-span-2 sm:mt-0">TEKNIK INFORMATIKA</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Universitas</dt>
                <dd class="mt-1 text-lg leading-8 text-gray-700 sm:col-span-2 sm:mt-0">UNIVERSITAS MUHAMMADIYAH JEMBER</dd>
            </div>
        </div>
      </div>
    </div>
</div>

<?= $this->endSection() ?>
