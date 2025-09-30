<div class="text-center mb-6">
    <div class="bg-primary-50 rounded-lg p-6 mb-6">
        <i class="fas fa-clock text-primary-600 text-2xl mb-2"></i>
        <h3 class="text-lg font-semibold text-gray-900">Jam Operasional Antrian</h3>
        <p class="text-gray-600 mt-2">Senin - Sabtu: 08:00 - 16:00</p>
        <p class="text-sm text-gray-500 mt-1">Antrian hanya dapat diambil pada jam operasional</p>
    </div>
</div>

<form id="queueForm" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= view('components/form/input', [
            'name' => 'patient_name',
            'type' => 'text',
            'label' => 'Nama Lengkap',
            'placeholder' => 'Masukkan nama lengkap',
            'required' => true
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'patient_phone',
            'type' => 'tel',
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
    </div>

    <?= view('components/form/textarea', [
        'name' => 'patient_address',
        'label' => 'Alamat',
        'placeholder' => 'Masukkan alamat lengkap (opsional)',
        'rows' => 3
    ]) ?>

    <div class="flex justify-center space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="resetQueueForm()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
            Reset
        </button>
        <button type="submit" class="px-8 py-2 bg-success-600 text-white rounded-md hover:bg-success-700">
            <i class="fas fa-ticket-alt mr-2"></i>
            Ambil Nomor Antrian
        </button>
    </div>
</form>

<script>
    function resetQueueForm() {
        $('#queueForm')[0].reset();
    }

    $('#queueForm').on('submit', function(e) {
        e.preventDefault();

        // const formData = {
        //     patient_name: $('[name="patient_name"]').val(),
        //     patient_phone: $('[name="patient_phone"]').val(),
        //     patient_gender: $('[name="patient_gender"]').val(),
        //     patient_birth_date: $('[name="patient_birth_date"]').val(),
        //     patient_address: $('[name="patient_address"]').val()
        // };

        const formData = {};
        $(this).serializeArray().forEach(item => {
            formData[item.name] = item.value;
        });
        console.log('DEBUG formData:', formData);
        // Validation
        if (!formData.patient_name || !formData.patient_phone || !formData.patient_gender) {
            showAlert('Mohon lengkapi semua field yang wajib diisi', 'error');
            return;
        }

        // Submit
        const submitBtn = $('[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Mengambil antrian...').prop('disabled', true);

        $.ajax({
            url: '/queue/take',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    showAlert(`Berhasil mengambil antrian nomor ${data.queue_number} atas nama ${data.patient_name}`, 'success');
                    resetQueueForm();
                    // Reload page after 2 seconds to update queue display
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
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

    // Check if current time is within working hours
    function checkWorkingHours() {
        const now = new Date();
        const currentHour = now.getHours();
        const currentDay = now.getDay(); // 0 = Sunday

        // Check if it's Sunday or outside working hours (8 AM - 4 PM)
        if (currentDay === 0 || currentHour < 8 || currentHour >= 16) {
            $('#queueForm button[type="submit"]').prop('disabled', true).addClass('opacity-50');
            showAlert('Antrian hanya dapat diambil pada jam kerja (Senin-Sabtu, 08:00-16:00)', 'warning');
        }
    }

    // Check working hours on page load
    $(document).ready(function() {
        checkWorkingHours();
    });
</script>