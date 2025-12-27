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
                    <a href="/admin/dashboard"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>

                <a href="/admin/dashboard/acara"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">Acara</span>
                    </a>

                    <a href="/admin/dashboard/lomba"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <span class="font-medium">Lomba</span>
                    </a>

                    <a href="/admin/dashboard/grade"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="font-medium">Grade</span>
                    </a>

                    <a href="/admin/dashboard/penonton"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Penonton</span>
                    </a>

                    <a href="/admin/dashboard/peserta"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Peserta</span>
                    </a>

                    <a href="index.html"
                        class="flex items-center px-4 py-3 space-x-3 transition-all rounded-lg text-white/80 hover:text-white hover:bg-white/10 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Admin</span>
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
