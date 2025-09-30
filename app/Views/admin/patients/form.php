<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<?php 
$isEdit = !empty($patient);
$action = $isEdit ? 'admin/patients/edit/' . $patient['id'] : 'admin/patients/create';
$validation = \Config\Services::validation();
?>

<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-6"><?= esc($title) ?></h1>

    <div class="bg-white shadow-xl rounded-lg p-6">
        <form action="<?= base_url($action) ?>" method="post">
            <?= csrf_field() ?>

            <!-- Baris 1: Nama dan No. Telepon -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pasien</label>
                    <input type="text" id="name" name="name" value="<?= set_value('name', $isEdit ? $patient['name'] : '') ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                    <?php if ($validation->getError('name')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('name') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value="<?= set_value('phone', $isEdit ? $patient['phone'] : '') ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                    <?php if ($validation->getError('phone')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('phone') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Baris 2: Tanggal Lahir dan Gender -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir (Opsional)</label>
                    <input type="date" id="birth_date" name="birth_date" value="<?= set_value('birth_date', $isEdit ? $patient['birth_date'] : '') ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5">
                    <?php if ($validation->getError('birth_date')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('birth_date') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <?php 
                        $selectedGender = set_value('gender', $isEdit ? $patient['gender'] : '');
                        ?>
                        <option value="male" <?= $selectedGender == 'male' ? 'selected' : '' ?>>Laki-laki (Male)</option>
                        <option value="female" <?= $selectedGender == 'female' ? 'selected' : '' ?>>Perempuan (Female)</option>
                    </select>
                    <?php if ($validation->getError('gender')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('gender') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat (Opsional)</label>
                <textarea id="address" name="address" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5"><?= set_value('address', $isEdit ? $patient['address'] : '') ?></textarea>
                <?php if ($validation->getError('address')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= $validation->getError('address') ?></p>
                <?php endif; ?>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="<?= base_url('admin/patients') ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
                    <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Pasien' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
