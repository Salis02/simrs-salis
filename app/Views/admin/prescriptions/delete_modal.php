<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-sm mx-4">
        <h2 class="text-xl font-bold text-red-600 mb-4">Konfirmasi Pembatalan Transaksi</h2>
        <p class="text-gray-700 mb-6">Anda yakin ingin membatalkan transaksi resep untuk pasien <strong id="patientNameToDelete"></strong>? Aksi ini akan menghapus data transaksi dan **mengembalikan stok obat** ke inventaris.</p>
        
        <form id="deleteForm" method="POST" action="">
            <?= csrf_field() ?>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    Batal
                </button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
                    Ya, Batalkan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteModal(prescriptionId, patientName) {
        // Menggunakan alert karena tidak bisa menggunakan window.confirm
        if(confirm(`Yakin ingin membatalkan Resep #${prescriptionId} untuk ${patientName}? Stok obat akan dikembalikan.`)) {
             document.getElementById('deleteForm').action = '<?= base_url('admin/prescriptions/delete/') ?>' + prescriptionId;
             document.getElementById('deleteForm').submit();
        }
    }
    
    // Modal disembunyikan di sini karena kita menggunakan confirm() sederhana di controller. 
    // Jika perlu UI modal penuh, script di atas (openDeleteModal) harus diganti.
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
</script>
