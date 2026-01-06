<!-- Left Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 hidden w-64 shadow-2xl gradient-hero lg:flex lg:flex-col lg:static">
            <!-- Logo/Title -->
            <div class="p-6 border-b border-white/10">
                <h1 class="text-xl font-bold text-white">Admin Dashboard</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <div class="space-y-2">
                    <a href="/admin/tiketing"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>

                <a href="/admin/tiketing/penonton"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">Penonton</span>
                    </a>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-white/10">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" id="logout-btn"
                        class="flex items-center justify-center w-full px-4 py-3 space-x-2 font-medium text-white transition-all rounded-lg bg-white/20 hover:bg-white/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>
