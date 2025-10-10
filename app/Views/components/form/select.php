<div class="<?= $containerClass ?? 'mb-4' ?>">
    <?php if (isset($label)): ?>
        <label for="<?= $id ?? $name ?>"
            class="block text-sm font-medium text-gray-700 mb-2">
            <?= $label ?>
            <?php if (!empty($required)): ?>
                <span class="text-danger-500">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <select
        name="<?= $name ?>"
        id="<?= $id ?? $name ?>"
        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
               focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm
               <?= isset($error) ? 'border-danger-300' : '' ?> <?= $class ?? '' ?>"
        <?= !empty($required) ? 'required' : '' ?>
        <?= !empty($disabled) ? 'disabled' : '' ?>
        <?= $attributes ?? '' ?>>
        <?php
        // opsi kosong/default
        if (!empty($placeholder)) {
            $selected = old($name, $selected, $value ?? '') === '' ? 'selected' : '';
            echo "<option value=\"\" {$selected}>" . esc($placeholder) . "</option>";
        }

        if (!empty($options) && is_array($options)):
            foreach ($options as $optValue => $optLabel):
                $selectedValue = old($name, $selected ?? $value ?? '');
                $selectedAttr = (string)$selectedValue === (string)$optValue ? 'selected' : '';
                
                ?>
                <option value="<?= esc($optValue) ?>" <?= $selectedAttr ?>>
                    <?= esc($optLabel) ?>
                </option>
        <?php
            endforeach;
        endif;
        ?>
    </select>

    <?php if (!empty($error)): ?>
        <p class="mt-1 text-sm text-danger-600"><?= $error ?></p>
    <?php endif; ?>

    <?php if (!empty($help)): ?>
        <p class="mt-1 text-sm text-gray-500"><?= $help ?></p>
    <?php endif; ?>
</div>