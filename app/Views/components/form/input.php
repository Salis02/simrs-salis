<div class="<?= $containerClass ?? 'mb-4' ?>">
    <?php if (isset($label)): ?>
        <label for="<?= $id ?? $name ?>" class="block text-sm font-medium text-gray-700 mb-2">
            <?= $label ?>
            <?php if (isset($required) && $required): ?>
                <span class="text-danger-500">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>
    
    <input 
        type="<?= $type ?? 'text' ?>"
        name="<?= $name ?>"
        id="<?= $id ?? $name ?>"
        value="<?= old($name, $value ?? '') ?>"
        placeholder="<?= $placeholder ?? '' ?>"
        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm <?= isset($error) ? 'border-danger-300' : '' ?> <?= $class ?? '' ?>"
        <?= isset($required) && $required ? 'required' : '' ?>
        <?= isset($readonly) && $readonly ? 'readonly' : '' ?>
        <?= isset($disabled) && $disabled ? 'disabled' : '' ?>
        <?= $attributes ?? '' ?>
    >
    
    <?php if (isset($error)): ?>
        <p class="mt-1 text-sm text-danger-600"><?= $error ?></p>
    <?php endif; ?>
    
    <?php if (isset($help)): ?>
        <p class="mt-1 text-sm text-gray-500"><?= $help ?></p>
    <?php endif; ?>
</div>