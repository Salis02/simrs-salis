<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-1">Selamat datang di sistem administrasi SIMRS RS Salis Family</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-warning-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-warning-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Reservasi Pending</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['pending_reservations'] ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-check text-primary-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Reservasi Hari Ini</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['today_reservations'] ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-success-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Antrian Hari Ini</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['today_queues'] ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-md text-purple-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Dokter Aktif</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['active_doctors'] ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-friends text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Pasien</dt>
                            <dd class="text-lg font-medium text-gray-900"><?= $stats['total_patients'] ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Current Queue Status -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-user-clock mr-2 text-primary-600"></i>
                    Status Antrian Saat Ini
                </h3>
            </div>
            <div class="p-6">
                <?php if ($current_queue): ?>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-primary-600 mb-2">
                            <?= $current_queue['queue_number'] ?>
                        </div>
                        <div class="text-lg font-medium text-gray-900 mb-1">
                            <?= $current_queue['patient_name'] ?>
                        </div>
                        <div class="text-sm text-gray-500">
                            Sedang dilayani
                        </div>
                        <div class="mt-4">
                            <button onclick="callNextQueue()" class="bg-success-600 hover:bg-success-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-arrow-right mr-2"></i>
                                Panggil Berikutnya
                            </button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center text-gray-500 py-8">
                        <i class="fas fa-user-slash text-4xl mb-4"></i>
                        <p>Tidak ada antrian yang sedang dilayani</p>
                        <div class="mt-4">
                            <button onclick="callNextQueue()" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-play mr-2"></i>
                                Mulai Antrian
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Today's Queue List -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-success-600"></i>
                    Antrian Hari Ini
                </h3>
            </div>
            <div class="max-h-80 overflow-y-auto">
                <?php if (empty($today_queues)): ?>
                    <div class="text-center text-gray-500 py-8">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <p>Tidak ada antrian hari ini</p>
                    </div>
                <?php else: ?>
                    <div class="divide-y divide-gray-200">
                        <?php foreach ($today_queues as $queue): ?>
                            <div class="p-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center font-bold text-gray-700">
                                        <?= $queue['queue_number'] ?>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900"><?= $queue['patient_name'] ?></p>
                                        <p class="text-xs text-gray-500"><?= $queue['phone'] ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <?php
                                    $statusConfig = [
                                        'waiting' => ['text' => 'Menunggu', 'class' => 'bg-yellow-100 text-yellow-800'],
                                        'serving' => ['text' => 'Dilayani', 'class' => 'bg-blue-100 text-blue-800'],
                                        'completed' => ['text' => 'Selesai', 'class' => 'bg-green-100 text-green-800'],
                                        'cancelled' => ['text' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-800'],
                                    ];
                                    $status = $statusConfig[$queue['status']] ?? $statusConfig['waiting'];
                                    ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?= $status['class'] ?>">
                                        <?= $status['text'] ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                <i class="fas fa-calendar-alt mr-2 text-warning-600"></i>
                Reservasi Terbaru
            </h3>
            <a href="/admin/reservations" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="overflow-hidden">
            <?php if (empty($recent_reservations)): ?>
                <div class="text-center text-gray-500 py-8">
                    <i class="fas fa-calendar-times text-4xl mb-4"></i>
                    <p>Tidak ada reservasi</p>
                </div>
            <?php else: ?>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasien</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach (array_slice($recent_reservations, 0, 10) as $reservation): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $reservation['patient_name'] ?></div>
                                    <div class="text-sm text-gray-500"><?= $reservation['phone'] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $reservation['doctor_name'] ?></div>
                                    <div class="text-sm text-gray-500"><?= $reservation['specialization'] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div><?= date('d M Y', strtotime($reservation['reservation_date'])) ?></div>
                                    <div class="text-gray-500"><?= date('H:i', strtotime($reservation['reservation_time'])) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusConfig = [
                                        'pending' => ['text' => 'Pending', 'class' => 'bg-yellow-100 text-yellow-800'],
                                        'approved' => ['text' => 'Disetujui', 'class' => 'bg-green-100 text-green-800'],
                                        'rejected' => ['text' => 'Ditolak', 'class' => 'bg-red-100 text-red-800'],
                                        'completed' => ['text' => 'Selesai', 'class' => 'bg-blue-100 text-blue-800'],
                                        'cancelled' => ['text' => 'Dibatalkan', 'class' => 'bg-gray-100 text-gray-800'],
                                    ];
                                    $status = $statusConfig[$reservation['status']] ?? $statusConfig['pending'];
                                    ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?= $status['class'] ?>">
                                        <?= $status['text'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <?php if ($reservation['status'] === 'pending'): ?>
                                        <button onclick="updateReservationStatus(<?= $reservation['id'] ?>, 'approved')" class="text-success-600 hover:text-success-900 mr-2">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="updateReservationStatus(<?= $reservation['id'] ?>, 'rejected')" class="text-danger-600 hover:text-danger-900">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    <?php else: ?>
                                        <a href="/admin/reservations/show/<?= $reservation['id'] ?>" class="text-primary-600 hover:text-primary-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function callNextQueue() {
    if (!confirm('Panggil antrian berikutnya?')) return;
    
    $.post('/admin/queues/call-next', function(response) {
        if (response.success) {
            showAlert(`Antrian nomor ${response.data.queue_number} berhasil dipanggil`, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(response.message, 'error');
        }
    }).fail(function(xhr) {
        showAlert('Terjadi kesalahan saat memanggil antrian', 'error');
    });
}

function updateReservationStatus(id, status) {
    const statusText = status === 'approved' ? 'menyetujui' : 'menolak';
    
    if (!confirm(`Yakin ${statusText} reservasi ini?`)) return;
    
    $.post(`/admin/reservations/update-status/${id}`, { status: status }, function(response) {
        if (response.success) {
            showAlert(response.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(response.message, 'error');
        }
    }).fail(function(xhr) {
        showAlert('Terjadi kesalahan saat mengupdate status', 'error');
    });
}

// Auto refresh every 30 seconds
setInterval(function() {
    location.reload();
}, 30000);
</script>
<?= $this->endSection() ?>