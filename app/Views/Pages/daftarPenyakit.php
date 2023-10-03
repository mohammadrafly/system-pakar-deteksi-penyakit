<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

    <div class="max-w-screen-md mx-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mt-5">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-center">No</th>
                    <th class="py-3 px-6 text-center">Kode Penyakit</th>
                    <th class="py-3 px-6 text-center">Nama Penyakit</th>
                    <th class="py-3 px-6 text-center">Jenis Tanaman</th>
                    <th class="py-3 px-6 text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php 
                $no = 1;
                foreach($content as $data): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-center"><?= $no++ ?></td>
                    <td class="py-3 px-6 text-center"><?= $data['kodepenyakit'] ?></td>
                    <td class="py-3 px-6 text-center"><?= $data['namapenyakit'] ?></td>
                    <td class="py-3 px-6 text-center"><?= $data['nama_tanaman'] ?></td>
                    <td class="py-3 px-6 text-center">
                        <a href="<?= base_url('daftar-penyakit/detail/'.$data['kodepenyakit']) ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mr-2">Detail</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="pagination flex items-center justify-center mt-4">
            <button id="prevPage" class="px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md mr-2">Previous</button>
            <span id="pageInfo" class="text-gray-600"></span>
            <button id="nextPage" class="px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md ml-2">Next</button>
        </div>
    </div>
<?= $this->endSection() ?>