<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex items-center space-x-4">
            <a href="/admin/doctors" class="text-gray-600 hover:text-primary-600">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Dokter</h1>
                <p class="text-gray-600 mt-1">Tambahkan dokter baru ke sistem</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <?= view('components/card', [
        'content' => $this->include('admin/doctors/form', ['doctor' => null, 'action' => '/admin/doctors/create'])
    ]) ?>
</div>
<?= $this->endSection() ?>