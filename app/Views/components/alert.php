<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-4 border-l-4 border-success-500 bg-success-50 p-4 rounded-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-success-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-success-600 font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-4 border-l-4 border-danger-500 bg-danger-50 p-4 rounded-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-danger-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-danger-600 font-medium"><?= session()->getFlashdata('error') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="mb-4 border-l-4 border-danger-500 bg-danger-50 p-4 rounded-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-danger-500"></i>
            </div>
            <div class="ml-3">
                <div class="text-sm text-danger-600">
                    <ul class="list-disc list-inside space-y-1">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>