<form method="POST" action="<?= $action ?>" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= view('components/form/input', [
            'name' => 'name',
            'label' => 'Nama Lengkap',
            'placeholder' => 'Masukkan nama lengkap dokter',
            'value' => $doctor['name'] ?? '',
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'specialization',
            'label' => 'Spesialisasi',
            'placeholder' => 'Contoh: Penyakit Dalam, Anak, dll',
            'value' => $doctor['specialization'] ?? '',
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'phone',
            'label' => 'Nomor Telepon',
            'placeholder' => 'Contoh: 081234567890',
            'value' => $doctor['phone'] ?? '',
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email',
            'placeholder' => 'contoh@email.com',
            'value' => $doctor['email'] ?? '',
        ]) ?>
    </div>

    <?php if ($doctor): ?>
        <?= view('components/form/select', [
            'name' => 'is_active',
            'label' => 'Status',
            'options' => [
                '1' => 'Aktif',
                '0' => 'Tidak Aktif'
            ],
            'value' => $doctor['is_active'] ?? 1,
            'placeholder' => 'Pilih status',
            'required'    => true
        ]) ?>
    <?php endif; ?>

    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
        <a href="/admin/doctors" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
            Batal
        </a>
        <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i>
            <?= $doctor ? 'Update' : 'Simpan' ?>
        </button>
    </div>
</form>