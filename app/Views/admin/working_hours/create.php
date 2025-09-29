<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex items-center space-x-4">
            <a href="/admin/working-hours" class="text-gray-600 hover:text-primary-600">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Jadwal Dokter</h1>
                <p class="text-gray-600 mt-1">Buat jadwal praktek baru</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <?= view('components/card', [
        'content' => $this->include('admin/working_hours/form', [
            'working_hour' => null, 
            'doctors' => $doctors,
            'action' => '/admin/working-hours/create'
        ])
    ]) ?>
</div>
<?= $this->endSection() ?>