<?php
$pager->setSurroundCount(2);
?>

<?php if ($pager->getPageCount() > 1): ?>
    <nav class="flex items-center justify-between mt-6" role="navigation" aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="inline-flex -space-x-px">
            <!-- Prev -->
            <?php if ($pager->hasPreviousPage()): ?>
                <li>
                    <a href="<?= $pager->getPreviousPage() ?>"
                       class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                        ‹
                    </a>
                </li>
            <?php endif; ?>

            <!-- Numbers -->
            <?php foreach ($pager->links() as $link): ?>
                <?php if ($link['active']): ?>
                    <li>
                        <span class="px-3 py-2 leading-tight text-white bg-primary-600 border border-gray-300">
                            <?= $link['title'] ?>
                        </span>
                    </li>
                <?php elseif ($link['title'] === '...'): ?>
                    <li>
                        <span class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300">…</span>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= $link['uri'] ?>"
                           class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            <?= $link['title'] ?>
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>

            <!-- Next -->
            <?php if ($pager->hasNextPage()): ?>
                <li>
                    <a href="<?= $pager->getNextPage() ?>"
                       class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                        ›
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
<?php endif ?>
