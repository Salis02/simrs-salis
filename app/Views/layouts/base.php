<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIMRS RS Salis Family' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
         <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a'
                        },
                        success: {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a'
                        },
                        danger: {
                            50: '#fef2f2',
                            500: '#ef4444',
                            600: '#dc2626'
                        },
                        warning: {
                            50: '#fffbeb',
                            500: '#f59e0b',
                            600: '#d97706'
                        }
                    }
                }
            }
        }
    </script>
    <?= $this->renderSection('head') ?>
</head>
<body class="bg-gray-50">
    <?= $this->renderSection('content') ?>
    
    <!-- Scripts -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script>
        // Global JavaScript functions
        function showAlert(message, type = 'info') {
            const alertTypes = {
                success: 'bg-success-50 text-success-600 border-success-500',
                error: 'bg-danger-50 text-danger-600 border-danger-500',
                warning: 'bg-warning-50 text-warning-600 border-warning-500',
                info: 'bg-primary-50 text-primary-600 border-primary-500'
            };
            
            const alertHtml = `
                <div class="fixed top-4 right-4 z-50 max-w-sm w-full">
                    <div class="border-l-4 p-4 rounded-lg shadow-lg ${alertTypes[type]} alert-dismissible">
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-medium">${message}</p>
                            <button class="ml-4 text-lg leading-none cursor-pointer" onclick="this.parentElement.parentElement.parentElement.remove()">&times;</button>
                        </div>
                    </div>
                </div>
            `;
            
            $('body').append(alertHtml);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                $('.alert-dismissible').fadeOut();
            }, 5000);
        }

        // CSRF Token for AJAX
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!/^(GET|HEAD|OPTIONS|TRACE)$/i.test(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                }
            }
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>