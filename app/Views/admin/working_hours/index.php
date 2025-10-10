<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Jadwal Dokter</h1>
                <p class="text-gray-600 mt-1">Manajemen jadwal praktek dokter</p>
            </div>
            <div>
                <?= view('components/button', [
                    'href' => '/admin/working-hours/create',
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'text' => 'Tambah Jadwal'
                ]) ?>
            </div>
        </div>
    </div>

    <div>
        <!-- Working Hours Table -->
        <?= view('components/card', [
            'content' => view('components/table', [
                'headers' => ['Dokter', 'Tanggal', 'Jam Praktek', 'Durasi/Pasien', 'Max Pasien', 'Reservasi', 'Aksi'],
                'data' => $working_hours,
                'emptyMessage' => 'Belum ada jadwal dokter',
                'rows' => $this->include('admin/working_hours/table_rows', ['working_hours' => $working_hours])
            ])
        ]) ?>
    </div>

    <!-- Pagination -->
    <div class="mt-4 align-item justify-content-center">
        <?= $pager->links('working_hours', 'tailwind_full') ?>
    </div>
</div>
<?= $this->endSection() ?>