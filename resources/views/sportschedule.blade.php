<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Schedule - Sports Competition 2025</title>
    <meta name="description" content="View the complete sports schedule for Sports Competition 2025">
    <script src="https://cdn.tailwindcss.com"></script>
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
                        muted: {
                            DEFAULT: 'hsl(210, 40%, 96%)',
                            foreground: 'hsl(215, 16%, 47%)',
                        },
                    },
                    keyframes: {
                        'fade-in': {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        'slide-up': {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                    },
                    animation: {
                        'fade-in': 'fade-in 0.6s ease-out',
                        'slide-up': 'slide-up 0.6s ease-out',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-hero {
            background: linear-gradient(135deg, hsl(217, 91%, 60%) 0%, hsl(142, 76%, 36%) 100%);
        }
        .gradient-card {
            background: linear-gradient(135deg, hsl(217, 91%, 60%, 0.05) 0%, hsl(27, 96%, 61%, 0.05) 100%);
        }
        .sport-basketball { background-color: hsl(27, 96%, 61%, 0.1); border-left: 4px solid hsl(27, 96%, 61%); }
        .sport-football { background-color: hsl(142, 76%, 36%, 0.1); border-left: 4px solid hsl(142, 76%, 36%); }
        .sport-volleyball { background-color: hsl(217, 91%, 60%, 0.1); border-left: 4px solid hsl(217, 91%, 60%); }
        .sport-badminton { background-color: hsl(330, 80%, 60%, 0.1); border-left: 4px solid hsl(330, 80%, 60%); }
        .sport-athletics { background-color: hsl(280, 70%, 50%, 0.1); border-left: 4px solid hsl(280, 70%, 50%); }
    </style>
</head>
<body class="min-h-screen bg-[hsl(210,100%,97%)]">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-md z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-[hsl(217,91%,60%)] to-[hsl(142,76%,36%)] bg-clip-text text-transparent">
                    Sports Competition 2025
                </h1>
                <div class="hidden md:flex gap-4">
                    <a href="index.html" class="px-4 py-2 rounded-lg font-medium border-2 border-[hsl(217,91%,60%)] text-[hsl(217,91%,60%)] hover:bg-[hsl(217,91%,60%)] hover:text-white transition-all">
                        Home
                    </a>
                    <a href="participant.html" class="px-4 py-2 rounded-lg font-medium border-2 border-[hsl(217,91%,60%)] text-[hsl(217,91%,60%)] hover:bg-[hsl(217,91%,60%)] hover:text-white transition-all">
                        Register as Athlete
                    </a>
                    <a href="spectator.html" class="px-4 py-2 rounded-lg font-medium border-2 border-[hsl(27,96%,61%)] text-[hsl(27,96%,61%)] hover:bg-[hsl(27,96%,61%)] hover:text-white transition-all">
                        Register as Spectator
                    </a>
                    <a href="sports-schedule.html" class="px-4 py-2 rounded-lg font-medium bg-[hsl(142,76%,36%)] text-white hover:opacity-90 transition-opacity">
                        Schedule
                    </a>
                </div>
                <button id="mobile-menu-btn" class="md:hidden text-2xl text-[hsl(222,47%,11%)]">☰</button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <a href="index.html" class="block px-4 py-3 hover:bg-[hsl(210,40%,96%)] text-[hsl(222,47%,11%)]">Home</a>
            <a href="participant.html" class="block px-4 py-3 hover:bg-[hsl(210,40%,96%)] text-[hsl(222,47%,11%)]">Register as Athlete</a>
            <a href="spectator.html" class="block px-4 py-3 hover:bg-[hsl(210,40%,96%)] text-[hsl(222,47%,11%)]">Register as Spectator</a>
            <a href="sports-schedule.html" class="block px-4 py-3 bg-[hsl(142,76%,36%)] text-white">Schedule</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 pb-12 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-10 animate-fade-in">
                <h1 class="text-4xl font-bold text-[hsl(222,47%,11%)] mb-2">📅 Sports Schedule</h1>
                <p class="text-[hsl(215,16%,47%)]">Complete event schedule for Sports Competition 2025</p>
            </div>

            <!-- Legend -->
            <div class="bg-white rounded-xl shadow-xl p-6 mb-8 animate-fade-in">
                <h3 class="font-semibold text-[hsl(222,47%,11%)] mb-4">Sport Legend</h3>
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-2 rounded-full bg-[hsl(27,96%,61%,0.15)] text-[hsl(27,96%,61%)] text-sm font-medium">🏀 Basketball</span>
                    <span class="px-4 py-2 rounded-full bg-[hsl(142,76%,36%,0.15)] text-[hsl(142,76%,36%)] text-sm font-medium">⚽ Football</span>
                    <span class="px-4 py-2 rounded-full bg-[hsl(217,91%,60%,0.15)] text-[hsl(217,91%,60%)] text-sm font-medium">🏐 Volleyball</span>
                    <span class="px-4 py-2 rounded-full bg-[hsl(330,80%,60%,0.15)] text-[hsl(330,80%,60%)] text-sm font-medium">🏸 Badminton</span>
                    <span class="px-4 py-2 rounded-full bg-[hsl(280,70%,50%,0.15)] text-[hsl(280,70%,50%)] text-sm font-medium">🏃 Athletics</span>
                </div>
            </div>

            <!-- Day 1 -->
            <div class="mb-8 animate-slide-up" style="animation-delay: 0.1s">
                <div class="gradient-hero text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-xl font-bold">📆 Day 1 - Monday, March 15</h2>
                </div>
                <div class="bg-white rounded-b-xl shadow-xl overflow-hidden">
                    <div class="sport-basketball p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">08:00 AM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏀 Basketball</h3>
                                <p class="text-[hsl(215,16%,47%)]">Team A vs Team B</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Main Court</span>
                        </div>
                    </div>
                    <div class="sport-football p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">10:00 AM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">⚽ Football</h3>
                                <p class="text-[hsl(215,16%,47%)]">Team C vs Team D</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Football Field</span>
                        </div>
                    </div>
                    <div class="sport-volleyball p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">02:00 PM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏐 Volleyball</h3>
                                <p class="text-[hsl(215,16%,47%)]">Team E vs Team F</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Indoor Gym</span>
                        </div>
                    </div>
                    <div class="sport-badminton p-5">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">04:00 PM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏸 Badminton</h3>
                                <p class="text-[hsl(215,16%,47%)]">Singles Round 1</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Sports Hall</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Day 2 -->
            <div class="mb-8 animate-slide-up" style="animation-delay: 0.2s">
                <div class="gradient-hero text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-xl font-bold">📆 Day 2 - Tuesday, March 16</h2>
                </div>
                <div class="bg-white rounded-b-xl shadow-xl overflow-hidden">
                    <div class="sport-athletics p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">08:00 AM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏃 Athletics</h3>
                                <p class="text-[hsl(215,16%,47%)]">100m Sprint Heats</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Track Field</span>
                        </div>
                    </div>
                    <div class="sport-basketball p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">10:00 AM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏀 Basketball</h3>
                                <p class="text-[hsl(215,16%,47%)]">Semi-Finals</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Main Court</span>
                        </div>
                    </div>
                    <div class="sport-football p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">02:00 PM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">⚽ Football</h3>
                                <p class="text-[hsl(215,16%,47%)]">Quarter Finals</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Football Field</span>
                        </div>
                    </div>
                    <div class="sport-volleyball p-5">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">04:00 PM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏐 Volleyball</h3>
                                <p class="text-[hsl(215,16%,47%)]">Semi-Finals</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Indoor Gym</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Day 3 -->
            <div class="mb-8 animate-slide-up" style="animation-delay: 0.3s">
                <div class="gradient-hero text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-xl font-bold">📆 Day 3 - Wednesday, March 17 (Finals)</h2>
                </div>
                <div class="bg-white rounded-b-xl shadow-xl overflow-hidden">
                    <div class="sport-athletics p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">09:00 AM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏃 Athletics</h3>
                                <p class="text-[hsl(215,16%,47%)]">100m Sprint Finals</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Track Field</span>
                        </div>
                    </div>
                    <div class="sport-badminton p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">11:00 AM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏸 Badminton</h3>
                                <p class="text-[hsl(215,16%,47%)]">Finals</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Sports Hall</span>
                        </div>
                    </div>
                    <div class="sport-volleyball p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">02:00 PM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏐 Volleyball</h3>
                                <p class="text-[hsl(215,16%,47%)]">Finals</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Indoor Gym</span>
                        </div>
                    </div>
                    <div class="sport-basketball p-5 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">04:00 PM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">🏀 Basketball</h3>
                                <p class="text-[hsl(215,16%,47%)]">Finals</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Main Court</span>
                        </div>
                    </div>
                    <div class="sport-football p-5">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm text-[hsl(215,16%,47%)] font-medium">06:00 PM</span>
                                <h3 class="font-bold text-[hsl(222,47%,11%)]">⚽ Football</h3>
                                <p class="text-[hsl(215,16%,47%)]">Championship Match</p>
                            </div>
                            <span class="text-sm text-[hsl(215,16%,47%)] mt-2 md:mt-0">📍 Football Field</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="gradient-card border border-[hsl(217,91%,60%,0.2)] rounded-xl p-6 animate-fade-in">
                <h3 class="font-bold text-[hsl(217,91%,60%)] mb-3">ℹ️ Important Information</h3>
                <ul class="text-[hsl(222,47%,11%)] space-y-2 text-sm">
                    <li>• All times are subject to change</li>
                    <li>• Please arrive 30 minutes before each event</li>
                    <li>• Spectators must register at the entrance</li>
                    <li>• Food and drinks are available at the venue</li>
                </ul>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[hsl(222,47%,11%)] text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 School Sports Competition. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>