<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<div class="container mx-auto p-4 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/prescriptions') ?>" class="text-indigo-600 hover:text-indigo-800">
            &larr; Kembali ke Daftar Resep
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-lg p-6">
        <!-- Header Informasi Transaksi -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 border-b pb-4 mb-4">
            <div>
                <p class="text-sm font-medium text-gray-500">ID Transaksi</p>
                <p class="text-lg font-semibold text-indigo-700">#<?= esc($prescription['id']) ?></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Tanggal</p>
                <p class="text-md text-gray-800"><?= date('d M Y H:i', strtotime($prescription['prescription_date'])) ?></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Status</p>
                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                    <?= $prescription['status'] == 'COMPLETED' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                    <?= esc($prescription['status']) ?>
                </span>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Dicatat Oleh</p>
                <p class="text-md text-gray-800"><?= esc($user['username'] ?? 'AdminDummy') ?></p>
            </div>
        </div>

        <!-- Detail Pasien dan Dokter -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Detail Pasien</h3>
                <p><strong>Nama:</strong> <?= esc($patient['name']) ?></p>
                <p><strong>Telepon:</strong> <?= esc($patient['phone']) ?></p>
                <p><strong>Alamat:</strong> <?= esc($patient['address']) ?></p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Dokter Perujuk</h3>
                <p><strong>Nama:</strong> <?= esc($doctor['name']) ?></p>
                <p><strong>Spesialisasi:</strong> <?= esc($doctor['specialization']) ?></p>
                <p><strong>Kontak:</strong> <?= esc($doctor['phone']) ?></p>
            </div>
        </div>

        <!-- Catatan Resep -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-700 mb-1">Catatan Tambahan Dokter</h3>
            <p class="text-gray-600 italic"><?= esc($prescription['notes'] ?? 'Tidak ada catatan tambahan.') ?></p>
        </div>

        <!-- Detail Item Obat -->
        <h3 class="text-xl font-bold text-gray-800 mb-4">Item Obat</h3>
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Obat</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aturan Pakai</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?= esc($item['drug_name']) ?> <span class="text-xs text-gray-500">(<?= esc($item['unit']) ?>)</span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700"><?= esc($item['dosage_instruction']) ?></td>
                        <td class="px-4 py-2 whitespace-nowrap text-center text-sm text-gray-500"><?= esc($item['quantity']) ?></td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm text-gray-500">Rp. <?= number_format($item['price_per_unit'], 0, ',', '.') ?></td>
                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-bold text-gray-800">Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Total Transaksi -->
        <div class="flex justify-end mt-4">
            <div class="w-full max-w-xs bg-indigo-50 p-4 rounded-lg shadow-inner">
                <p class="text-xl font-bold text-gray-800 flex justify-between">
                    <span>TOTAL TRANSAKSI:</span>
                    <span class="text-green-600">Rp. <?= number_format($prescription['total_amount'], 0, ',', '.') ?></span>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
