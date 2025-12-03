<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="description" content="Admin dashboard for managing Intramurals 2025 registrations">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: 'hsl(217, 91%, 60%)',
                            foreground: 'hsl(0, 0%, 100%)',
                        },
                        secondary: {
                            DEFAULT: 'hsl(27, 96%, 61%)',
                            foreground: 'hsl(0, 0%, 100%)',
                        },
                        accent: {
                            DEFAULT: 'hsl(142, 76%, 36%)',
                            foreground: 'hsl(0, 0%, 100%)',
                        },
                        background: 'hsl(210, 100%, 97%)',
                        foreground: 'hsl(222, 47%, 11%)',
                        card: 'hsl(0, 0%, 100%)',
                        'card-foreground': 'hsl(222, 47%, 11%)',
                        border: 'hsl(214, 32%, 91%)',
                        input: 'hsl(214, 32%, 91%)',
                        ring: 'hsl(217, 91%, 60%)',
                        muted: 'hsl(210, 40%, 96%)',
                        'muted-foreground': 'hsl(215, 16%, 47%)',
                    },
                },
            },
        }
    </script>

    <style>
        /* Custom gradient backgrounds */
        .gradient-hero {
            background: linear-gradient(135deg, hsl(217, 91%, 60%) 0%, hsl(142, 76%, 36%) 100%);
        }

        .gradient-card {
            background: linear-gradient(135deg, hsl(217, 91%, 60%, 0.05) 0%, hsl(27, 96%, 61%, 0.05) 100%);
        }

        /* Override Tailwind hidden class for modals by using custom is-hidden */
        .is-hidden {
            display: none !important;
            pointer-events: none !important;
            visibility: hidden !important;
        }
        /* Show modal as fixed grid container */
        .modal-visible {
            display: grid !important;
            pointer-events: auto !important;
            visibility: visible !important;
            background-color: rgba(30, 41, 59, 0.5) !important; /* Semi-transparent background overlay */
        }
        /* Modal form container background white */
        #participant-modal > div,
        #spectator-modal > div,
        #view-modal > div {
            background-color: white !important;
        }
    </style>
</head>

<body class="bg-background text-foreground min-h-screen">

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <!-- Mobile Menu Toggle -->
    <button id="mobile-menu-toggle"
        class="fixed top-4 left-4 z-50 lg:hidden bg-primary text-white p-2 rounded-md shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Layout Container -->
    <div class="flex min-h-screen">

        @include('admin.dashboard.partials.navbar')
        <!-- Main Content -->
        <main class="flex-1 bg-background overflow-auto w-full lg:w-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pt-16 lg:pt-8">
               
                <!-- Tabs -->

                <!-- Participants Table -->
                @yield('section')
            </div>
        </main>

    </div>

    <!-- JavaScript -->
    <script>
        // Modal utility functions
        function showModal(modal) {
            if (modal) {
                modal.classList.remove('is-hidden');
                modal.classList.add('modal-visible');
            }
        }
        
        function hideModal(modal) {
            if (modal) {
                modal.classList.remove('modal-visible');
                modal.classList.add('is-hidden');
            }
        }
        
        function initModal(modalId, openBtnId, closeBtnId, cancelBtnId) {
            const modal = document.getElementById(modalId);
            const openBtn = document.getElementById(openBtnId);
            const closeBtn = closeBtnId ? document.getElementById(closeBtnId) : null;
            const cancelBtn = cancelBtnId ? document.getElementById(cancelBtnId) : null;
        
            // Open modal button
            if (openBtn) {
                openBtn.addEventListener('click', () => {
                    showModal(modal);
                });
            }
        
            // Close button inside modal
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    hideModal(modal);
                });
            }
        
            // Cancel button inside modal (usually for forms)
            if (cancelBtn) {
                cancelBtn.addEventListener('click', () => {
                    hideModal(modal);
                });
            }
        
            // Click outside modal content closes modal
            if (modal) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        hideModal(modal);
                    }
                });
            }
        }
        
        // Close modal with Escape key
        function setupEscapeKey() {
            document.addEventListener('keydown', (e) => {
                if (e.key === "Escape") {
                    const modals = document.querySelectorAll('.fixed.inset-0.bg-black\\/50.z-50.p-4:not(.is-hidden)');
                    modals.forEach(modal => hideModal(modal));
                }
            });
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize participant modal
            initModal('participant-modal', 'add-participant-btn', 'close-participant-modal', 'cancel-participant');
        
            // Initialize spectator modal
            initModal('spectator-modal', 'add-spectator-btn', 'close-spectator-modal', 'cancel-spectator');
        
            // Initialize view details modal
            initModal('view-modal', null, 'close-view-modal', null);
        
            // Setup Escape key handler for all modals
            setupEscapeKey();
        });
    </script>

    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const sidebar = document.getElementById('sidebar');

        mobileMenuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                if (!sidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    sidebar.classList.add('hidden');
                }
            }
        });
    </script>

</body>

</html>
