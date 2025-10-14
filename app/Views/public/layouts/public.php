<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<!-- Navigation -->
<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <h1 class="text-xl font-bold text-primary-600">
                        <i class="fas fa-hospital mr-2"></i>
                        RS Salis Family
                    </h1>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/" class="text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-home mr-1"></i> Beranda
                    </a>
                    <a href="#reservasi" class="text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-calendar-alt mr-1"></i> Reservasi
                    </a>
                    <a href="#antrian" class="text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-users mr-1"></i> Antrian
                    </a>
                    <a href="/admin" class="text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-user mr-1"></i> Login Admin
                    </a>
                </div>
            </div>
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button text-gray-600 hover:text-primary-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-50">
            <a href="/" class="text-gray-600 hover:text-primary-600 block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-home mr-2"></i> Beranda
            </a>
            <a href="#reservasi" class="text-gray-600 hover:text-primary-600 block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-calendar-alt mr-2"></i> Reservasi
            </a>
            <a href="#antrian" class="text-gray-600 hover:text-primary-600 block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-users mr-2"></i> Antrian
            </a>
            <a href="/admin" class="text-gray-600 hover:text-primary-600 block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-user mr-2"></i> Login Admin
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="flex-1">
    <?= $this->renderSection('main') ?>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">RS Salis Family</h3>
                <p class="text-gray-300 text-sm">
                    Rumah Sakit terpercaya yang memberikan pelayanan kesehatan terbaik untuk keluarga Anda.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <div class="text-gray-300 text-sm space-y-2">
                    <p><i class="fas fa-phone mr-2"></i> (021) 123-4567</p>
                    <p><i class="fas fa-envelope mr-2"></i> info@salisfamily.com</p>
                    <p><i class="fas fa-map-marker-alt mr-2"></i> Jl. Kesehatan No. 123, Jakarta</p>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Jam Operasional</h3>
                <div class="text-gray-300 text-sm space-y-1">
                    <p>Senin - Sabtu: 08:00 - 18:00</p>
                    <p>Minggu: 08:00 - 12:00</p>
                    <p class="text-success-400">24/7 Emergency</p>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-4 border-t border-gray-700 text-center text-sm text-gray-400">
            <p>&copy; <?= date('Y') ?> RS Salis Family. All rights reserved.</p>
        </div>
    </div>
</footer>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('.mobile-menu-button').on('click', function() {
            $('.mobile-menu').toggleClass('hidden');
        });
    });
</script>
<?= $this->endSection() ?>