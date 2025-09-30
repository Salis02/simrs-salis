<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-8">
    <div class="border-b border-gray-200 pb-5 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">Detail Reservasi</h1>
            <p class="text-gray-500 mt-1">Informasi lengkap dan status janji temu pasien.</p>
        </div>
        <a href="/admin/reservations"
            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="bg-white shadow-lg border border-gray-100 rounded-xl overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-200">
            
            <div class="p-8 space-y-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center mb-4">
                    <i class="fas fa-user-circle text-primary-500 mr-3"></i>Data Pasien
                </h3>
                <dl class="text-sm space-y-3">
                    <div class="flex flex-col">
                        <dt class="font-semibold text-gray-500">Nama Lengkap</dt>
                        <dd class="text-gray-900 text-base"><?= esc($reservation['patient_name']) ?></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="font-semibold text-gray-500">Nomor Telepon</dt>
                        <dd class="text-gray-900 text-base"><?= esc($reservation['phone']) ?></dd>
                    </div>
                    </dl>
            </div>

            <div class="p-8 space-y-4 lg:col-span-2">
                <h3 class="text-lg font-bold text-gray-800 flex items-center mb-4">
                    <i class="fas fa-calendar-check text-primary-500 mr-3"></i>Detail Janji Temu
                </h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-4 text-sm">
                    
                    <div class="flex flex-col">
                        <dt class="font-semibold text-gray-500">Dokter & Spesialisasi</dt>
                        <dd class="text-gray-900 text-base">
                            <?= esc($reservation['doctor_name']) ?> <span class="text-xs text-gray-500">(<?= esc($reservation['specialization']) ?>)</span>
                        </dd>
                    </div>
                    
                    <div class="flex flex-col">
                        <dt class="font-semibold text-gray-500">Tanggal & Waktu</dt>
                        <dd class="text-gray-900 text-base font-mono">
                            <?= date('d M Y', strtotime($reservation['reservation_date'])) ?> pada <?= esc($reservation['reservation_time']) ?>
                        </dd>
                    </div>

                    <div class="flex flex-col sm:col-span-2">
                        <dt class="font-semibold text-gray-500">Status Reservasi</dt>
                        <dd class="mt-1">
                            <span class="px-3 py-1.5 font-bold text-xs rounded-full shadow-sm
                                <?= match(strtolower($reservation['status'])) {
                                    'pending'   => 'bg-yellow-100 text-yellow-800',
                                    'approved'  => 'bg-green-100 text-green-800',
                                    'rejected'  => 'bg-red-100 text-red-800',
                                    'completed' => 'bg-blue-100 text-blue-800',
                                    default     => 'bg-gray-100 text-gray-800',
                                } ?>">
                                <?= strtoupper($reservation['status']) ?>
                            </span>
                        </dd>
                    </div>

                    <?php if (!empty($reservation['notes'])): ?>
                        <div class="flex flex-col sm:col-span-2 pt-4 border-t border-gray-100">
                            <dt class="font-semibold text-gray-500">Catatan Pasien</dt>
                            <dd class="text-gray-700 text-base italic mt-1 p-3 bg-gray-50 rounded-md border border-gray-200">
                                <?= esc($reservation['notes']) ?>
                            </dd>
                        </div>
                    <?php endif; ?>
                </dl>
            </div>
        </div>

        <!-- <div class="bg-gray-50 p-6 flex justify-end">
            <a href="/admin/reservations/edit/<?= $reservation['id'] ?>"
                class="px-5 py-2 text-sm font-medium bg-primary-600 text-white rounded-lg shadow-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i class="fas fa-edit mr-2"></i>Kelola/Edit Reservasi
            </a>
        </div> -->
    </div>
</div>
<?= $this->endSection() ?>