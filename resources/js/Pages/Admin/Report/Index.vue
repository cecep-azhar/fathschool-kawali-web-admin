<template>
    <Head :title="__('Reports')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Reports')" />
        </Breadcrumb>

        <div class="py-12 pb-12">
            <page-header>
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Reports') }}
                </div>
            </page-header>
            <div class="grid gap-12 bg-white dark:bg-gray-800 p-5">
                <div>
                    <ul role="list" class="mt-2 grid grid-cols-1 gap-6 border-gray-200 py-6 sm:grid-cols-2">
                        <li class="flow-root"  v-if="can('report.transaction')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 focus-within:ring-2 transition-all duration-300 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-red-500">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('teacher.attendance')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>
                                            {{ __('Teacher Attendance') }}
                                        </span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>
                        <li class="flow-root"  v-if="can('report.transaction')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 focus-within:ring-2 transition-all duration-300 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-green-500">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('student.leave')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>
                                            {{ __('Student Leave') }}
                                        </span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>
                        <li class="flow-root"  v-if="can('report.transaction')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 focus-within:ring-2 transition-all duration-300 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-gray-500">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('teacher.class')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>
                                            {{ __('Teacher Class Attendance') }}
                                        </span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>
                        <li class="flow-root"  v-if="can('report.transaction')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 focus-within:ring-2 transition-all duration-300 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-yellow-500">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('teacher.rating')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>
                                            {{ __('Teacher Rating') }}
                                        </span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>
                        <li class="flow-root" v-if="can('report.attendance')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-blue-500">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('report.attendance')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>{{ __('Student Attendance') }}</span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>

                        <li class="flow-root"  v-if="can('report.other')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-orange-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="w-6 h-6 ">
                                        <rect width="256" height="256" fill="none" />
                                        <line x1="32" y1="64" x2="32" y2="144" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                        <path d="M56,216c15.7-24.08,41.11-40,72-40s56.3,15.92,72,40" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="16" />
                                        <polygon points="224 64 128 96 32 64 128 32 224 64" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="16" />
                                        <path d="M169.34,82.22a56,56,0,1,1-82.68,0" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('report.student.enroll')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>{{ __('Student Enroll') }}</span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>

                        <li class="flow-root" v-if="can('report.attendance')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        style="width: 20px; height: 20px;" class="feather feather-book">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 17L6.5 3"></path>
                                        <path d="M20 4v15"></path>
                                        <path d="M16 7h4"></path>
                                        <path d="M16 11h4"></path>
                                        <path d="M16 15h4"></path>
                                        <path d="M10 7h4"></path>
                                        <path d="M10 11h4"></path>
                                        <path d="M10 15h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('report.subject.attendance')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>{{ __('Subject Attendance') }}</span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>

                        <li class="flow-root" v-if="can('report.transaction')">
                            <div
                                class="relative -m-2 flex items-center gap-4 rounded-xl p-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                <div
                                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-purple-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"  class="w-6 h-6">
                                        <rect width="256" height="256" fill="none" />
                                        <line x1="80" y1="104" x2="176" y2="104" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                        <line x1="80" y1="136" x2="176" y2="136" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                        <path
                                            d="M32,208V56a8,8,0,0,1,8-8H216a8,8,0,0,1,8,8V208l-32-16-32,16-32-16L96,208,64,192Z"
                                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="16" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <Link :href="route('report.expense')" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <span>{{ __('Expense report') }}</span>
                                        <span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                </div>
                            </div>
                        </li>

                        <li class="flow-root"  v-if="can('report.transaction')">
                                <div
                                    class="relative -m-2 flex items-center gap-4 rounded-xl p-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                    <div
                                        class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-teal-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="w-6 h-6 ">
                                            <rect width="256" height="256" fill="none" />
                                            <path
                                                d="M98.34,141.66a8,8,0,0,0,11.32,0l92.68-91.32a8,8,0,0,1,11.32,0l24,23.6a8,8,0,0,1,0,11.32l-128.4,128.4a8,8,0,0,1-11.32,0l-71.6-72a8,8,0,0,1,0-11.31l24-24a8,8,0,0,1,11.32,0Z"
                                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">
                                            <Link :href="route('report.all.student.fees')" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            <span>{{ __('Monthly Fees Report') }}</span>
                                            <span aria-hidden="true"> &rarr;</span>
                                            </Link>
                                        </h3>
                                    </div>
                                </div>
                            </li>

                            <li class="flow-root"  v-if="can('teacher.class')">
                                <div
                                    class="relative -m-2 flex items-center gap-4 rounded-xl p-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-indigo-500 hover:bg-gray-200 dark:hover:bg-gray-500">
                                    <div
                                        class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg bg-teal-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="w-6 h-6 ">
                                            <rect width="256" height="256" fill="none" />
                                            <path
                                                d="M98.34,141.66a8,8,0,0,0,11.32,0l92.68-91.32a8,8,0,0,1,11.32,0l24,23.6a8,8,0,0,1,0,11.32l-128.4,128.4a8,8,0,0,1-11.32,0l-71.6-72a8,8,0,0,1,0-11.31l24-24a8,8,0,0,1,11.32,0Z"
                                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">
                                            <Link :href="route('teacher.class')" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            <span>{{ __('Teacher Attendance') }}</span>
                                            <span aria-hidden="true"> &rarr;</span>
                                            </Link>
                                        </h3>
                                    </div>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout
    },
};
</script>
