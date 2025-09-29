<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-white rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-hospital-user text-primary-600 text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Admin Login</h2>
            <p class="mt-2 text-primary-200">Masuk ke sistem administrasi SIMRS</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-xl p-8">
            <?= view('components/alert') ?>
            
            <form method="POST" action="/admin/login" class="space-y-6">
                <?= view('components/form/input', [
                    'name' => 'username',
                    'label' => 'Username',
                    'placeholder' => 'Masukkan username',
                    'required' => true,
                    'class' => 'text-lg py-3'
                ]) ?>

                <?= view('components/form/input', [
                    'type' => 'password',
                    'name' => 'password',
                    'label' => 'Password',
                    'placeholder' => 'Masukkan password',
                    'required' => true,
                    'class' => 'text-lg py-3'
                ]) ?>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <a href="/" class="text-sm text-gray-600 hover:text-primary-600">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke halaman utama
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>