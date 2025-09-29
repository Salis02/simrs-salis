<div class="flex flex-col">
    <div class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
        <div class="inline-block min-w-full align-middle">
            <table class="min-w-full divide-y divide-gray-300">
                <?php if (isset($headers)): ?>
                    <thead class="bg-gray-50">
                        <tr>
                            <?php foreach ($headers as $header): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <?= $header ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                <?php endif; ?>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($data)): ?>
                        <tr>
                            <td colspan="<?= count($headers ?? [1]) ?>" class="px-6 py-12 text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                    <p><?= $emptyMessage ?? 'Tidak ada data yang tersedia' ?></p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?= $rows ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>