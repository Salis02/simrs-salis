<?php foreach ($working_hours as $schedule): ?>
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900"><?= $schedule['doctor_name'] ?></div>
            <div class="text-sm text-gray-500"><?= $schedule['specialization'] ?></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900"><?= date('d M Y', strtotime($schedule['date'])) ?></div>
            <div class="text-xs text-gray-500"><?= date('l', strtotime($schedule['date'])) ?></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">
                <?= date('H:i', strtotime($schedule['start_time'])) ?> - <?= date('H:i', strtotime($schedule['end_time'])) ?>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            <?= $schedule['duration_per_patient'] ?> menit
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            <?= $schedule['max_patients'] ?> orang
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 text-xs font-medium rounded-full <?= $schedule['is_available_for_reservation'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                <?= $schedule['is_available_for_reservation'] ? 'Ya' : 'Tidak' ?>
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
            <?= view('components/button', [
                'href' => '/admin/working-hours/edit/' . $schedule['id'],
                'variant' => 'secondary',
                'size' => 'sm',
                'icon' => 'fas fa-edit',
                'text' => 'Edit',
                'class' => 'mr-2'
            ]) ?>

            <button onclick="deleteSchedule(<?= $schedule['id'] ?>)" class="text-danger-600 hover:text-danger-900">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
<?php endforeach; ?>

<script>
    function deleteSchedule(id) {
        if (confirm('Yakin ingin menghapus jadwal ini?')) {
            window.location.href = `/admin/working-hours/delete/${id}`;
        }
    }
</script>