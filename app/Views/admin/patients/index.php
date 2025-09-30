<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/patients/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
            + Tambah Pasien
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl. Lahir</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($patients)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-sm text-gray-500 text-center">Belum ada data pasien.</td>
                        </tr>
                    <?php else: ?>
                        <?php $i=1; ?>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $i++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= esc($patient['name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($patient['phone']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?= $patient['gender'] == 'male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' ?>">
                                        <?= esc(ucfirst($patient['gender'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($patient['birth_date'] ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="<?= base_url('admin/patients/edit/' . $patient['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    
                                    <!-- Tombol Delete (Memanggil Modal) -->
                                    <button onclick="openDeleteModal(<?= $patient['id'] ?>, '<?= esc($patient['name']) ?>')" 
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
<?= $this->include('Admin/patients/delete_modal') ?>

<?= $this->endSection() ?>
