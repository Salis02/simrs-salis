<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<div class="container mx-auto p-4 max-w-5xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/prescriptions') ?>" class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-150">
            &larr; Kembali ke Daftar Resep
        </a>
    </div>

    <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
        <!-- HEADER / RINGKASAN TRANSAKSI -->
        <div class="p-6 bg-indigo-50 border-b border-indigo-200">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-sm font-medium text-indigo-700">ID Transaksi</p>
                    <p class="text-xl font-extrabold text-indigo-900">#<?= esc($prescription['id']) ?></p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Tanggal Resep</p>
                    <p class="text-md font-semibold text-gray-800"><?= date('d M Y, H:i', strtotime($prescription['prescription_date'])) ?></p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Status Pembayaran</p>
                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                        <?= $prescription['status'] == 'COMPLETED' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                        <?= esc($prescription['status']) ?>
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Kasir/Pencatat</p>
                    <p class="text-md font-semibold text-gray-800"><?= esc($user['username'] ?? 'AdminDummy') ?></p>
                </div>
            </div>
        </div>

        <!-- DETAIL PASIEN DAN DOKTER -->
        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6 border-b border-gray-200">
            <!-- Pasien -->
            <div class="md:col-span-1 border-r md:pr-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">Pasien</h3>
                <p class="text-sm text-gray-700"><strong>Nama:</strong> <?= esc($patient['name']) ?></p>
                <p class="text-sm text-gray-700"><strong>Telepon:</strong> <?= esc($patient['phone']) ?></p>
                <p class="text-sm text-gray-700"><strong>Alamat:</strong> <?= esc($patient['address']) ?></p>
            </div>
            
            <!-- Dokter -->
            <div class="md:col-span-1 border-r md:pr-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">Dokter Perujuk</h3>
                <p class="text-sm text-gray-700"><strong>Nama:</strong> <?= esc($doctor['name']) ?></p>
                <p class="text-sm text-gray-700"><strong>Spesialisasi:</strong> <?= esc($doctor['specialization']) ?></p>
                <p class="text-sm text-gray-700"><strong>Kontak:</strong> <?= esc($doctor['phone']) ?></p>
            </div>

            <!-- Catatan Resep -->
            <div class="md:col-span-1 p-3 bg-yellow-50 rounded-lg shadow-inner">
                <h3 class="text-md font-bold text-gray-800 mb-1">Catatan Dokter</h3>
                <p class="text-sm text-gray-700 italic">"<?= esc($prescription['notes'] ?? 'Tidak ada catatan tambahan.') ?>"</p>
            </div>
        </div>

        <!-- DETAIL ITEM OBAT (Tabel) -->
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-indigo-500 pb-1">Rincian Obat</h3>
            
            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg">Obat & Satuan</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aturan Pakai</th>
                            <th class="px-5 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Qty</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga Satuan</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-lg">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($items as $item): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">
                                <?= esc($item['drug_name']) ?> <span class="text-xs text-indigo-500">(<?= esc($item['unit']) ?>)</span>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-700 italic max-w-xs"><?= esc($item['dosage_instruction']) ?></td>
                            <td class="px-5 py-3 whitespace-nowrap text-center text-sm font-medium text-gray-700"><?= esc($item['quantity']) ?></td>
                            <td class="px-5 py-3 whitespace-nowrap text-right text-sm text-gray-600">Rp. <?= number_format($item['price_per_unit'], 0, ',', '.') ?></td>
                            <td class="px-5 py-3 whitespace-nowrap text-right text-sm font-extrabold text-gray-800">Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Total Transaksi -->
            <div class="flex justify-end mt-6">
                <div class="w-full max-w-sm bg-indigo-600 p-6 rounded-lg shadow-xl text-white">
                    <p class="text-xl font-semibold flex justify-between mb-1">
                        <span>Total Item:</span>
                        <span><?= count($items) ?></span>
                    </p>
                    <p class="text-3xl font-extrabold flex justify-between border-t border-indigo-400 pt-3 mt-3">
                        <span>GRAND TOTAL:</span>
                        <span>Rp. <?= number_format($prescription['total_amount'], 0, ',', '.') ?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
