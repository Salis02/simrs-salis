<?php foreach ($prescriptions as $p): ?>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">
            #<?= esc($p['id']) ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <?= date('d M Y, H:i', strtotime($p['prescription_date'])) ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            <?= esc($p['patient_name']) ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
            <?= esc($p['doctor_name']) ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-green-700">
            Rp. <?= number_format($p['total_amount'], 0, ',', '.') ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                <?= $p['status'] == 'COMPLETED' 
                    ? 'bg-green-100 text-green-800' 
                    : ($p['status'] == 'CANCELLED' 
                        ? 'bg-red-100 text-red-800' 
                        : 'bg-yellow-100 text-yellow-800') ?>">
                <?= esc($p['status']) ?>
            </span>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
            <a href="<?= base_url('admin/prescriptions/view/' . $p['id']) ?>" 
               class="text-indigo-600 hover:text-indigo-900 mr-3">
                Lihat
            </a>

            <?php if ($p['status'] != 'CANCELLED'): ?>
                <button onclick="openDeleteModal(<?= $p['id'] ?>, '<?= esc($p['patient_name']) ?>')" 
                        class="text-red-600 hover:text-red-900">
                    Hapus
                </button>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>
