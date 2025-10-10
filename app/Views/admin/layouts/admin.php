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

                <!-- DEKSTOP MENU -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">

                        <!-- Dashboard -->
                        <a href="/admin" class="<?= (current_url(true)->getPath() === '/admin') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600' ?> px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                        </a>

                        <!-- Manajemen Data (Dropdown) -->
                        <div class="relative group" tabindex="0">
                            <button type="button" aria-haspopup="true" class="flex items-center px-3 py-2 text-gray-600 rounded-md text-sm font-medium focus:outline-none">
                                <i class="fas fa-database mr-1"></i>
                                Manajemen Data
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>

                            <!-- Perbaikan: gunakan opacity + pointer-events (bukan display) & hindari gap (mt-0) -->
                            <div class="absolute left-0 top-full mt-0 w-48 z-50 bg-white border border-gray-200 rounded-md shadow-md
                                    opacity-0 pointer-events-none transform translate-y-0
                                    group-hover:opacity-100 group-hover:pointer-events-auto
                                    group-focus:opacity-100 group-focus:pointer-events-auto
                                    transition-all duration-150">
                                <div class="py-1">
                                    <a href="/admin/doctors" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/doctors') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Dokter
                                    </a>
                                    <a href="/admin/working-hours" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/working-hours') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Jadwal
                                    </a>
                                    <a href="/admin/patients" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/patients') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Pasien
                                    </a>
                                    <a href="/admin/drugs" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/drugs') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Obat
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pelayanan (Dropdown) -->
                        <div class="relative group" tabindex="0">
                            <button type="button" aria-haspopup="true" class="flex items-center px-3 py-2 text-gray-600 rounded-md text-sm font-medium focus:outline-none">
                                <i class="fas fa-hand-holding-medical mr-1"></i>
                                Pelayanan
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>

                            <div class="absolute left-0 top-full mt-0 w-48 z-50 bg-white border border-gray-200 rounded-md shadow-md
                                    opacity-0 pointer-events-none transform translate-y-0
                                    group-hover:opacity-100 group-hover:pointer-events-auto
                                    group-focus:opacity-100 group-focus:pointer-events-auto
                                    transition-all duration-150">
                                <div class="py-1">
                                    <a href="/admin/reservations" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/reservations') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Reservasi
                                    </a>
                                    <a href="/admin/queues" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/queues') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Antrian
                                    </a>
                                    <a href="/admin/prescriptions" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/prescriptions') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Resep
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Administrator (Dropdown) -->
                        <div class="relative group" tabindex="0">
                            <button type="button" aria-haspopup="true" class="flex items-center px-3 py-2 text-gray-600 rounded-md text-sm font-medium focus:outline-none">
                                <i class="fas fa-user-shield mr-1"></i>
                                Administrator
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>

                            <div class="absolute left-0 top-full mt-0 w-48 z-50 bg-white border border-gray-200 rounded-md shadow-md
                                    opacity-0 pointer-events-none transform translate-y-0
                                    group-hover:opacity-100 group-hover:pointer-events-auto
                                    group-focus:opacity-100 group-focus:pointer-events-auto
                                    transition-all duration-150">
                                <div class="py-1">
                                    <a href="/admin/users" class="block px-4 py-2 text-sm <?= (strpos(current_url(true)->getPath(), '/admin/users') === 0) ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' ?>">
                                        Pengguna
                                    </a>
                                    <a href="/admin/logout" class="block px-4 py-2 text-sm text-danger-600 hover:text-danger-700">
                                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/admin/logout" class="text-gray-600 hover:text-danger-600 px-3 py-2 rounded-md text-sm font-medium"> 
                        <?= session('full_name') ?>
                        Logout 
                        <i class="fas fa-sign-out-alt mr-1"></i> 
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
                <!-- Manajemen Data -->
                <details class="border-t border-gray-200">
                    <summary class="px-3 py-2 text-gray-600 cursor-pointer text-base font-medium hover:text-primary-600">
                        <i class="fas fa-database mr-2"></i> Manajemen Data
                    </summary>
                    <div class="pl-6 pb-2">
                        <a href="/admin/doctors" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Dokter</a>
                        <a href="/admin/working-hours" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Jadwal</a>
                        <a href="/admin/patients" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Pasien</a>
                        <a href="/admin/drugs" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Obat</a>
                    </div>
                </details>

                <!-- Pelayanan -->
                <details class="border-t border-gray-200">
                    <summary class="px-3 py-2 text-gray-600 cursor-pointer text-base font-medium hover:text-primary-600">
                        <i class="fas fa-hand-holding-medical mr-2"></i> Pelayanan
                    </summary>
                    <div class="pl-6 pb-2">
                        <a href="/admin/reservations" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Reservasi</a>
                        <a href="/admin/queues" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Antrian</a>
                        <a href="/admin/prescriptions" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Resep</a>
                    </div>
                </details>

                <!-- Administrator -->
                <details class="border-t border-gray-200">
                    <summary class="px-3 py-2 text-gray-600 cursor-pointer text-base font-medium hover:text-primary-600">
                        <i class="fas fa-user-shield mr-2"></i> Administrator
                    </summary>
                    <div class="pl-6 pb-2">
                        <a href="/admin/users" class="block px-3 py-2 text-gray-600 hover:text-primary-600">Pengguna</a>
                        <a href="/admin/logout" class="block px-3 py-2 text-danger-600 hover:text-danger-700">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </a>
                    </div>
                </details>
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