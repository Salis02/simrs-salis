<?php foreach ($reservations as $reservation): ?>
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900"><?= $reservation['patient_name'] ?></div>
            <div class="text-sm text-gray-500"><?= $reservation['phone'] ?></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900"><?= $reservation['doctor_name'] ?></div>
            <div class="text-sm text-gray-500"><?= $reservation['specialization'] ?></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900"><?= date('d M Y', strtotime($reservation['reservation_date'])) ?></div>
            <div class="text-sm text-gray-500"><?= date('H:i', strtotime($reservation['reservation_time'])) ?></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <?php
            $statusConfig = [
                'pending' => ['text' => 'Pending', 'class' => 'bg-yellow-100 text-yellow-800'],
                'approved' => ['text' => 'Disetujui', 'class' => 'bg-green-100 text-green-800'],
                'rejected' => ['text' => 'Ditolak', 'class' => 'bg-red-100 text-red-800'],
                'completed' => ['text' => 'Selesai', 'class' => 'bg-blue-100 text-blue-800'],
                'cancelled' => ['text' => 'Dibatalkan', 'class' => 'bg-gray-100 text-gray-800'],
            ];
            $status = $statusConfig[$reservation['status']] ?? $statusConfig['pending'];
            ?>
            <span class="px-2 py-1 text-xs font-medium rounded-full <?= $status['class'] ?>">
                <?= $status['text'] ?>
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex items-center space-x-2">
                <a href="/admin/reservations/show/<?= $reservation['id'] ?>" 
                   class="text-primary-600 hover:text-primary-900" title="Detail">
                    <i class="fas fa-eye"></i>
                </a>
                
                <?php if ($reservation['status'] === 'pending'): ?>
                    <button onclick="openStatusModal(<?= $reservation['id'] ?>, 'approved')" 
                            class="text-success-600 hover:text-success-900" title="Setujui">
                        <i class="fas fa-check"></i>
                    </button>
                    <button onclick="openStatusModal(<?= $reservation['id'] ?>, 'rejected')" 
                            class="text-danger-600 hover:text-danger-900" title="Tolak">
                        <i class="fas fa-times"></i>
                    </button>
                <?php elseif ($reservation['status'] === 'approved'): ?>
                    <button onclick="openStatusModal(<?= $reservation['id'] ?>, 'completed')" 
                            class="text-blue-600 hover:text-blue-900" title="Selesai">
                        <i class="fas fa-check-double"></i>
                    </button>
                <?php endif; ?>
                
                <button onclick="openStatusModal(<?= $reservation['id'] ?>, 'cancelled')" 
                        class="text-gray-600 hover:text-gray-900" title="Batalkan">
                    <i class="fas fa-ban"></i>
                </button>
            </div>
        </td>
    </tr>
<?php endforeach; ?>

<script>
function openStatusModal(reservationId, status) {
    $('#statusForm input[name="reservation_id"]').val(reservationId);
    $('#statusForm select[name="status"]').val(status);
    showModal('statusModal');
}
</script>