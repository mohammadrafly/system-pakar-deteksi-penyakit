<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="max-w-screen-md mx-auto mt-10">
    <form method="POST" action="<?= base_url('diagnosa-penyakit') ?>">
        <?php
        // Initialize an empty array to group items by 'daerah'
        $groupedData = [];

        // Iterate through the content and group items by 'daerah'
        foreach ($content as $data) {
            $daerah = $data['daerah'];
            $name = $data['gejala'];
            $gejala = $data['id'];

            // Check if the 'daerah' key exists in the groupedData array
            if (!array_key_exists($daerah, $groupedData)) {
                // If not, create a new array for that 'daerah'
                $groupedData[$daerah] = [];
            }

            // Add the 'gejala' and 'name' to the 'daerah' group as an associative array
            $groupedData[$daerah][] = [
                'gejala' => $gejala,
                'name' => $name,
            ];
        }

        // Iterate through the grouped data and display it
        foreach ($groupedData as $daerah => $gejalas) {
            ?>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2"><?= $daerah ?></h2>
                <?php foreach ($gejalas as $item) { ?>
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            name="selected_gejalas[]"
                            value="<?= htmlspecialchars($item['gejala']) ?>"
                            class="form-checkbox h-5 w-5 text-indigo-600 border-indigo-300 rounded-sm transition duration-150 ease-in-out"
                        />
                        <label for="checkbox" class="ml-2 text-gray-700"><?= $item['name'] ?></label>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            CEK PENYAKIT
        </button>
    </form>
    <?php if (!is_null($diseasesProbability)): ?>
        <div class="diseases-probability">
            <h2>Diseases Probability</h2>
            <ul>
                <?php foreach ($diseasesProbability as $disease => $probability): ?>
                    <li><a href="<?= base_url('daftar-penyakit/detail/'.$disease) ?>" class="text-blue-500"><?= $disease ?></a>: <?= $probability ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
