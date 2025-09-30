<form id="statusForm" class="space-y-4">
    <input type="hidden" name="reservation_id">
    
    <?= view('components/form/select', [
        'name' => 'status',
        'label' => 'Status',
        'options' => [
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ],
        'required' => true
    ]) ?>

    <?= view('components/form/textarea', [
        'name' => 'notes',
        'label' => 'Catatan (Opsional)',
        'placeholder' => 'Tambahkan catatan jika diperlukan',
        'rows' => 3
    ]) ?>

    <div class="flex justify-end space-x-3">
        <button type="button" onclick="closeModal('statusModal')" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
            Batal
        </button>
        <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
            Update Status
        </button>
    </div>
</form>

<script>
$('#statusForm').on('submit', function(e) {
    e.preventDefault();
    
    const reservationId = $('input[name="reservation_id"]').val();

     
    // Gunakan .serialize() untuk mendapatkan semua data form sebagai string
    const formData = $(this).serialize(); // Ini akan mengambil reservation_id, status, dan notes
    
    // Perhatikan: Anda TIDAK perlu lagi mengambil status dan notes secara terpisah
    
    $.post(`/admin/reservations/update-status/${reservationId}`, formData, function(response) {
        if (response.success) {
            showAlert(response.message, 'success');
            closeModal('statusModal');
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(response.message, 'error');
        }
    }).fail(function() {
        showAlert('Terjadi kesalahan saat mengupdate status', 'error');
    });
});
</script>