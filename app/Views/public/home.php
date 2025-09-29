<?= $this->extend('public/layouts/public') ?>

<?= $this->section('main') ?>
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Selamat Datang di RS Salis Family</h1>
                <p class="text-xl text-primary-100 mb-8">Sistem Informasi Manajemen Rumah Sakit</p>
                <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-6">
                    <button onclick="scrollToSection('reservasi')" class="bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Buat Reservasi
                    </button>
                    <button onclick="scrollToSection('antrian')" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary-600 transition-colors">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        Ambil Antrian
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Queue Status -->
    <?php if ($current_queue || $waiting_count > 0): ?>
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-center p-6 bg-primary-50 rounded-lg">
                    <i class="fas fa-user-clock text-3xl text-primary-600 mb-2"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Antrian Saat Ini</h3>
                    <p class="text-3xl font-bold text-primary-600 mt-2">
                        <?= $current_queue ? $current_queue['queue_number'] : '-' ?>
                    </p>
                    <?php if ($current_queue): ?>
                        <p class="text-sm text-gray-600 mt-1"><?= $current_queue['patient_name'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="text-center p-6 bg-warning-50 rounded-lg">
                    <i class="fas fa-users text-3xl text-warning-600 mb-2"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Yang Menunggu</h3>
                    <p class="text-3xl font-bold text-warning-600 mt-2"><?= $waiting_count ?></p>
                    <p class="text-sm text-gray-600 mt-1">orang</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Reservasi Section -->
        <section id="reservasi" class="mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Reservasi Dokter</h2>
                <p class="text-gray-600">Pilih dokter dan jadwal yang tersedia untuk membuat reservasi</p>
            </div>

            <?= view('components/card', [
                'header' => 'Buat Reservasi Baru',
                'content' => view('public/components/reservation_form', ['available_doctors' => $available_doctors])
            ]) ?>
        </section>

        <!-- Antrian Section -->
        <section id="antrian">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Antrian Walk-in</h2>
                <p class="text-gray-600">Ambil nomor antrian untuk pelayanan tanpa reservasi</p>
            </div>

            <?= view('components/card', [
                'header' => 'Ambil Nomor Antrian',
                'content' => view('public/components/queue_form')
            ]) ?>
        </section>
    </div>
</div>

<script>
function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({ 
        behavior: 'smooth' 
    });
}

// // Auto refresh queue status every 30 seconds
// setInterval(function() {
//     $.get('/queue/status', function(response) {
//         if (response.success) {
//             location.reload();
//         }
//     });
// }, 30000);
</script>
<?= $this->endSection() ?>