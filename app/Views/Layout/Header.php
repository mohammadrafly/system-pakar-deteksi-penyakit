<header class="bg-white">
  <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
      <a href="#" class="-m-1.5 p-1.5">
        <span class="sr-only">Your Company</span>
        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
      </a>
    </div>
    <div class="flex lg:hidden">
      <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
    <?php if (session()->get('username')): ?>
        <a href="<?= base_url('admin/beranda') ?>" class="text-sm font-semibold leading-6 text-gray-900">Beranda</a>
        <a href="<?= base_url('admin/hama-dan-penyakit') ?>" class="text-sm font-semibold leading-6 text-gray-900">Data Hama dan Penyakit</a>
        <a href="<?= base_url('admin/jenis-tanaman') ?>" class="text-sm font-semibold leading-6 text-gray-900">Data Jenis Tanaman</a>
        <a href="<?= base_url('admin/gejala') ?>" class="text-sm font-semibold leading-6 text-gray-900">Data Gejala</a>
        <a href="<?= base_url('admin/basis-pengetahuan') ?>" class="text-sm font-semibold leading-6 text-gray-900">Data Basis Pengetahuan</a>
    <?php else: ?>
        <a href="<?= base_url('/') ?>" class="text-sm font-semibold leading-6 text-gray-900">Beranda</a>
        <a href="<?= base_url('diagnosa-penyakit') ?>" class="text-sm font-semibold leading-6 text-gray-900">Diagnosa Penyakit</a>
        <a href="<?= base_url('daftar-penyakit') ?>" class="text-sm font-semibold leading-6 text-gray-900">Daftar Penyakit</a>
        <a href="<?= base_url('about') ?>" class="text-sm font-semibold leading-6 text-gray-900">About</a>
    <?php endif ?>
    </div>
    <?php if(session()->get('username')): ?>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center relative group">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900 group hover:bg-gray-100 rounded-full p-2 focus:outline-none focus:bg-gray-100">
          <?= session()->get('username') ?>
        </button>
        <ul class="absolute hidden mt-2 bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg space-y-2 z-10">
          <li>
            <a class="dropdown-item" href="javascript:void(0);" onclick="signOut()">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('admin/beranda') ?>">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Dashboard 
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('/') ?>">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Home
            </a>
          </li>
        </ul>
      </div>
    <?php else: ?>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="<?= base_url('login') ?>" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
      </div>
    <?php endif ?>
  </nav>
</header>