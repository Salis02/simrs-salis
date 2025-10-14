<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/drugs/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
            + Tambah Obat
        </a>
    </div>


    <?= view('components/card', [
        'content' => view('components/table', [
            'headers' => ['Nama Obat', 'Nama Generik', 'Satuan', 'Stok', 'Harga (Rp)', 'Aksi'],
            'data' => $drugs,
            'emptyMessage' => 'Belum ada data obat.',
            'rows' => view('admin/drugs/table_rows', ['drugs' => $drugs])
        ])
    ]) ?>

</div>

<!-- Sertakan Modal Konfirmasi Delete -->
<?= $this->include('admin/drugs/delete_modal') ?>

<?= $this->endSection() ?>