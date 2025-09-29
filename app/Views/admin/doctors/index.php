<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Dokter</h1>
                <p class="text-gray-600 mt-1">Manajemen data dokter dan spesialisasi</p>
            </div>
            <div>
                <?= view('components/button', [
                    'href' => '/admin/doctors/create',
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'text' => 'Tambah Dokter'
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Doctors Table -->
    <?= view('components/card', [
        'content' => view('components/table', [
            'headers' => ['Nama Dokter', 'Spesialisasi', 'Kontak', 'Status', 'Aksi'],
            'data' => $doctors,
            'emptyMessage' => 'Belum ada data dokter',
            'rows' => $this->include('admin/doctors/table_rows', ['doctors' => $doctors])
        ])
    ]) ?>
</div>
<?= $this->endSection() ?>