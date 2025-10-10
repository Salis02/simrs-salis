<?php
/**
 * Tailwind Pagination (Universal)
 * Compatible with CodeIgniter 4.0+ and supports:
 * - Any $pager group (e.g. patients, working_hours)
 * - Preserves query strings (e.g. search, filter, sort)
 * - Works with CI4 default PagerRenderer
 */

$pager->setSurroundCount(1);

// --- Detect current query parameters (search, filter, etc) ---
$currentQuery = $_GET ?? [];
unset($currentQuery['page']); // avoid duplicate param

// Helper: Determine the correct page parameter (page, page_patients, etc.)
$pageParam = null;
$firstUrl = $pager->getFirst() ?? null;

if ($firstUrl) {
    $parsed = parse_url($firstUrl);
    if (!empty($parsed['query'])) {
        parse_str($parsed['query'], $qs);
        $keys = array_keys($qs);
        if (!empty($keys)) {
            $pageParam = $keys[0];
        }
    }
}

// fallback if pager doesn't provide the key
if (!$pageParam) {
    foreach ($_GET as $k => $v) {
        if (strpos($k, 'page') === 0) {
            $pageParam = $k;
            break;
        }
    }
}
if (!$pageParam) $pageParam = 'page';

// --- Helper: build URL safely while preserving query params ---
function build_page_url($pageParam, $page, $extra = [])
{
    $params = array_merge($_GET ?? [], $extra);
    $params[$pageParam] = $page;

    $path = strtok($_SERVER['REQUEST_URI'], '?');
    $qs = http_build_query($params);
    return $path . ($qs ? '?' . $qs : '');
}

// --- Determine current and total pages ---
$currentPage = method_exists($pager, 'getCurrentPage')
    ? $pager->getCurrentPage()
    : ($_GET[$pageParam] ?? 1);

$pageCount = method_exists($pager, 'getPageCount')
    ? $pager->getPageCount()
    : 1;

$surround = 1;

// --- Render only if more than one page ---
if ($pageCount > 1):
?>
<nav class="flex justify-center mt-6" aria-label="Pagination">
    <ul class="inline-flex items-center space-x-1">
        <!-- First & Prev -->
        <?php if ($pager->hasPrevious()): ?>
            <li>
                <a href="<?= esc(build_page_url($pageParam, 1, $currentQuery)) ?>"
                   class="px-3 py-2 text-gray-500 border border-gray-300 rounded-l hover:bg-gray-100">
                    « First
                </a>
            </li>
            <li>
                <a href="<?= esc(build_page_url($pageParam, max(1, $currentPage - 1), $currentQuery)) ?>"
                   class="px-3 py-2 text-gray-500 border border-gray-300 hover:bg-gray-100">
                    ‹ Prev
                </a>
            </li>
        <?php endif; ?>

        <!-- Leading 1 and ellipsis -->
        <?php if ($currentPage > ($surround + 2)): ?>
            <li><a href="<?= esc(build_page_url($pageParam, 1, $currentQuery)) ?>"
                   class="px-3 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded">1</a></li>
            <li><span class="px-3 py-2 text-gray-400">…</span></li>
        <?php endif; ?>

        <!-- Page numbers around current -->
        <?php for ($i = max(1, $currentPage - $surround); $i <= min($pageCount, $currentPage + $surround); $i++):
            $active = $i === (int)$currentPage;
            $classes = $active
                ? 'bg-primary-600 text-white border-primary-600'
                : 'border-gray-300 text-gray-700 hover:bg-gray-100';
            $url = build_page_url($pageParam, $i, $currentQuery);
        ?>
            <li>
                <a href="<?= esc($url) ?>" class="px-3 py-2 border <?= $classes ?> rounded"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Trailing ellipsis and last -->
        <?php if ($currentPage < ($pageCount - ($surround + 1))): ?>
            <li><span class="px-3 py-2 text-gray-400">…</span></li>
            <li><a href="<?= esc(build_page_url($pageParam, $pageCount, $currentQuery)) ?>"
                   class="px-3 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded"><?= $pageCount ?></a></li>
        <?php endif; ?>

        <!-- Next & Last -->
        <?php if ($pager->hasNext()): ?>
            <li>
                <a href="<?= esc(build_page_url($pageParam, min($pageCount, $currentPage + 1), $currentQuery)) ?>"
                   class="px-3 py-2 text-gray-500 border border-gray-300 hover:bg-gray-100">
                    Next ›
                </a>
            </li>
            <li>
                <a href="<?= esc(build_page_url($pageParam, $pageCount, $currentQuery)) ?>"
                   class="px-3 py-2 text-gray-500 border border-gray-300 rounded-r hover:bg-gray-100">
                    Last »
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>
