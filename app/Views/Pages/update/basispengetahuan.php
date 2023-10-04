<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="max-w-screen-md mx-auto mt-10">
    <form method="post" action="<?= base_url('admin/basis-pengetahuan/update/' . $content[0]['id']) ?>" class="space-y-4">
        <div class="mb-4">
            <label for="namapenyakit" class="block text-gray-700 text-sm font-bold mb-2">Nama Penyakit</label>
            <select id="namapenyakit" name="namapenyakit" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
                <option selected value="<?= $content[0]['namapenyakit'] ?>"><?= $content[0]['namapenyakit'] ?></option>
                <?php foreach($penyakit as $data): ?>
                <option value="<?= $data['namapenyakit'] ?>"><?= $data['namapenyakit'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="gejala" class="block text-gray-700 text-sm font-bold mb-2">Gejala</label>
            <select id="gejala" name="gejala" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
                <option selected value="<?= $content[0]['id'] ?>"><?= $content[0]['nama_gejala'] ?></option>
                <?php foreach($gejala as $data): ?>
                <option value="<?= $data['id'] ?>"><?= $data['gejala'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="nilaibobot" class="block text-gray-700 text-sm font-bold mb-2">Nilai Bobot</label>
            <input type="text" id="nilaibobot" name="nilaibobot" value="<?= $content[0]['nilaibobot'] ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Nilai Bobot">
        </div>
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">Save</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
