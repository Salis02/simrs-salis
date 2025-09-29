<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Reservasi</h1>
                <p class="text-gray-600 mt-1">Manajemen reservasi dokter dari pasien</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <?= view('components/form/select', [
                    'name' => 'status',
                    'label' => 'Filter Status',
                    'options' => [
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan'
                    ],
                    'value' => $filter['status'] ?? '',
                    'placeholder' => 'Semua Status',
                    'containerClass' => 'mb-0'
                ]) ?>
            </div>
            <div class="flex-1">
                <?= view('components/form/input', [
                    'type' => 'date',
                    'name' => 'date',
                    'label' => 'Filter Tanggal',
                    'value' => $filter['date'] ?? '',
                    'containerClass' => 'mb-0'
                ]) ?>
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 mr-2">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <a href="/admin/reservations" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Reservations Table -->
    <?= view('components/card', [
        'content' => view('components/table', [
            'headers' => ['Pasien', 'Dokter', 'Tanggal & Waktu', 'Status', 'Aksi'],
            'data' => $reservations,
            'emptyMessage' => 'Tidak ada reservasi ditemukan',
            'rows' => $this->include('admin/reservations/table_rows', ['reservations' => $reservations])
        ])
    ]) ?>
</div>

<!-- Status Update Modal -->
<?= view('components/modal', [
    'id' => 'statusModal',
    'title' => 'Update Status Reservasi',
    'content' => $this->include('admin/reservations/status_modal')
]) ?>
<?= $this->endSection() ?>