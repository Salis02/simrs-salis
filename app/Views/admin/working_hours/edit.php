<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('main') ?>
<!-- Page Header -->
<div class="border-b border-gray-200 pb-4">
    <div class="flex items-center space-x-4">
        <a href="/admin/working-hours" class="text-gray-600 hover:text-primary-600">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Jadwal Dokter</h1>
            <p class="text-gray-600 mt-1">Edit jadwal praktek dokter</p>
        </div>
    </div>
</div>
<!-- Form -->
<form method="POST" action="<?= $action ?>" class="space-y-6">
    <?= csrf_field() ?>
    <?php if ($working_hour): ?>
        <!-- Digunakan CodeIgniter untuk mensimulasikan metode PUT/PATCH -->
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= view('components/form/select', [
            'name' => 'doctor_id',
            'label' => 'Pilih Dokter',
            'options' => array_column($doctors, 'name', 'id'),
            // Menggunakan key 'doctor_id' dari data lama
            'selected' => old('doctor_id', $working_hour['doctor_id'] ?? ''),
            'placeholder' => 'Pilih dokter',
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'date',
            'name' => 'date',
            'label' => 'Tanggal',
            // MEMPERBAIKI: Menggunakan key 'date' (sesuai referensi Anda) atau default hari ini.
            'value' => old('date', $working_hour['date'] ?? date('Y-m-d')),
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'time',
            'name' => 'start_time',
            'label' => 'Jam Mulai',
            'value' => old('start_time', $working_hour['start_time'] ?? '08:00'),
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'time',
            'name' => 'end_time',
            'label' => 'Jam Selesai',
            'value' => old('end_time', $working_hour['end_time'] ?? '12:00'),
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'number',
            'name' => 'duration_per_patient',
            'label' => 'Durasi per Pasien (menit)',
            'value' => old('duration_per_patient', $working_hour['duration_per_patient'] ?? 30),
            'required' => true,
            'attributes' => 'min="15" max="120"'
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'number',
            'name' => 'max_patients',
            'label' => 'Maksimal Pasien',
            'value' => old('max_patients', $working_hour['max_patients'] ?? 10),
            'required' => true,
            'attributes' => 'min="1" max="50"'
        ]) ?>
    </div>

    <div class="border-t border-gray-200 pt-4">
        <label class="flex items-center">
            <?php
            // Mengambil nilai lama (old data) atau dari data existing ('is_available_for_reservation' atau 'is_active'), default true
            // Saya berasumsi is_available_for_reservation di form mapping ke is_active di DB.
            $isChecked = old(
                'is_available_for_reservation',
                ($working_hour) ? ($working_hour['is_available_for_reservation'] ?? $working_hour['is_active'] ?? true) : true
            );
            ?>
            <input type="checkbox" name="is_available_for_reservation" value="1"
                <?= ($isChecked) ? 'checked' : '' ?>
                class="mr-2 h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
            <span class="text-sm text-gray-700">Tersedia untuk reservasi online</span>
        </label>
        <p class="text-xs text-gray-500 mt-1">Jika tidak dicentang, jadwal ini hanya untuk walk-in/antrian langsung</p>
    </div>

    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
        <a href="/admin/working-hours" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
            Batal
        </a>
        <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i>
            <?= $working_hour ? 'Update' : 'Simpan' ?>
        </button>
    </div>
</form>
<?= $this->endSection() ?>