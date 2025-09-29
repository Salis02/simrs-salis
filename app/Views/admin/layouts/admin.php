<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold text-primary-600">
                            <i class="fas fa-hospital-user mr-2"></i>
                            Admin SIMRS
                        </h1>
                    </div>
                </div>
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/admin" class="<?= (current_url(true)->getPath() === '/admin') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600' ?> px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                        </a>
                        <a href="/admin/doctors" class="<?= (strpos(current_url(true)->getPath(), '/admin/doctors') === 0) ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600' ?> px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-user-md mr-1"></i> Dokter
                        </a>
                        <a href="/admin/working-hours" class="<?= (strpos(current_url(true)->getPath(), '/admin/working-hours') === 0) ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600' ?> px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-calendar-alt mr-1"></i> Jadwal
                        </a>
                        <a href="/admin/reservations" class="<?= (strpos(current_url(true)->getPath(), '/admin/reservations') === 0) ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600' ?> px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-calendar-check mr-1"></i> Reservasi
                        </a>
                        <a href="/admin/queues" class="<?= (strpos(current_url(true)->getPath(), '/admin/queues') === 0) ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600' ?> px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-users mr-1"></i> Antrian
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 text-sm">
                        <i class="fas fa-user mr-1"></i>
                        <?= session('full_name') ?>
                    </span>
                    <a href="/admin/logout" class="text-gray-600 hover:text-danger-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu button -->
        <div class="md:hidden px-4 py-2">
            <button type="button" class="mobile-menu-button w-full text-left text-gray-600">
                <i class="fas fa-bars mr-2"></i> Menu
            </button>
        </div>
        
        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden bg-gray-50 border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="/admin" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-600">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="/admin/doctors" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-600">
                    <i class="fas fa-user-md mr-2"></i> Dokter
                </a>
                <a href="/admin/working-hours" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-600">
                    <i class="fas fa-calendar-alt mr-2"></i> Jadwal
                </a>
                <a href="/admin/reservations" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-600">
                    <i class="fas fa-calendar-check mr-2"></i> Reservasi
                </a>
                <a href="/admin/queues" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary-600">
                    <i class="fas fa-users mr-2"></i> Antrian
                </a>
                <a href="/admin/logout" class="block px-3 py-2 rounded-md text-base font-medium text-danger-600">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <?= view('components/alert') ?>
        <?= $this->renderSection('main') ?>
    </main>
</div>

<script>
// Mobile menu toggle
$('.mobile-menu-button').click(function() {
    $('.mobile-menu').toggleClass('hidden');
});
</script>
<?= $this->endSection() ?>