<?php foreach ($queues as $queue): ?>
    <tr class="hover:bg-gray-50 <?= $queue['status'] === 'serving' ? 'bg-blue-50' : '' ?>">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg
                        <?= $queue['status'] === 'serving' ? 'bg-blue-100 text-blue-600' : 
                           ($queue['status'] === 'completed' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600') ?>">
                <?= $queue['queue_number'] ?>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900"><?= $queue['patient_name'] ?></div>
            <div class="text-sm text-gray-500"><?= $queue['phone'] ?></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900"><?= date('H:i', strtotime($queue['created_at'])) ?></div>
            <div class="text-xs text-gray-500"><?= date('d M Y', strtotime($queue['created_at'])) ?></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <?php
            $statusConfig = [
                'waiting' => ['text' => 'Menunggu', 'class' => 'bg-yellow-100 text-yellow-800'],
                'serving' => ['text' => 'Dilayani', 'class' => 'bg-blue-100 text-blue-800'],
                'completed' => ['text' => 'Selesai', 'class' => 'bg-green-100 text-green-800'],
                'cancelled' => ['text' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-800'],
            ];
            $status = $statusConfig[$queue['status']] ?? $statusConfig['waiting'];
            ?>
            <span class="px-2 py-1 text-xs font-medium rounded-full <?= $status['class'] ?>">
                <?= $status['text'] ?>
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex items-center space-x-2">
                <?php if ($queue['status'] === 'waiting'): ?>
                    <button onclick="updateQueueStatus(<?= $queue['id'] ?>, 'serving')" 
                            class="text-blue-600 hover:text-blue-900" title="Mulai Layani">
                        <i class="fas fa-play"></i>
                    </button>
                <?php elseif ($queue['status'] === 'serving'): ?>
                    <button onclick="updateQueueStatus(<?= $queue['id'] ?>, 'completed')" 
                            class="text-success-600 hover:text-success-900" title="Selesai">
                        <i class="fas fa-check"></i>
                    </button>
                <?php endif; ?>
                
                <?php if ($queue['status'] !== 'completed' && $queue['status'] !== 'cancelled'): ?>
                    <button onclick="updateQueueStatus(<?= $queue['id'] ?>, 'cancelled')" 
                            class="text-danger-600 hover:text-danger-900" title="Batalkan">
                        <i class="fas fa-ban"></i>
                    </button>
                <?php endif; ?>
            </div>
        </td>
    </tr>
<?php endforeach; ?>

<script>
function callNextQueue() {
    if (!confirm('Panggil antrian berikutnya?')) return;
    
    $.post('/admin/queues/call-next', function(response) {
        if (response.success) {
            showAlert(`Antrian nomor ${response.data.queue_number} berhasil dipanggil`, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(response.message, 'error');
        }
    }).fail(function() {
        showAlert('Terjadi kesalahan saat memanggil antrian', 'error');
    });
}

function updateQueueStatus(queueId, status) {
    const statusText = {
        'serving': 'mulai melayani',
        'completed': 'menyelesaikan',
        'cancelled': 'membatalkan'
    };
    
    if (!confirm(`Yakin ${statusText[status]} antrian ini?`)) return;
    
    $.post(`/admin/queues/update-status/${queueId}`, { status: status }, function(response) {
        if (response.success) {
            showAlert(response.message, 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert(response.message, 'error');
        }
    }).fail(function() {
        showAlert('Terjadi kesalahan saat mengupdate status', 'error');
    });
}

// Auto refresh every 15 seconds for real-time updates
setInterval(function() {
    if (document.visibilityState === 'visible') {
        location.reload();
    }
}, 15000);
</script>