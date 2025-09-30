<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<?php 
$isEdit = !empty($user);
$action = $isEdit ? 'admin/users/edit/' . $user['id'] : 'admin/users/create';
$validation = \Config\Services::validation();
?>

<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6"><?= esc($title) ?></h1>

    <div class="bg-white shadow-xl rounded-lg p-6">
        <form action="<?= base_url($action) ?>" method="post">
            <?= csrf_field() ?>

            <!-- Full Name -->
            <div class="mb-4">
                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="full_name" name="full_name" value="<?= set_value('full_name', $isEdit ? $user['full_name'] : '') ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                <?php if ($validation->getError('full_name')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= $validation->getError('full_name') ?></p>
                <?php endif; ?>
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" value="<?= set_value('username', $isEdit ? $user['username'] : '') ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                <?php if ($validation->getError('username')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= $validation->getError('username') ?></p>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <?= $isEdit ? '(Kosongkan jika tidak ingin diubah)' : '' ?></label>
                <input type="password" id="password" name="password" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" <?= !$isEdit ? 'required' : '' ?>>
                <?php if ($validation->getError('password')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= $validation->getError('password') ?></p>
                <?php endif; ?>
            </div>

            <!-- Password Confirmation -->
            <div class="mb-6">
                <label for="pass_confirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" id="pass_confirm" name="pass_confirm" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" <?= !$isEdit ? 'required' : '' ?>>
                <?php if ($validation->getError('pass_confirm')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= $validation->getError('pass_confirm') ?></p>
                <?php endif; ?>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="<?= base_url('admin/users') ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
                    <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Administrator' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
