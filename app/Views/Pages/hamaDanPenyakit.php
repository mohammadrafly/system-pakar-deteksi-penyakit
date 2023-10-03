<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

    <div class="max-w-screen-md mx-auto">
        <div class="data-range-dropdown mt-2 flex justify-between items-center">
            <button id="openModal" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">Tambah Data</button>
        </div>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mt-5">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Kode Penyakit</th>
                    <th class="py-3 px-6 text-left">Nama Penyakit</th>
                    <th class="py-3 px-6 text-center">Jenis Tanaman</th>
                    <th class="py-3 px-6 text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach($content as $data): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap"><?= $data['kodepenyakit'] ?></td>
                    <td class="py-3 px-6 text-left whitespace-nowrap"><?= $data['namapenyakit'] ?></td>
                    <td class="py-3 px-6 text-center"><?= $data['nama_tanaman'] ?></td>
                    <td class="py-3 px-6 text-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mr-2" onclick="update(<?= $data['id'] ?>)">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md" onclick="deleteData(<?= $data['id'] ?>)">Delete</button>
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

    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-bs-toggle="modal" class="modal hidden fixed inset-0 w-full h-full items-center justify-center z-50 opacity-0 transition-opacity duration-300 transform translate-y-[-50%]">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-3/4 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto transform translate-y-0 transition-transform duration-300">

            <div class="modal-content py-4 text-left px-6">
                <h2 class="text-xl font-semibold mb-4">Tambah Data</h2>
                <form id="dataForm" class="space-y-4">
                    <div class="mb-4">
                        <label for="namaPenyakit" class="block text-gray-700 text-sm font-bold mb-2">Nama Penyakit</label>
                        <input type="text" id="namaPenyakit" name="namaPenyakit" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Nama Penyakit">
                    </div>

                    <div class="mb-4">
                        <label for="jenisTanaman" class="block text-gray-700 text-sm font-bold mb-2">Jenis Tanaman</label>
                        <select id="jenisTanaman" name="jenisTanaman" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
                            <option>Select Jenis Tanaman</option>
                            <?php foreach($jenis as $data): ?>
                            <option value="<?= $data['id'] ?>"><?= $data['jenistanaman'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="kulturTeknis" class="block text-gray-700 text-sm font-bold mb-2">Kultur Teknis</label>
                        <textarea id="kulturTeknis" name="kulturTeknis" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Kultur Teknis"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="fisikMekanis" class="block text-gray-700 text-sm font-bold mb-2">Fisik Mekanis</label>
                        <textarea id="fisikMekanis" name="fisikMekanis" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Fisik Mekanis"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="kimiawi" class="block text-gray-700 text-sm font-bold mb-2">Kimiawi</label>
                        <textarea id="kimiawi" name="kimiawi" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Kimiawi"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="hayati" class="block text-gray-700 text-sm font-bold mb-2">Hayati</label>
                        <textarea id="hayati" name="hayati" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Hayati"></textarea>
                    </div>
                    <div class="mt-4">
                        <button id="submitForm" type="button" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">Submit</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer py-4 px-6">
                <button id="closeModal" class="w-full px-4 py-2 bg-gray-400 hover:bg-gray-600 text-white font-semibold rounded-md">Close</button>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        $('#submitForm').click(function () {
            var formData = $('#dataForm').serialize();

            $.ajax({
                type: 'POST', 
                url: `${base_url}admin/hama-dan-penyakit`, 
                data: formData,
                success: function (respond) {
                    console.log(respond)
                    showAlert(respond.icon, respond.title, respond.text);
                },
                error: function (textStatus) {
                    showAlert('error', textStatus, 'Telah terjadi error');
                }
            });
        });
    });

    function deleteData(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `${base_url}admin/hama-dan-penyakit/delete/${id}`,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (respond) {
                        showAlert(respond.icon, respond.title, respond.text);
                    },
                    error: function (textStatus) {
                        showAlert('error', textStatus, 'Telah terjadi error');
                    }
                });
            } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }

    
    function update(id) {
        save_method = 'update';
        $('#dataForm')[0].reset(); 
        $.ajax({
            url : `${base_url}admin/hama-dan-penyakit/update/${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(respond)
            {
                console.log(respond)
                $('[name="namaPenyakit"]').val(respond.namapenyakit);
                $('[name="jenisTanaman"]').val(respond.jenistanaman);
                $('#myModal').modal('show');
                $('.modal-title').text('Edit Data'); 

                $('#password-input').hide();
                $('#username-input').hide();
                $('#email-input').hide();

                // Add event listener to modal close event
                $('#myModal').on('hidden.bs.modal', function () {
                    $('#dataForm')[0].reset(); // Reset the form
                    location.reload();
                });
            },
            error: function (textStatus)
            {
                alert(textStatus);
            }
        });
    }
</script>

<?= $this->endSection() ?>