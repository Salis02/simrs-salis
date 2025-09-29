<form method="POST" action="<?= $action ?>" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= view('components/form/select', [
            'name' => 'doctor_id',
            'label' => 'Pilih Dokter',
            'options' => array_column($doctors, 'name', 'id'),
            'value' => $working_hour['doctor_id'] ?? '',
            'placeholder' => 'Pilih dokter',
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'date',
            'name' => 'date',
            'label' => 'Tanggal',
            'value' => $working_hour['date'] ?? date('Y-m-d'),
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'time',
            'name' => 'start_time',
            'label' => 'Jam Mulai',
            'value' => $working_hour['start_time'] ?? '08:00',
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'time',
            'name' => 'end_time',
            'label' => 'Jam Selesai',
            'value' => $working_hour['end_time'] ?? '12:00',
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'number',
            'name' => 'duration_per_patient',
            'label' => 'Durasi per Pasien (menit)',
            'value' => $working_hour['duration_per_patient'] ?? 30,
            'required' => true,
            'attributes' => 'min="15" max="120"'
        ]) ?>

        <?= view('components/form/input', [
            'type' => 'number',
            'name' => 'max_patients',
            'label' => 'Maksimal Pasien',
            'value' => $working_hour['max_patients'] ?? 10,
            'required' => true,
            'attributes' => 'min="1" max="50"'
        ]) ?>
    </div>

    <div class="border-t border-gray-200 pt-4">
        <label class="flex items-center">
            <input type="checkbox" name="is_available_for_reservation" value="1" 
                   <?= (!$working_hour || $working_hour['is_available_for_reservation']) ? 'checked' : '' ?>
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