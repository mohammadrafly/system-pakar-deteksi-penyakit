<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="max-w-screen-md mx-auto mt-10">
    <form method="post" action="<?= base_url('admin/hama-dan-penyakit/update/' . $content[0]['id']) ?>" class="space-y-4">
        <div class="mb-4">
            <label for="kodePenyakit" class="block text-gray-700 text-sm font-bold mb-2">Kode Penyakit (gunakan format : PXXX/P123 )</label>
            <input type="text" id="kodePenyakit" name="kodePenyakit" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" value="<?= $content[0]['kodepenyakit'] ?>" placeholder="Enter Kode Penyakit">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="namaPenyakit">Nama Penyakit</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namaPenyakit" type="text" name="namaPenyakit" value="<?= $content[0]['namapenyakit'] ?>" placeholder="Nama Penyakit">
        </div>
        
        <div class="mb-4">
            <label for="jenistanaman" class="block text-gray-700 text-sm font-bold mb-2">Jenis Tanaman</label>
            <select id="jenistanaman" name="jenistanaman" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
                <option selected value="<?= $content[0]['id'] ?>"><?= $content[0]['nama_tanaman'] ?></option>
                <?php foreach($jenis as $data): ?>
                <option value="<?= $data['id'] ?>"><?= $data['jenistanaman'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fisikMekanis">Fisik Mekanis</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fisikMekanis" name="fisikMekanis" placeholder="Fisik Mekanis"><?= $content[0]['fisikmekanis'] ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="kulturTeknis">Kultur Teknis</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kulturTeknis" name="kulturTeknis" placeholder="Kultur Teknis"><?= $content[0]['kulturteknis'] ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="kimiawi">Kimiawi</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kimiawi" name="kimiawi" placeholder="Kimiawi"><?= $content[0]['kimiawi'] ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="hayati">Hayati</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="hayati" name="hayati" placeholder="Hayati"><?= $content[0]['hayati'] ?></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Submit
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
