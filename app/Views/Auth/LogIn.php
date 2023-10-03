<?= $this->extend('Layout/AuthTemplate') ?>

<?= $this->section('content') ?>  

               <div class="bg-white border-2 rounded-lg px-8 pt-6 pb-8 mb-4">
                    <div class="text-3xl text-center font-semibold font-sans">Sign In</div>
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="text-center font-thin p-2 inline-block bg-red-700 text-white rounded-lg">
                            <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                    <form id="SignIn">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Username
                            </label>
                            <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 hover:bg-gray-200 hover:outline-gray-200 focus:ring focus:ring-blue-300 focus:outline-none" id="username" type="text" placeholder="Username/Email">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                Password
                            </label>
                            <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 hover:bg-gray-200 hover:outline-gray-200 focus:ring focus:ring-blue-300 focus:outline-none" id="password" type="password" placeholder="********">
                        </div>
                        <button class="bg-gray-900 text-white hover:bg-blue-500 font-bold py-2 px-4 md:py-2 md:px-6 lg:py-3 lg:px-8 rounded-lg focus:outline-none focus:shadow-outline w-full md:w-full lg:w-full" type="submit">
                            Sign In
                        </button>
                    </form>
                </div>

<?= $this->endSection() ?>