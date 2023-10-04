<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="max-w-screen-md mx-auto mt-10">
    <form method="post" action="<?= base_url('admin/jenis-tanaman/update/' . $content['id']) ?>" class="space-y-4">
        <div class="mb-4">
            <label for="jenistanaman" class="block text-gray-700 text-sm font-bold mb-2">Jenis Tanaman</label>
            <input type="text" id="jenistanaman" name="jenistanaman" value="<?= $content['jenistanaman'] ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Jenis Tanaman">
        </div>
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">Save</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
