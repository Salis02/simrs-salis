<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<?php 
$isEdit = !empty($drug);
$action = $isEdit ? 'admin/drugs/edit/' . $drug['id'] : 'admin/drugs/create';
$validation = \Config\Services::validation();

// Daftar Satuan Obat umum
$units = ['Tablet', 'Kapsul', 'Sirup (ml)', 'Botol', 'Salep (gr)', 'Unit'];
?>

<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-6"><?= esc($title) ?></h1>

    <div class="bg-white shadow-xl rounded-lg p-6">
        <form action="<?= base_url($action) ?>" method="post">
            <?= csrf_field() ?>

            <!-- Nama Obat & Nama Generik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Obat (Dagang)</label>
                    <input type="text" id="name" name="name" value="<?= set_value('name', $isEdit ? $drug['name'] : '') ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                    <?php if ($validation->getError('name')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('name') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="generic_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Generik (Opsional)</label>
                    <input type="text" id="generic_name" name="generic_name" value="<?= set_value('generic_name', $isEdit ? $drug['generic_name'] : '') ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5">
                    <?php if ($validation->getError('generic_name')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('generic_name') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Satuan, Stok, dan Harga -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Satuan Kemasan</label>
                    <select id="unit" name="unit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                        <option value="">-- Pilih Satuan --</option>
                        <?php 
                        $selectedUnit = set_value('unit', $isEdit ? $drug['unit'] : '');
                        foreach ($units as $unit):
                        ?>
                            <option value="<?= esc($unit) ?>" <?= $selectedUnit == $unit ? 'selected' : '' ?>><?= esc($unit) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->getError('unit')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('unit') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok Tersedia</label>
                    <input type="number" id="stock" name="stock" value="<?= set_value('stock', $isEdit ? $drug['stock'] : 0) ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required min="0">
                    <?php if ($validation->getError('stock')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('stock') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga Jual (Rp)</label>
                    <input type="number" step="0.01" id="price" name="price" value="<?= set_value('price', $isEdit ? $drug['price'] : '') ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required min="0">
                    <?php if ($validation->getError('price')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('price') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi/Dosis Umum (Opsional)</label>
                <textarea id="description" name="description" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5"><?= set_value('description', $isEdit ? $drug['description'] : '') ?></textarea>
                <?php if ($validation->getError('description')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= $validation->getError('description') ?></p>
                <?php endif; ?>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="<?= base_url('admin/drugs') ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
                    <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Obat' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
