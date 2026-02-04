<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900"><?= esc($title) ?></h1>
                <p class="text-gray-600 mt-1">Manajemen data pasien</p>
            </div>
            <div class="flex space-x-3">
                <!-- Search Form -->
                <form method="get" action="<?= base_url('admin/patients') ?>" class="flex items-center">
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>"
                        placeholder="Cari nama / no. telepon"
                        class="border border-gray-300 rounded-l-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary-500" />
                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-4 py-2 rounded-r-lg">
                        Cari
                    </button>
                </form>

                <?php if (!empty($search)): ?>
                    <?= view('components/button', [
                        'href' => base_url('admin/patients'),
                        'variant' => 'secondary',
                        'icon' => 'fas fa-redo',
                        'text' => 'Reset'
                    ]) ?>
                <?php endif; ?>

                <?= view('components/button', [
                    'href' => base_url('admin/patients/create'),
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'text' => 'Tambah Pasien'
                ]) ?>
            </div>
        </div>
    </div>

    <div>
        <!-- Patients Table -->
        <?= view('components/card', [
            'content' => view('components/table', [
                'headers' => ['ID', 'Nama Pasien', 'No. Telepon', 'Gender', 'Tgl. Lahir', 'Aksi'],
                'data' => $patients,
                'emptyMessage' => 'Belum ada data pasien',
                'rows' => $this->include('admin/patients/table_rows', ['patients' => $patients])
            ])
        ]) ?>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-center">
        <?= $pager->links('patients', 'tailwind_full', ['search' => $search]) ?>
    </div>
</div>

<!-- Sertakan Modal Konfirmasi Delete -->
<?= $this->include('admin/patients/delete_modal') ?>

<?= $this->endSection() ?>