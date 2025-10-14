<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/prescriptions/create') ?>" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
            + Transaksi Baru
        </a>
    </div>

    <?= view('components/card', [
        'content' => view('components/table', [
            'headers' => ['ID Transaksi', 'Tanggal', 'Pasien', 'Dokter', 'Total', 'Status', 'Aksi'],
            'data' => $prescriptions,
            'emptyMessage' => 'Belum ada data resep/penjualan.',
            'rows' => view('admin/prescriptions/table_rows', ['prescriptions' => $prescriptions])
        ])
    ]) ?>


</div>

<!-- Sertakan Modal Konfirmasi Delete -->
<?= $this->include('Admin/prescriptions/delete_modal') ?>

<?= $this->endSection() ?>