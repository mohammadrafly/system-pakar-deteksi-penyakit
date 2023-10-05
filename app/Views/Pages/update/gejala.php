<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="max-w-screen-md mx-auto mt-10">
    <form method="post" action="<?= base_url('admin/gejala/update/' . $content[0]['id']) ?>" class="space-y-4">
        <div class="mb-4">
            <label for="kodegejala" class="block text-gray-700 text-sm font-bold mb-2">Kode Gejala (gunakan format : GXXX/G123 )</label>
            <input type="text" id="kodegejala" name="kodegejala" value="<?= $content[0]['kodegejala'] ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Kode Gejala">
        </div>
        <div class="mb-4">
            <label for="jenistanaman" class="block text-gray-700 text-sm font-bold mb-2">Jenis Tanaman</label>
            <select id="jenistanaman" name="jenistanaman" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
                <option selected value="<?= $content[0]['jenistanaman'] ?>"><?= $content[0]['nama_tanaman'] ?></option>
                <?php foreach($jenis as $data): ?>
                <option value="<?= $data['id'] ?>"><?= $data['jenistanaman'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="gejala" class="block text-gray-700 text-sm font-bold mb-2">Gejala</label>
            <input type="text" id="gejala" name="gejala" value="<?= $content[0]['gejala'] ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Gejala">
        </div>
        <div class="mb-4">
            <label for="daerah" class="block text-gray-700 text-sm font-bold mb-2">Daerah</label>
            <input type="text" id="daerah" name="daerah" value="<?= $content[0]['daerah'] ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Daerah">
        </div>
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">Save</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
