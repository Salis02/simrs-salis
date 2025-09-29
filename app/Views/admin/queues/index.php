<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Antrian</h1>
                <p class="text-gray-600 mt-1">Manajemen antrian walk-in pasien</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="callNextQueue()" class="bg-success-600 hover:bg-success-700 text-white px-4 py-2 rounded-md font-medium">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Panggil Berikutnya
                </button>
            </div>
        </div>
    </div>

    <!-- Current Queue Status -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="text-center">
                <div class="text-3xl font-bold text-primary-600 mb-2">
                    <?= $current_queue ? $current_queue['queue_number'] : '-' ?>
                </div>
                <div class="text-lg font-medium text-gray-900 mb-1">
                    <?= $current_queue ? $current_queue['patient_name'] : 'Tidak ada' ?>
                </div>
                <div class="text-sm text-gray-500">Sedang Dilayani</div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="text-center">
                <div class="text-3xl font-bold text-warning-600 mb-2">
                    <?= count(array_filter($queues, fn($q) => $q['status'] === 'waiting')) ?>
                </div>
                <div class="text-lg font-medium text-gray-900 mb-1">Menunggu</div>
                <div class="text-sm text-gray-500">Antrian</div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="text-center">
                <div class="text-3xl font-bold text-success-600 mb-2">
                    <?= count(array_filter($queues, fn($q) => $q['status'] === 'completed')) ?>
                </div>
                <div class="text-lg font-medium text-gray-900 mb-1">Selesai</div>
                <div class="text-sm text-gray-500">Hari Ini</div>
            </div>
        </div>
    </div>

    <!-- Date Filter -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <form method="GET" class="flex items-end space-x-4">
            <?= view('components/form/input', [
                'type' => 'date',
                'name' => 'date',
                'label' => 'Filter Tanggal',
                'value' => $filter_date,
                'containerClass' => 'mb-0'
            ]) ?>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                <i class="fas fa-filter mr-2"></i>Filter
            </button>
            <a href="/admin/queues" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                Hari Ini
            </a>
        </form>
    </div>

    <!-- Queues Table -->
    <?= view('components/card', [
        'header' => 'Daftar Antrian - ' . date('d M Y', strtotime($filter_date)),
        'content' => view('components/table', [
            'headers' => ['No. Antrian', 'Pasien', 'Waktu Ambil', 'Status', 'Aksi'],
            'data' => $queues,
            'emptyMessage' => 'Tidak ada antrian pada tanggal ini',
            'rows' => $this->include('admin/queues/table_rows', ['queues' => $queues])
        ])
    ]) ?>
</div>
<?= $this->endSection() ?>