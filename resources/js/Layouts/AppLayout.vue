<template>
    <div>
        <!-- ========== HEADER ========== -->
        <div v-if="$page.props.auth.role == 'Parent'"
            class="bg-gray-50 text-sm py-2.5 flex justify-center sm:py-4 rtl:lg:pr-64 rtl:lg:pl-0 lg:pl-64 dark:bg-gray-800 dark:border-gray-700 w-full border border-gray-200 rounded-md p-4">
            <div class="flex ml-4 rtl:ml-0 rtl:mr-4 items-center text-center">
                <div class="flex-shrink-0">
                    <ExclamationTriangle classes="w-6 h-6 text-gray-500 dark:text-gray-400" />
                </div>
                <div class="flex-1 items-center text-center md:flex md:justify-between ml-4 dark:text-gray-400">
                    <div class="text-gray-600 dark:text-gray-400">
                        <span class="font-bold">{{ __('You are viewing') }} {{ getChildName() }} {{ __('dashboard') }}
                            .</span>
                        <span class="font-semibold">
                            {{ __('You can change child from below or you go your dashboard') }}
                            <span @click="goToDashboard()"
                                class="text-blue-500 hover:text-blue-400 font-bold cursor-pointer">
                                {{ __('Click Here') }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <header
            class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 sm:py-4 rtl:lg:pr-64 rtl:lg:pl-0 lg:pl-64 dark:bg-gray-800 dark:border-gray-700">
            <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
                <div class="mr-5 lg:mr-0 lg:hidden">
                    <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')"
                        aria-label="Brand">
                    <app-logo class="block" />
                    </Link>
                </div>
                <div class="w-full flex items-center justify-end ml-auto sm:justify-end">
                    <div class="topbar_section inline-flex items-center sm:gap-x-6 gap-x-3 sm:order-3">
                        <top-bar-menu />
                    </div>
                </div>
            </nav>
        </header>

        <!-- Sidebar Toggle -->
        <div
            class="sticky top-[51px] inset-x-0 z-20 bg-white border-y px-4 sm:px-6 sm:top-[71px] md:px-8 lg:hidden dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center py-4">
                <!-- Navigation Toggle -->
                <button type="button" class="sidebar-toggle text-gray-500 hover:text-gray-600"
                    aria-label="Toggle navigation">
                    <span class="sr-only">{{ __('Toggle Navigation') }}</span>
                    <Bars3Icon class="w-6 h-6" />
                </button>

                <!-- Breadcrumb -->
                <div class="ml-3 flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
                    <div class="flex items-center text-sm text-gray-800 dark:text-gray-400">
                        {{
                        route().current() == 'dashboard' || $page.props.auth.role != 'Parent'
                        ? $page.props.auth.role
                        : 'Children'
                        }}
                        <ChevronRightIcon
                            class="flex-shrink-0 mx-3 overflow-visible h-4 w-4 text-gray-400 dark:text-gray-600" />
                    </div>
                    <div class="text-sm font-semibold text-gray-800 truncate dark:text-gray-400" aria-current="page">
                        <template v-if="$slots['header']">
                            <span class="text-gray-500 hover:text-blue-600">
                                <slot name="header" />
                            </span>
                        </template>
                        <template v-else> {{ __('Application') }} </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div
            class="sidebar translate-x-0 transition-all duration-300 transform fixed top-0 rtl:right-0 rtl:left-auto left-0 bottom-0 z-[60] w-64 bg-white border-r border-gray-200 pt-7 pb-10 overflow-y-auto scrollbar-y dark:scrollbar-y dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 flex justify-between items-center">
                <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')"
                    aria-label="Brand">
                <app-logo class="block" />
                </Link>
                <button class="close-menu lg:hidden text-gray-900 dark:text-white">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2321_30319)">
                            <path d="M19.0713 4.92896L4.92915 19.0711" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.92871 4.92896L19.0708 19.0711" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_2321_30319">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                </button>
            </div>
            <nav class="py-6 px-4 w-full flex flex-col flex-wrap">
                <ul class="space-y-1.5 sidebar_section">
                    <admin-sidebar-menu v-if="$page.props.auth.role == 'Admin'" />
                    <accountant-sidebar-menu v-if="$page.props.auth.role == 'Accountant'" />
                    <teacher-sidebar-menu v-if="$page.props.auth.role == 'Teacher'" />
                    <student-sidebar-menu v-if="$page.props.auth.role == 'Student'" />
                    <parent-sidebar-menu v-if="$page.props.auth.role == 'Parent'" />
                    <other-role-menu v-if="
                        $page.props.auth.role != 'Admin' &&
                        $page.props.auth.role != 'Accountant' &&
                        $page.props.auth.role != 'Teacher' &&
                        $page.props.auth.role != 'Student' &&
                        $page.props.auth.role != 'Parent'
                    " />
                </ul>
            </nav>
        </div>

        <!-- Content -->
        <div
            class="w-full pt-5 px-4 sm:px-6 md:px-8 rtl:lg:pl-0 rtl:lg:pr-72 lg:pl-72 bg-slate-200 dark:bg-gray-900 min-h-screen pb-20">

            <Head :title="__(title)" />
            <JetBanner />
            <slot />
        </div>

        <!-- Quick panel item  -->
        <quick-panel />

        <!-- Notification  -->
        <notification />

        <!-- for toast message  -->
        <success-toast />
        <warning-toast />
        <div class="sidebar-overlay"></div>
        <div class="qpanel-overlay"></div>
        <div class="npanel-overlay"></div>
        <AuthorWidget />
    </div>
</template>


<script setup>
    import { ref, onMounted, watch } from "vue";
    import { Inertia } from "@inertiajs/inertia";
    import { Head, Link } from "@inertiajs/inertia-vue3";
    import JetBanner from "@/Jetstream/Banner.vue";
    import AuthorWidget from "../Shared/Components/AuthorWidget.vue";
    import NavLink from "@/Components/Sidebar/NavLink.vue";
    import SuccessToast from "@/Shared/SuccessToast.vue";
    import WarningToast from "@/Shared/WarningToast.vue";
    import AdminSidebarMenu from "@/Layouts/Sidebar/AdminSidebarMenu.vue";
    import AccountantSidebarMenu from "@/Layouts/Sidebar/AccountantSidebarMenu.vue";
    import TeacherSidebarMenu from "@/Layouts/Sidebar/TeacherSidebarMenu.vue";
    import StudentSidebarMenu from "@/Layouts/Sidebar/StudentSidebarMenu.vue";
    import ParentSidebarMenu from "@/Layouts/Sidebar/ParentSidebarMenu.vue";
    import OtherRoleMenu from "@/Layouts/Sidebar/OtherRoleMenu.vue";
    import { usePage } from '@inertiajs/inertia-vue3';
    import QuickPanel from './QuickPanel.vue';
    import Notification from './Notification.vue';
    import TopBarMenu from './TopBarMenu.vue';
    import { HomeIcon, CalendarIcon, CalendarDaysIcon, ExclamationTriangleIcon, Bars3Icon, ChevronRightIcon, MagnifyingGlassIcon } from '@heroicons/vue/24/outline'
    defineProps({
        title: String,
    });

    const showingNavigationDropdown = ref(false);

    var kids = ref(usePage().props.value.kids);
    var already_step_completed = ref(usePage().props.value?.auth?.tour_completed);
    // get viewing children;
    var selected_child = localStorage.getItem('selected_child');

    onMounted(() => {
        if (localStorage.getItem("darkMode") == "true") {
            document.body.classList.add("dark");
        } else {
            document.body.classList.remove("dark");
        }

        const sidebarToggle = document.querySelector(".sidebar-toggle");
        const sidebar = document.querySelector(".sidebar");
        const qPanel = document.querySelector("#quickPanel");
        const nPanel = document.querySelector("#nPanel");
        const sidebarOverlay = document.querySelector(".sidebar-overlay");
        const qpanelOverlay = document.querySelector(".qpanel-overlay");
        const npanelOverlay = document.querySelector(".npanel-overlay");
        const closeMenu = document.querySelector(".close-menu");

        if (!already_step_completed.value) {
            sidebar.classList.add("active");
            sidebarOverlay.classList.add("active");
        }
        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.add("active");
            sidebarOverlay.classList.add("active");
        });
        sidebarOverlay.addEventListener("click", () => {
            sidebar.classList.remove("active");
            sidebarOverlay.classList.remove("active");
        });
        qpanelOverlay.addEventListener("click", () => {
            qPanel.classList.remove("open");
            nPanel.classList.remove("open");
            qpanelOverlay.classList.remove("active");
            if (localStorage.getItem("qPanel") == "true") {
                document.querySelector('#quickPanel').classList.remove("open");
                document.querySelector(".qpanel-overlay").classList.remove('active');
                localStorage.setItem("qPanel", "false");
            } else {
                document.querySelector('#quickPanel').classList.add("open");
                document.querySelector(".qpanel-overlay").classList.add('active');
                localStorage.setItem("qPanel", "true");
            }
        });
        npanelOverlay.addEventListener("click", () => {
            nPanel.classList.remove("open");
            npanelOverlay.classList.remove("active");
            if (localStorage.getItem("nPanel") == "true") {
                document.querySelector('#nPanel').classList.remove("open");
                document.querySelector(".npanel-overlay").classList.remove('active');
                localStorage.setItem("nPanel", "false");
            } else {
                document.querySelector('#nPanel').classList.add("open");
                document.querySelector(".npanel-overlay").classList.add('active');
                localStorage.setItem("nPanel", "true");
            }
        });
        closeMenu.addEventListener("click", () => {
            sidebar.classList.remove("active");
            sidebarOverlay.classList.remove("active");
        });
    });

    const visitChildren = () => {
        localStorage.setItem('selected_child', selected_child)
        Inertia.get(route('kid.dashboard', selected_child))
        // to update name
        getChildName();
    }

    const switchToTeam = (team) => {
        Inertia.put(
            route("current-team.update"), {
            team_id: team.id,
        }, {
            preserveState: false,
        }
        );
        Inertia.put(
            route("current-team.update"), {
            team_id: team.id,
        }, {
            preserveState: false,
        }
        );
    };
    const ChangeDic = (arg) => {
        document.body.setAttribute("dir", arg);
    };

    // get viewing children name
    function getChildName() {
        let name = '';
        for (let index = 0; index < kids.value.length; index++) {
            const roll = kids.value[index].profile.roll_no;
            if (roll == selected_child) {
                name = kids.value[index].name ?? '';
            }
        }
        return name;
    }

    function goToDashboard() {
        Inertia.get(route("dashboard"));
    }
</script>
<style>
    @media (max-width: 1023px) {
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            width: 256px;
            height: 100%;
            -webkit-transform: translateX(calc(-100% - 80px));
            -moz-transform: translateX(calc(-100% - 80px));
            -ms-transform: translateX(calc(-100% - 80px));
            -o-transform: translateX(calc(-100% - 80px));
            transform: translateX(calc(-100% - 80px));
            -webkit-transition: transform 0.45s ease-in-out, opacity 0.45s ease-in-out;
            -moz-transition: transform 0.45s ease-in-out, opacity 0.45s ease-in-out;
            transition: transform 0.45s ease-in-out, opacity 0.45s ease-in-out;
            overflow-y: scroll;
            overscroll-behavior-y: contain;
            scrollbar-width: none;
            z-index: 9999;
        }
        .sidebar.active {
            display: block;
            transform: translateX(0);
        }
        .sidebar-overlay,
        .qpanel-overlay,
        .npanel-overlay {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.24s ease-in-out;
        }

        .dark .sidebar-overlay,
        .dark .qpanel-overlay,
        .dark .npanel-overlay {
            background: rgba(0, 0, 0, 0.8);
        }

        .sidebar-overlay.active,
        .qpanel-overlay.active,
        .npanel-overlay.active {
            z-index: 70;
            opacity: 1;
            visibility: visible;
        }
    }
</style>
