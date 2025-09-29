<?php foreach ($doctors as $doctor): ?>
    <tr class="border-b last:border-0 hover:bg-gray-50 transition-colors">
        <!-- Nama Dokter -->
        <td class="px-4 py-3 text-sm font-medium text-gray-900">
            <?= esc($doctor['name']) ?>
        </td>

        <!-- Spesialisasi -->
        <td class="px-4 py-3 text-sm text-gray-700">
            <?= esc($doctor['specialization']) ?>
        </td>

        <!-- Kontak -->
        <td class="px-4 py-3 text-sm text-gray-700">
            <?= esc($doctor['phone']) ?>
        </td>

        <!-- Status -->
        <td class="px-4 py-3 text-sm">
            <?php if ((int)$doctor['is_active'] === 1): ?>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                    Aktif
                </span>
            <?php else: ?>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                    Nonaktif
                </span>
            <?php endif; ?>
        </td>

        <!-- Aksi -->
        <td class="px-4 py-3 text-sm space-x-2">
            <a href="/admin/doctors/edit/<?= $doctor['id'] ?>"
                class="inline-flex items-center px-3 py-1.5 rounded-md border border-primary-600 text-primary-600 hover:bg-primary-50 transition-colors">
                Edit
            </a>
            <a href="/admin/doctors/delete/<?= $doctor['id'] ?>"
                onclick="return confirm('Yakin hapus?')"
                class="inline-flex items-center px-3 py-1.5 rounded-md border border-red-600 text-red-600 hover:bg-red-50 transition-colors">
                Hapus
            </a>
        </td>
    </tr>
<?php endforeach; ?>