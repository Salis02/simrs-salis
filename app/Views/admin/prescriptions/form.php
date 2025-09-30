<?= $this->extend('admin/layouts/admin') ?> 

<?= $this->section('main') ?>

<?php 
$isEdit = !empty($prescription);
$action = $isEdit ? 'admin/prescriptions/edit/' . $prescription['id'] : 'admin/prescriptions/create';
$validation = \Config\Services::validation();
?>

<div class="container mx-auto p-4 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('admin/prescriptions') ?>" class="text-indigo-600 hover:text-indigo-800">
            &larr; Kembali ke Daftar Resep
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-lg p-6">
        <form id="prescriptionForm" action="<?= base_url($action) ?>" method="post">
            <?= csrf_field() ?>

            <!-- Informasi Pasien dan Dokter -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 pb-6 border-b">
                <div>
                    <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-1">Pasien</label>
                    <select id="patient_id" name="patient_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                        <option value="">-- Pilih Pasien --</option>
                        <?php foreach ($patients as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= set_select('patient_id', $p['id'], $isEdit && $prescription['patient_id'] == $p['id']) ?>>
                                <?= esc($p['name']) ?> (<?= esc($p['phone']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->getError('patient_id')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('patient_id') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Dokter Perujuk</label>
                    <select id="doctor_id" name="doctor_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                        <option value="">-- Pilih Dokter --</option>
                        <?php foreach ($doctors as $d): ?>
                            <option value="<?= $d['id'] ?>" <?= set_select('doctor_id', $d['id'], $isEdit && $prescription['doctor_id'] == $d['id']) ?>>
                                <?= esc($d['name']) ?> (<?= esc($d['specialization']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->getError('doctor_id')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('doctor_id') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tanggal dan Catatan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="prescription_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Resep</label>
                    <input type="datetime-local" id="prescription_date" name="prescription_date" value="<?= set_value('prescription_date', $isEdit ? date('Y-m-d\TH:i', strtotime($prescription['prescription_date'])) : date('Y-m-d\TH:i')) ?>"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5" required>
                    <?php if ($validation->getError('prescription_date')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('prescription_date') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Dokter (Opsional)</label>
                    <textarea id="notes" name="notes" rows="1"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5"><?= set_value('notes', $isEdit ? $prescription['notes'] : '') ?></textarea>
                    <?php if ($validation->getError('notes')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $validation->getError('notes') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Item Obat -->
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex justify-between items-center">
                Item Obat Resep
                <button type="button" onclick="addItemRow()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 text-sm rounded-lg shadow-md transition duration-150 ease-in-out">
                    + Tambah Obat
                </button>
            </h3>

            <div id="itemsContainer" class="space-y-4 mb-6">
                <!-- Baris Item Obat akan ditambahkan di sini oleh JavaScript -->
            </div>

            <!-- Total Transaksi dan Input Tersembunyi -->
            <div class="flex flex-col items-end space-y-4 mt-6 pt-4 border-t border-dashed">
                <div class="w-full max-w-md bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <p class="text-xl font-bold text-gray-800 flex justify-between">
                        <span>TOTAL KESELURUHAN:</span>
                        <span id="totalAmountDisplay" class="text-green-600">Rp. 0</span>
                    </p>
                </div>
                
                <!-- Input Tersembunyi untuk data ke Controller -->
                <input type="hidden" name="total_amount" id="total_amount_hidden" value="<?= set_value('total_amount', $isEdit ? $prescription['total_amount'] : 0) ?>">
                <input type="hidden" name="items_json" id="items_json" value="<?= set_value('items_json', $isEdit ? json_encode($items) : '[]') ?>">

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3 w-full">
                    <a href="<?= base_url('admin/prescriptions') ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        Batal
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
                        <?= $isEdit ? 'Simpan Resep' : 'Buat Resep Baru' ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    const availableDrugs = <?= $drugsJson ?>;
    let itemCounter = 0;
    let drugsMap = {};

    availableDrugs.forEach(drug => {
        drugsMap[drug.id] = drug;
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Tambahkan satu baris item secara default
        addItemRow();
        updateTotal();
    });

    function addItemRow(defaultDrugId = null, defaultQuantity = 1, defaultDosage = '') {
        itemCounter++;
        const id = itemCounter;
        const container = document.getElementById('itemsContainer');

        const newRow = document.createElement('div');
        newRow.className = 'flex flex-wrap lg:flex-nowrap gap-3 items-end p-3 border border-gray-200 rounded-lg bg-gray-50';
        newRow.id = `item-row-${id}`;
        
        // Buat Opsi Obat
        let drugOptions = `<option value="">-- Pilih Obat --</option>`;
        availableDrugs.forEach(drug => {
            // Cek stok, jika stok 0, disable opsi
            const disabled = drug.stock <= 0 ? 'disabled' : '';
            const stockText = drug.stock <= 0 ? ' (STOK HABIS)' : ` (Stok: ${drug.stock})`;
            const selected = defaultDrugId == drug.id ? 'selected' : '';
            
            // Menggunakan formatRupiah yang sudah diperbaiki
            drugOptions += `<option value="${drug.id}" data-price="${drug.price}" data-stock="${drug.stock}" ${disabled} ${selected}>${drug.name} - Rp. ${formatRupiah(drug.price)} ${stockText}</option>`;
        });

        newRow.innerHTML = `
            <div class="w-full lg:w-4/12">
                <label class="block text-xs font-medium text-gray-700 mb-1">Obat</label>
                <select name="items[${id}][drug_id]" id="drug_id_${id}" onchange="updateRow(${id})" class="block w-full border-gray-300 rounded-md shadow-sm p-2.5 bg-white" required>
                    ${drugOptions}
                </select>
                <p id="stock_alert_${id}" class="text-red-500 text-xs mt-1 hidden">Stok tidak cukup!</p>
            </div>
            <div class="w-full lg:w-2/12">
                <label class="block text-xs font-medium text-gray-700 mb-1">Jumlah</label>
                <input type="number" name="items[${id}][quantity]" id="quantity_${id}" value="${defaultQuantity}" min="1" oninput="updateRow(${id})" class="block w-full border-gray-300 rounded-md shadow-sm p-2.5" required>
            </div>
            <div class="w-full lg:w-4/12">
                <label class="block text-xs font-medium text-gray-700 mb-1">Aturan Pakai</label>
                <input type="text" name="items[${id}][dosage_instruction]" id="dosage_${id}" value="${defaultDosage}" placeholder="Contoh: 3x sehari 1 tablet" class="block w-full border-gray-300 rounded-md shadow-sm p-2.5" required>
            </div>
            <div class="w-full lg:w-2/12 flex justify-between items-center">
                <div class="text-right flex-grow pr-2">
                    <!-- Harga Satuan tersembunyi (digunakan saat simpan) -->
                    <input type="hidden" name="items[${id}][price_per_unit]" id="price_per_unit_${id}" value="0">
                    
                    <span id="subtotal_${id}" class="text-sm font-semibold text-gray-800">Rp. 0</span>
                </div>
                <button type="button" onclick="removeItemRow(${id})" class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 6h6v10H7V6z" clip-rule="evenodd"/></svg>
                </button>
            </div>
        `;
        container.appendChild(newRow);
        
        // Panggil updateRow untuk menghitung subtotal awal jika defaultDrugId ada
        if (defaultDrugId) {
            updateRow(id);
        }
    }

    function removeItemRow(id) {
        document.getElementById(`item-row-${id}`).remove();
        updateTotal();
    }

    function updateRow(id) {
        const drugSelect = document.getElementById(`drug_id_${id}`);
        const quantityInput = document.getElementById(`quantity_${id}`);
        const subtotalSpan = document.getElementById(`subtotal_${id}`);
        const pricePerUnitInput = document.getElementById(`price_per_unit_${id}`);
        const stockAlert = document.getElementById(`stock_alert_${id}`);
        
        const selectedOption = drugSelect.options[drugSelect.selectedIndex];
        
        // Reset jika tidak ada obat yang dipilih
        if (!selectedOption.value) {
            subtotalSpan.textContent = 'Rp. 0';
            pricePerUnitInput.value = 0;
            stockAlert.classList.add('hidden');
            updateTotal();
            return;
        }

        const price = parseFloat(selectedOption.getAttribute('data-price'));
        const stock = parseInt(selectedOption.getAttribute('data-stock'));
        const quantity = parseInt(quantityInput.value) || 0;

        let subtotal = 0;

        if (quantity > stock) {
            stockAlert.textContent = `Stok tidak cukup! (Max: ${stock})`;
            stockAlert.classList.remove('hidden');
            // Biarkan subtotal 0 atau hitung normal tapi berikan feedback
            subtotal = price * quantity; 
        } else {
            stockAlert.classList.add('hidden');
            subtotal = price * quantity;
        }

        // Simpan harga satuan untuk dikirim ke Controller
        pricePerUnitInput.value = price;
        
        subtotalSpan.textContent = 'Rp. ' + formatRupiah(subtotal);
        updateTotal();
    }

    /**
     * Memperbaiki fungsi formatRupiah agar menerima input non-angka dengan aman.
     */
    function formatRupiah(angka) {
        // Pastikan angka adalah tipe Number, jika tidak valid, gunakan 0
        const numberValue = parseFloat(angka) || 0; 
        
        let numberString = numberValue.toFixed(0).toString();
        let sisa = numberString.length % 3;
        let rupiah = numberString.substr(0, sisa);
        let ribuan = numberString.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }

    function updateTotal() {
        let grandTotal = 0;
        const allItems = [];
        const container = document.getElementById('itemsContainer');
        const itemRows = container.children;

        // Loop melalui semua baris item untuk menghitung total
        for (let row of itemRows) {
            const id = row.id.split('-').pop();
            const drugSelect = document.getElementById(`drug_id_${id}`);
            const quantityInput = document.getElementById(`quantity_${id}`);
            const dosageInput = document.getElementById(`dosage_${id}`);
            const pricePerUnitInput = document.getElementById(`price_per_unit_${id}`);
            
            if (drugSelect && drugSelect.value) {
                const selectedOption = drugSelect.options[drugSelect.selectedIndex];
                // Mengambil harga dari atribut data
                const price = parseFloat(selectedOption.getAttribute('data-price'));
                const quantity = parseInt(quantityInput.value) || 0;
                
                const subtotal = price * quantity;
                grandTotal += subtotal;

                // Update subtotal display (meskipun sudah dilakukan di updateRow, ini memastikan)
                document.getElementById(`subtotal_${id}`).textContent = 'Rp. ' + formatRupiah(subtotal);

                // Siapkan data detail item untuk JSON (untuk dikirim ke Controller)
                allItems.push({
                    drug_id: drugSelect.value,
                    quantity: quantity,
                    dosage_instruction: dosageInput.value,
                    price_per_unit: price, // Harga satuan
                    subtotal: subtotal, // Subtotal
                });
            }
        }

        // Update tampilan Total Keseluruhan
        document.getElementById('totalAmountDisplay').textContent = 'Rp. ' + formatRupiah(grandTotal);
        
        // Update input hidden untuk dikirim ke Controller
        document.getElementById('total_amount_hidden').value = grandTotal.toFixed(2); // Simpan dengan 2 desimal
        document.getElementById('items_json').value = JSON.stringify(allItems);
    }
    
    // Pastikan validasi dijalankan saat submit
    document.getElementById('prescriptionForm').onsubmit = function() {
        updateTotal(); // Final check before submit
        
        // Ambil data dari input hidden (yang sudah diupdate oleh updateTotal())
        const items = JSON.parse(document.getElementById('items_json').value);

        if (items.length === 0) {
            alert('Harap tambahkan minimal satu obat ke dalam resep.');
            return false;
        }
        
        // Cek Stok akhir sebelum submit
        for (const item of items) {
             const drug = drugsMap[item.drug_id];
             if (item.quantity > drug.stock) {
                 alert(`Stok obat ${drug.name} tidak cukup (${item.quantity} diminta, tersedia ${drug.stock}).`);
                 return false;
             }
        }
        return true;
    }

</script>

<?= $this->endSection() ?>
