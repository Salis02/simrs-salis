<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/prescriptions/create') ?>" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
            + Transaksi Baru
        </a>
    </div>

    <!-- Message Flashdata -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($prescriptions)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-sm text-gray-500 text-center">Belum ada data resep/penjualan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($prescriptions as $p): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">#<?= esc($p['id']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d M Y, H:i', strtotime($p['prescription_date'])) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= esc($p['patient_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= esc($p['doctor_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-green-700">Rp. <?= number_format($p['total_amount'], 0, ',', '.') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?= $p['status'] == 'COMPLETED' ? 'bg-green-100 text-green-800' : ($p['status'] == 'CANCELLED' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') ?>">
                                        <?= esc($p['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="<?= base_url('admin/prescriptions/view/' . $p['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat</a>
                                    
                                    <!-- Tombol Delete (Hanya jika belum CANCELLED) -->
                                    <?php if ($p['status'] != 'CANCELLED'): ?>
                                    <button onclick="openDeleteModal(<?= $p['id'] ?>, '<?= esc($p['patient_name']) ?>')" 
                                            class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                    <?php endif; ?>
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
<?= $this->include('Admin/prescriptions/delete_modal') ?>

<?= $this->endSection() ?>
