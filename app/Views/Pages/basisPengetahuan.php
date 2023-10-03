<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

    <div class="max-w-screen-md mx-auto">
        <div class="data-range-dropdown mt-2 flex justify-between items-center">
            <button id="openModal" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">Tambah Data</button>
        </div>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mt-5">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-center">No</th>
                    <th class="py-3 px-6 text-center">Nama Penyakit</th>
                    <th class="py-3 px-6 text-center">Gejala</th>
                    <th class="py-3 px-6 text-center">Nilai Bobot</th>
                    <th class="py-3 px-6 text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php 
                $no = 1;
                foreach($content as $data): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-center"><?= $no++ ?></td>
                    <td class="py-3 px-6 text-center"><?= $data['namapenyakit'] ?></td>
                    <td class="py-3 px-6 text-center"><?= $data['gejala'] ?></td>
                    <td class="py-3 px-6 text-center"><?= $data['nilaibobot'] ?></td>
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
                        <select id="namaPenyakit" name="namaPenyakit" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
                            <option>Select Nama Penyakit</option>
                            <?php foreach($penyakit as $data): ?>
                            <option value="<?= $data['namapenyakit'] ?>"><?= $data['namapenyakit'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="gejala" class="block text-gray-700 text-sm font-bold mb-2">Gejala</label>
                        <select id="gejala" name="gejala" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
                            <option>Select Gejala</option>
                            <?php foreach($gejala as $data): ?>
                            <option value="<?= $data['id'] ?>"><?= $data['gejala'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="nilaibobot" class="block text-gray-700 text-sm font-bold mb-2">Nilai Bobot</label>
                        <input type="text" id="nilaibobot" name="nilaibobot" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" placeholder="Enter Gejala">
                    </div>
                    <div class="mt-4">
                        <button id="submitForm" type="button" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">Submit</button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
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
                url: `${base_url}admin/basis-pengetahuan`, 
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
                    url: `${base_url}admin/basis-pengetahuan/delete/${id}`,
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
            url : `${base_url}admin/basis-pengetahuan/update/${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(respond)
            {
                console.log(respond)
                $('[name="namaPenyakit"]').val(respond.namaPenyakit);
                $('[name="nilaibobot"]').val(respond.nilaibobot);
                $('[name="gejala"]').val(respond.gejala);
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