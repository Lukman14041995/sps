<!-- Slide Over Form -->
<div id="slideOver" class="slide-over fixed inset-y-0 right-0 w-full max-w-2xl bg-white z-50">
    <div class="h-full flex flex-col">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-white to-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900" id="formTitle">Create New Position</h2>
                        <p class="text-sm text-gray-500">Fill in the job details below</p>
                    </div>
                </div>
                <button onclick="closeSlideOver()"
                    class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Form -->
        <form id="careerForm" class="flex-1 overflow-y-auto">
            @csrf
            <input type="hidden" id="career_id" name="career_id">

            <div class="p-6 space-y-8">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-6 bg-blue-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Basic Information</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                                Position Title *
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="position" name="position" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                            <div class="text-red-500 text-sm mt-2 hidden" id="position_error"></div>
                        </div>

                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                                Department *
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="department" name="department" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                                <option value="">Select Department</option>
                                <option value="Technology">Technology</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Sales">Sales</option>
                                <option value="Finance">Finance</option>
                                <option value="HR">Human Resources</option>
                                <option value="Operations">Operations</option>
                                <option value="Customer Service">Customer Service</option>
                            </select>
                            <div class="text-red-500 text-sm mt-2 hidden" id="department_error"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="employment_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Employment Type *
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="employment_type" name="employment_type" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                                <option value="">Select Type</option>
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                            </select>
                            <div class="text-red-500 text-sm mt-2 hidden" id="employment_type_error"></div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Location *
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="location" name="location" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                            <div class="text-red-500 text-sm mt-2 hidden" id="location_error"></div>
                        </div>
                    </div>
                </div>

                <!-- Salary Information -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-6 bg-green-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Salary Information</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="salary_min" class="block text-sm font-medium text-gray-700 mb-2">
                                Minimum Salary (Rp)
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                <input type="number" id="salary_min" name="salary_min" min="0"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label for="salary_max" class="block text-sm font-medium text-gray-700 mb-2">
                                Maximum Salary (Rp)
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                <input type="number" id="salary_max" name="salary_max" min="0"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Details -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-6 bg-purple-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Job Details</h3>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Job Description *
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="5" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm"></textarea>
                            <div class="text-red-500 text-sm mt-2 hidden" id="description_error"></div>
                        </div>

                        <div>
                            <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">
                                Requirements *
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea id="requirements" name="requirements" rows="5" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm"
                                placeholder="• Enter each requirement on a new line&#10;• Use bullet points for clarity"></textarea>
                            <div class="text-red-500 text-sm mt-2 hidden" id="requirements_error"></div>
                        </div>

                        <div>
                            <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">
                                Benefits & Perks
                            </label>
                            <textarea id="benefits" name="benefits" rows="3"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm"
                                placeholder="• Health insurance&#10;• Flexible hours&#10;• Remote work options"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-6 bg-amber-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Additional Information</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="application_deadline" class="block text-sm font-medium text-gray-700 mb-2">
                                Application Deadline *
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="application_deadline" name="application_deadline" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                            <div class="text-red-500 text-sm mt-2 hidden" id="application_deadline_error"></div>
                        </div>

                        <div>
                            <label for="vacancies" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of Positions *
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="vacancies" name="vacancies" min="1" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                            <div class="text-red-500 text-sm mt-2 hidden" id="vacancies_error"></div>
                        </div>

                        <div>
                            <label for="experience_required" class="block text-sm font-medium text-gray-700 mb-2">
                                Required Experience (years)
                            </label>
                            <input type="number" id="experience_required" name="experience_required" min="0"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white shadow-sm">
                        </div>

                        <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="flex items-center h-5">
                                <input id="is_active" name="is_active" type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-3">
                                <label for="is_active" class="font-medium text-gray-700">
                                    Active Position
                                </label>
                                <p class="text-sm text-gray-500">This position is open for applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500" id="formHint">All fields marked with * are required</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="closeSlideOver()"
                            class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" id="submitButton"
                            class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                            <span id="submitButtonText">Create Position</span>
                            <span id="loadingSpinner" class="hidden ml-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Overlay -->
<div id="overlay" class="overlay fixed inset-0 bg-black bg-opacity-50 z-40" onclick="closeSlideOver()"></div>