<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/drugs/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
            + Tambah Obat
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Obat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Generik</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga (Rp)</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($drugs)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-sm text-gray-500 text-center">Belum ada data obat.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($drugs as $drug): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= esc($drug['name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($drug['generic_name'] ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <?= esc($drug['unit']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-700">
                                    <span class="text-<?= $drug['stock'] < 10 ? 'red' : 'green' ?>-600">
                                        <?= esc($drug['stock']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                    Rp. <?= number_format($drug['price'], 2, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="<?= base_url('admin/drugs/edit/' . $drug['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    
                                    <!-- Tombol Delete (Memanggil Modal) -->
                                    <button onclick="openDeleteModal(<?= $drug['id'] ?>, '<?= esc($drug['name']) ?>')" 
                                            class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Sertakan Modal Konfirmasi Delete -->
<?= $this->include('admin/drugs/delete_modal') ?>

<?= $this->endSection() ?>
