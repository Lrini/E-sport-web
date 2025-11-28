<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Intramurals 2025</title>
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

        <!-- Left Sidebar -->
        <aside id="sidebar"
            class="gradient-hero w-64 shadow-2xl hidden lg:flex lg:flex-col fixed lg:static inset-y-0 left-0 z-40">
            <!-- Logo/Title -->
            <div class="p-6 border-b border-white/10">
                <h1 class="text-xl font-bold text-white">Admin Dashboard</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <div class="space-y-2">
                    <a href="index.html"
                        class="flex items-center space-x-3 text-white/80 hover:text-white hover:bg-white/10 px-4 py-3 rounded-lg transition-all group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-medium">Home</span>
                    </a>

                    <a href="admin-dashboard.html"
                        class="flex items-center space-x-3 text-white bg-white/20 px-4 py-3 rounded-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-white/10">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" id="logout-btn"
                        class="w-full flex items-center justify-center space-x-2 bg-white/20 hover:bg-white/30 text-white px-4 py-3 rounded-lg font-medium transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-background overflow-auto w-full lg:w-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pt-16 lg:pt-8">

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                    <!-- Total Participants Card -->
                    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-muted-foreground text-sm font-medium">Total Participants</p>
                                <p class="text-3xl font-bold text-primary mt-2" id="total-participants">0</p>
                            </div>
                            <div class="p-3 bg-primary/10 rounded-full">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Spectators Card -->
                    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-muted-foreground text-sm font-medium">Total Spectators</p>
                                <p class="text-3xl font-bold text-secondary mt-2" id="total-spectators">0</p>
                            </div>
                            <div class="p-3 bg-secondary/10 rounded-full">
                                <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Registrations Card -->
                    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-muted-foreground text-sm font-medium">Total Registrations</p>
                                <p class="text-3xl font-bold text-accent mt-2" id="total-registrations">0</p>
                            </div>
                            <div class="p-3 bg-accent/10 rounded-full">
                                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Tabs -->
                <div class="mb-6">
                    <div class="border-b border-border">
                        <nav class="flex space-x-8">
                            <button id="tab-participants"
                                class="tab-btn border-b-2 border-primary py-4 px-1 text-sm font-medium text-primary">
                                Participants
                            </button>
                            <button id="tab-spectators"
                                class="tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-muted-foreground hover:text-foreground hover:border-muted transition-all">
                                Spectators
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Participants Table -->
                <div id="participants-section"
                    class="gradient-card rounded-lg border border-border shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-foreground">Participant Registrations</h2>
                        <div class="flex gap-2">
                            <button id="add-participant-btn"
                                class="px-4 py-2 bg-primary text-white rounded-md hover:opacity-90 transition-opacity text-sm font-medium">
                                + Add Participant
                            </button>
                            <button id="clear-participants"
                                class="text-sm text-red-500 hover:text-red-400 transition-colors px-4 py-2">
                                Clear All
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-muted/50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Grade</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Sport</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Contact</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Consent</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody id="participants-tbody" class="divide-y divide-border">
                                <!-- Participants will be inserted here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <div id="participants-empty" class="hidden px-6 py-12 text-center">
                        <p class="text-muted-foreground">No participant registrations yet.</p>
                    </div>
                </div>

                <!-- Spectators Table -->
                <div id="spectators-section"
                    class="hidden gradient-card rounded-lg border border-border shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-foreground">Spectator Registrations</h2>
                        <div class="flex gap-2">
                            <button id="add-spectator-btn"
                                class="px-4 py-2 bg-secondary text-white rounded-md hover:opacity-90 transition-opacity text-sm font-medium">
                                + Add Spectator
                            </button>
                            <button id="clear-spectators"
                                class="text-sm text-red-500 hover:text-red-400 transition-colors px-4 py-2">
                                Clear All
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-muted/50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Grade</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Contact</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Viewing Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Registered</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody id="spectators-tbody" class="divide-y divide-border">
                                <!-- Spectators will be inserted here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <div id="spectators-empty" class="hidden px-6 py-12 text-center">
                        <p class="text-muted-foreground">No spectator registrations yet.</p>
                    </div>
                </div>
        </main>

    </div>

    <!-- Participant Modal (Create/Edit) -->
    <div id="participant-modal" class="fixed inset-0 bg-black/50 z-50 p-4 hidden grid place-items-center">
        <div
            class="gradient-card rounded-lg border border-border shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-border flex items-center justify-between sticky top-0 gradient-card">
                <h2 id="participant-modal-title" class="text-xl font-semibold text-foreground">Add Participant</h2>
                <button id="close-participant-modal"
                    class="text-muted-foreground hover:text-foreground transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="participant-form" class="p-6 space-y-4">
                <input type="hidden" id="participant-index" value="">

                <!-- Full Name -->
                <div>
                    <label for="participant-fullName" class="block text-sm font-medium text-foreground mb-2">Full Name
                        *</label>
                    <input type="text" id="participant-fullName" required maxlength="100"
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                    <p class="text-sm text-red-500 hidden mt-1" id="participant-fullName-error"></p>
                </div>

                <!-- Grade -->
                <div>
                    <label for="participant-grade" class="block text-sm font-medium text-foreground mb-2">Grade/Year
                        *</label>
                    <select id="participant-grade" required
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                        <option value="">Select grade</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                    <p class="text-sm text-red-500 hidden mt-1" id="participant-grade-error"></p>
                </div>

                <!-- Sport -->
                <div>
                    <label for="participant-sport" class="block text-sm font-medium text-foreground mb-2">Sport
                        *</label>
                    <select id="participant-sport" required
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                        <option value="">Select sport</option>
                        <option value="Futsal">Futsal</option>
                        <option value="Basketball">Basketball</option>
                        <option value="Volleyball">Volleyball</option>
                        <option value="Athletics">Athletics</option>
                        <option value="Badminton">Badminton</option>
                    </select>
                    <p class="text-sm text-red-500 hidden mt-1" id="participant-sport-error"></p>
                </div>

                <!-- Contact Number -->
                <div>
                    <label for="participant-contactNumber"
                        class="block text-sm font-medium text-foreground mb-2">Contact Number *</label>
                    <input type="tel" id="participant-contactNumber" required maxlength="20"
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring"
                        placeholder="e.g., +1234567890">
                    <p class="text-sm text-red-500 hidden mt-1" id="participant-contactNumber-error"></p>
                </div>

                <!-- Parent Consent -->
                <div>
                    <label for="participant-parentConsent"
                        class="block text-sm font-medium text-foreground mb-2">Parent Consent *</label>
                    <select id="participant-parentConsent" required
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                        <option value="">Select option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <p class="text-sm text-red-500 hidden mt-1" id="participant-parentConsent-error"></p>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 gradient-hero text-white font-semibold py-3 px-6 rounded-md hover:opacity-90 transition-opacity">
                        Save Participant
                    </button>
                    <button type="button" id="cancel-participant"
                        class="px-6 py-3 border border-border rounded-md text-foreground hover:bg-muted/20 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Spectator Modal (Create/Edit) -->
<div id="spectator-modal" class="fixed inset-0 bg-black/50 z-50 p-4 hidden grid place-items-center" style="display: none;">
        <div
            class="gradient-card rounded-lg border border-border shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-border flex items-center justify-between sticky top-0 gradient-card">
                <h2 id="spectator-modal-title" class="text-xl font-semibold text-foreground">Add Spectator</h2>
                <button id="close-spectator-modal"
                    class="text-muted-foreground hover:text-foreground transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="spectator-form" class="p-6 space-y-4">
                <input type="hidden" id="spectator-index" value="">

                <!-- Full Name -->
                <div>
                    <label for="spectator-fullName" class="block text-sm font-medium text-foreground mb-2">Full Name
                        *</label>
                    <input type="text" id="spectator-fullName" required maxlength="100"
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                    <p class="text-sm text-red-500 hidden mt-1" id="spectator-fullName-error"></p>
                </div>

                <!-- Grade -->
                <div>
                    <label for="spectator-grade" class="block text-sm font-medium text-foreground mb-2">Grade/Year
                        *</label>
                    <select id="spectator-grade" required
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                        <option value="">Select grade</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                    <p class="text-sm text-red-500 hidden mt-1" id="spectator-grade-error"></p>
                </div>

                <!-- Contact Number -->
                <div>
                    <label for="spectator-contactNumber"
                        class="block text-sm font-medium text-foreground mb-2">Contact Number *</label>
                    <input type="tel" id="spectator-contactNumber" required maxlength="20"
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring"
                        placeholder="e.g., +1234567890">
                    <p class="text-sm text-red-500 hidden mt-1" id="spectator-contactNumber-error"></p>
                </div>

                <!-- Viewing Date -->
                <div>
                    <label for="spectator-viewingDate"
                        class="block text-sm font-medium text-foreground mb-2">Preferred Viewing Date</label>
                    <input type="date" id="spectator-viewingDate"
                        class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                    <p class="text-sm text-red-500 hidden mt-1" id="spectator-viewingDate-error"></p>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 gradient-hero text-white font-semibold py-3 px-6 rounded-md hover:opacity-90 transition-opacity">
                        Save Spectator
                    </button>
                    <button type="button" id="cancel-spectator"
                        class="px-6 py-3 border border-border rounded-md text-foreground hover:bg-muted/20 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="view-modal" class="fixed inset-0 bg-black/50 z-50 p-4 hidden grid place-items-center">
        <div class="gradient-card rounded-lg border border-border shadow-2xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                <h2 id="view-modal-title" class="text-xl font-semibold text-foreground">Registration Details</h2>
                <button id="close-view-modal" class="text-muted-foreground hover:text-foreground transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div id="view-modal-content" class="p-6">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
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
