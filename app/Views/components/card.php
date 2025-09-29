<div class="bg-white overflow-hidden shadow-sm rounded-lg <?= $class ?? '' ?>">
    <?php if (isset($header)): ?>
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900"><?= $header ?></h3>
            <?php if (isset($headerAction)): ?>
                <div class="mt-2"><?= $headerAction ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="px-6 py-4">
        <?= $content ?>
    </div>
    
    <?php if (isset($footer)): ?>
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
            <?= $footer ?>
        </div>
    <?php endif; ?>
</div>