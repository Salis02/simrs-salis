<?php foreach ($drugs as $drug): ?>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            <?= esc($drug['name']) ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <?= esc($drug['generic_name'] ?? '-') ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                <?= esc($drug['unit']) ?>
            </span>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-700">
            <span class="text-<?= $drug['stock'] < 10 ? 'red' : 'green' ?>-600">
                <?= esc($drug['stock']) ?>
            </span>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
            Rp. <?= number_format($drug['price'], 2, ',', '.') ?>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
            <a href="<?= base_url('admin/drugs/edit/' . $drug['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">
                Edit
            </a>
            <button onclick="openDeleteModal(<?= $drug['id'] ?>, '<?= esc($drug['name']) ?>')" class="text-red-600 hover:text-red-900">
                Hapus
            </button>
        </td>
    </tr>
<?php endforeach; ?>