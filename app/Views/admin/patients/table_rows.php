<?php $i = 1; ?>
<?php foreach ($patients as $patient): ?>
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            <?= $i++ ?>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">
                <?= esc($patient['name']) ?>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">
                <?= esc($patient['phone']) ?>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span
                class="px-2 py-1 text-xs font-medium rounded-full <?= $patient['gender'] == 'male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' ?>">
                <?= esc(ucfirst($patient['gender'])) ?>
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">
                <?= esc($patient['birth_date'] ?? '-') ?>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
            <?= view('components/button', [
                'href' => base_url('admin/patients/edit/' . $patient['id']),
                'variant' => 'secondary',
                'size' => 'sm',
                'icon' => 'fas fa-edit',
                'text' => 'Edit',
                'class' => 'mr-2'
            ]) ?>

            <?= view('components/button', [
                'variant' => 'danger',
                'size' => 'sm',
                'icon' => 'fas fa-trash',
                'text' => 'Hapus',
                'onclick' => "openDeleteModal({$patient['id']}, '" . esc($patient['name']) . "')"
            ]) ?>
        </td>
    </tr>
<?php endforeach; ?>