<div id="<?= $id ?>" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 xl:w-2/5 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900"><?= $title ?></h3>
            <button class="modal-close text-black text-xl leading-none font-semibold outline-none focus:outline-none" onclick="closeModal('<?= $id ?>')">
                <span class="text-gray-400 hover:text-gray-600">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?= $content ?>
        </div>
        <?php if (isset($footer)): ?>
            <div class="flex justify-end pt-4 border-t border-gray-200 mt-4">
                <?= $footer ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function showModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('<?= $id ?>').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal('<?= $id ?>');
    }
});
</script>