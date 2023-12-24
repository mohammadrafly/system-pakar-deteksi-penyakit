<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="max-w-screen-md mx-auto mt-10">
    <?php if (session('error')): ?>
        <div class="bg-red-500 text-white px-4 py-2 rounded relative mb-4" role="alert" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="flex: 1;">
                <strong class="font-bold">Galat!</strong>
                <span class="block sm:inline"><?= session('error') ?></span>
            </div>
            <button class="text-white hover:text-red-800 font-bold rounded-full p-2" onclick="this.parentElement.style.display='none'">
                X
            </button>
        </div>
    <?php endif; ?>
    <form method="POST" action="<?= base_url('diagnosa-penyakit') ?>">
        <?php
        $groupedData = [];

        foreach ($content as $data) {
            $daerah = $data['daerah'];
            $name = $data['gejala'];
            $gejala = $data['id'];

            if (!array_key_exists($daerah, $groupedData)) {
                $groupedData[$daerah] = [];
            }
            $groupedData[$daerah][] = [
                'gejala' => $gejala,
                'name' => $name,
            ];
        }

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
        <h2 class="text-3xl font-semibold mb-6">Diseases Probability</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <?php
            // Find the maximum probability in the array
            $maxProbability = max($diseasesProbability['percentages']);
        ?>

        <?php foreach ($diseasesProbability['percentages'] as $disease => $probability): ?>
            <div class="mb-4">
                <div class="bg-white rounded-lg shadow-lg">
                    <a href="<?= base_url('daftar-penyakit/detail/' . $disease) ?>" class="block h-48 overflow-hidden rounded-t-lg">
                    </a>
                    <div class="p-6">
                        <h5 class="text-xl font-semibold mb-2">
                            <a href="<?= base_url('daftar-penyakit/detail/' . $disease) ?>" class="text-blue-500 hover:underline"><?= $disease ?></a>
                        </h5>
                        <p class="text-gray-700">
                            <strong>Probabilitas:</strong>
                            <span style="color: <?= $probability === $maxProbability ? 'green' : 'red' ?>; font-weight: <?= $probability === $maxProbability ? 'bold' : 'bold' ?>">
                                <?= $probability ?>
                            </span>
                        </p>
                        <h6 class="text-sm font-medium mt-4 mb-2">Detail Gejala</h6>
                        <ul class="list-disc pl-4">
                            <?php foreach ($diseasesProbability['symptomDetails'][$disease] as $detail): ?>
                                <li class="mb-2">
                                    <strong>Gejala:</strong> <?= $detail['gejala'] ?><br>
                                    <strong>Bobot:</strong> <?= $detail['bobot'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
