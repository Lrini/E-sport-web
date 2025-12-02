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