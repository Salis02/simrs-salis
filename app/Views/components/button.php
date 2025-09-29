<?php
$baseClasses = 'inline-flex items-center justify-center px-4 py-2 border text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200';

$variants = [
    'primary' => 'border-transparent text-white bg-primary-600 hover:bg-primary-700 focus:ring-primary-500',
    'secondary' => 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:ring-primary-500',
    'success' => 'border-transparent text-white bg-success-600 hover:bg-success-700 focus:ring-success-500',
    'danger' => 'border-transparent text-white bg-danger-600 hover:bg-danger-700 focus:ring-danger-500',
    'warning' => 'border-transparent text-white bg-warning-600 hover:bg-warning-700 focus:ring-warning-500',
];

$sizes = [
    'sm' => 'px-3 py-2 text-xs',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base',
];

$variant = $variant ?? 'primary';
$size = $size ?? 'md';
$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size] . ' ' . ($class ?? '');
?>

<?php if (isset($href)): ?>
    <a href="<?= $href ?>" class="<?= $classes ?>" <?= isset($target) ? 'target="' . $target . '"' : '' ?>>
        <?php if (isset($icon)): ?>
            <i class="<?= $icon ?> <?= isset($text) ? 'mr-2' : '' ?>"></i>
        <?php endif; ?>
        <?= $text ?? $slot ?? '' ?>
    </a>
<?php else: ?>
    <button 
        type="<?= $type ?? 'button' ?>" 
        class="<?= $classes ?>"
        <?= isset($onclick) ? 'onclick="' . $onclick . '"' : '' ?>
        <?= isset($disabled) && $disabled ? 'disabled' : '' ?>
        <?= isset($id) ? 'id="' . $id . '"' : '' ?>
    >
        <?php if (isset($icon)): ?>
            <i class="<?= $icon ?> <?= isset($text) ? 'mr-2' : '' ?>"></i>
        <?php endif; ?>
        <?= $text ?? $slot ?? '' ?>
    </button>
<?php endif; ?>