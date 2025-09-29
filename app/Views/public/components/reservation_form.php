<form id="reservationForm" method="post" action="/reservation/create" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Patient Information -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Pasien</h3>
            
            <?= view('components/form/input', [
                'name' => 'patient_name',
                'label' => 'Nama Lengkap',
                'placeholder' => 'Masukkan nama lengkap',
                'required' => true
            ]) ?>

            <?= view('components/form/input', [
                'name' => 'patient_phone',
                'label' => 'Nomor Telepon',
                'placeholder' => 'Contoh: 081234567890',
                'required' => true
            ]) ?>

            <?= view('components/form/select', [
                'name' => 'patient_gender',
                'label' => 'Jenis Kelamin',
                'options' => [
                    'male' => 'Laki-laki',
                    'female' => 'Perempuan'
                ],
                'placeholder' => 'Pilih jenis kelamin',
                'required' => true
            ]) ?>

            <?= view('components/form/input', [
                'name' => 'patient_birth_date',
                'type' => 'date',
                'label' => 'Tanggal Lahir',
                'help' => 'Opsional'
            ]) ?>

            <?= view('components/form/textarea', [
                'name' => 'patient_address',
                'label' => 'Alamat',
                'placeholder' => 'Masukkan alamat lengkap',
                'rows' => 3,
                'help' => 'Opsional'
            ]) ?>
        </div>

        <!-- Reservation Details -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Detail Reservasi</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih Dokter & Jadwal <span class="text-danger-500">*</span>
                </label>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    <?php if (empty($available_doctors)): ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-2"></i>
                            <p>Tidak ada jadwal dokter yang tersedia</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($available_doctors as $doctor): ?>
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-primary-300 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-900"><?= $doctor['name'] ?></h4>
                                        <p class="text-sm text-gray-600"><?= $doctor['specialization'] ?></p>
                                        <p class="text-sm text-primary-600 mt-1">
                                            <i class="fas fa-calendar mr-1"></i>
                                            <?= date('d M Y', strtotime($doctor['date'])) ?> 
                                            (<?= date('H:i', strtotime($doctor['start_time'])) ?> - <?= date('H:i', strtotime($doctor['end_time'])) ?>)
                                        </p>
                                    </div>
                                    <div>
                                        <input type="radio" name="working_hour_id" value="<?= $doctor['id'] ?>" 
                                               class="w-4 h-4 text-primary-600 focus:ring-primary-500 border-gray-300" 
                                               onchange="loadAvailableSlots(<?= $doctor['id'] ?>)">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div id="timeSlotContainer" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih Waktu <span class="text-danger-500">*</span>
                </label>
                <div id="timeSlots" class="grid grid-cols-2 gap-2">
                    <!-- Time slots will be loaded here -->
                </div>
            </div>

            <?= view('components/form/textarea', [
                'name' => 'notes',
                'label' => 'Catatan',
                'placeholder' => 'Keluhan atau catatan tambahan (opsional)',
                'rows' => 3
            ]) ?>
        </div>
    </div>

    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="resetForm()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
            Reset
        </button>
        <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
            <i class="fas fa-paper-plane mr-2"></i>
            Kirim Reservasi
        </button>
    </div>
</form>

<script>
function loadAvailableSlots(workingHourId) {
    $('#timeSlotContainer').addClass('hidden');
    $('#timeSlots').html('<div class="col-span-2 text-center py-4"><i class="fas fa-spinner fa-spin"></i> Memuat...</div>');
    
    $.get('/available-slots', { working_hour_id: workingHourId }, function(response) {
        if (response.success && response.data.slots.length > 0) {
            let slotsHtml = '';
            response.data.slots.forEach(function(slot) {
                slotsHtml += `
                    <label class="flex items-center p-3 border border-gray-200 rounded-md hover:border-primary-300 cursor-pointer">
                        <input type="radio" name="reservation_time" value="${slot}" class="mr-2 text-primary-600">
                        <span class="text-sm">${slot.substr(0,5)}</span>
                    </label>
                `;
            });
            $('#timeSlots').html(slotsHtml);
            $('#timeSlotContainer').removeClass('hidden');
        } else {
            $('#timeSlots').html('<div class="col-span-2 text-center py-4 text-gray-500">Tidak ada slot waktu yang tersedia</div>');
            $('#timeSlotContainer').removeClass('hidden');
        }
    });
}

function resetForm() {
    $('#reservationForm')[0].reset();
    $('#timeSlotContainer').addClass('hidden');
}

$('#reservationForm').on('submit', function(e) {
    debugger;
    e.preventDefault();
    
    const formData = {
        patient_name: $('[name="patient_name"]').val(),
        patient_phone: $('[name="patient_phone"]').val(),
        patient_gender: $('[name="patient_gender"]').val(),
        patient_birth_date: $('[name="patient_birth_date"]').val(),
        patient_address: $('[name="patient_address"]').val(),
        working_hour_id: $('[name="working_hour_id"]:checked').val(),
        reservation_time: $('[name="reservation_time"]:checked').val(),
        notes: $('[name="notes"]').val()
    };
    
    // Validation
    if (!formData.patient_name || !formData.patient_phone || !formData.patient_gender || !formData.working_hour_id || !formData.reservation_time) {
        showAlert('Mohon lengkapi semua field yang wajib diisi', 'error');
        return;
    }
    
    // Submit
    const submitBtn = $('[type="submit"]');
    const originalText = submitBtn.html();
    submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...').prop('disabled', true);
    
    $.ajax({
        url: '/reservation/create',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                resetForm();
            } else {
                showAlert(response.message, 'error');
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            if (response && response.errors) {
                let errorMsg = 'Terjadi kesalahan:\n';
                for (let field in response.errors) {
                    errorMsg += '- ' + response.errors[field] + '\n';
                }
                showAlert(errorMsg, 'error');
            } else {
                showAlert('Terjadi kesalahan, silakan coba lagi', 'error');
            }
        },
        complete: function() {
            submitBtn.html(originalText).prop('disabled', false);
        }
    });
});
</script>