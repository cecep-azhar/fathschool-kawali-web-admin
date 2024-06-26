<script setup>
    import { ref, onMounted } from "vue";
    import { Inertia } from "@inertiajs/inertia";
    import { Head, Link } from "@inertiajs/inertia-vue3";
    import JetBanner from "@/Jetstream/Banner.vue";
    import NavLink from "@/Components/Sidebar/NavLink.vue";
    import SuccessToast from "@/Shared/SuccessToast.vue";
    import WarningToast from "@/Shared/WarningToast.vue";
    import AdminSidebarMenu from "@/Layouts/Sidebar/AdminSidebarMenu.vue";
    import AccountantSidebarMenu from "@/Layouts/Sidebar/AccountantSidebarMenu.vue";
    import TeacherSidebarMenu from "@/Layouts/Sidebar/TeacherSidebarMenu.vue";
    import StudentSidebarMenu from "@/Layouts/Sidebar/StudentSidebarMenu.vue";
    import ParentSidebarMenu from "@/Layouts/Sidebar/ParentSidebarMenu.vue";
    import AuthorWidget from "../Shared/Components/AuthorWidget.vue";
    import TopBarMenu from "./TopBarMenu.vue";
    import { ArrowDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/24/outline'
    import QuickPanel from './QuickPanel.vue';
    import Notification from './Notification.vue';

    defineProps({
        title: String,
    });

    const showingNavigationDropdown = ref(false);

    // Dark Light Mode
    let isDark = ref(false);
    isDark.value = localStorage.getItem("darkMode") == "true";
    const toggleDarkMode = () => {
        if (localStorage.getItem("darkMode") == "true") {
            document.body.classList.remove("dark");
            localStorage.setItem("darkMode", "false");
            isDark.value = false;
        } else {
            document.body.classList.add("dark");
            localStorage.setItem("darkMode", "true");
            isDark.value = true;
        }
    };
    onMounted(() => {
        if (localStorage.getItem("darkMode") == "true") {
            document.body.classList.add("dark");
        } else {
            document.body.classList.remove("dark");
        }

        // get viewing children;
        localStorage.getItem('selected_child');

        const qPanel = document.querySelector("#quickPanel");
        const nPanel = document.querySelector("#nPanel");
        const qpanelOverlay = document.querySelector(".qpanel-overlay");
        const npanelOverlay = document.querySelector(".npanel-overlay");
        const closeMenu = document.querySelector(".close-menu");

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
    });
    const ChangeDic = (arg) => {
        document.body.setAttribute("dir", arg);
    };
    const logout = () => {
        Inertia.post(route("logout"));
    };
</script>

<template>
    <div>
        <!-- ========== HEADER ========== -->
        <header
            class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 sm:py-4 dark:bg-gray-800 dark:border-gray-700">
            <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
                <div class="mr-5">
                    <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')"
                        aria-label="Brand">
                    <app-logo class="block h-9 w-auto" />
                    </Link>
                </div>
                <div class="w-full flex items-center justify-end ml-auto sm:justify-end sm:gap-x-3 sm:order-3">
                    <top-bar-menu />
                </div>
            </nav>
        </header>

        <!-- ========== MAIN CONTENT ========== -->
        <!-- Sidebar Toggle -->
        <div
            class="sticky top-[51px] inset-x-0 z-20 bg-white border-y px-4 sm:px-6 sm:top-[71px] md:px-8 lg:hidden dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center py-4">
                <!-- Navigation Toggle -->
                <button type="button" class="text-gray-500 hover:text-gray-600" aria-label="Toggle navigation">
                    <span class="sr-only">{{ __("Toggle Navigation") }}</span>
                    <toggle-bar />
                </button>
                <!-- End Navigation Toggle -->

                <!-- Breadcrumb -->
                <div class="ml-3 flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
                    <div class="flex items-center text-sm text-gray-800 dark:text-gray-400">
                        {{ $page.props.auth.role }}
                        <ArrowRightIcon class="w-6 h-6" />
                    </div>
                    <div class="text-sm font-semibold text-gray-800 truncate dark:text-gray-400" aria-current="page">
                        <template v-if="$slots['header']">
                            <span class="text-gray-500 hover:text-blue-600">
                                <slot name="header" />
                            </span>
                        </template>
                        <template v-else> {{ __("Application") }} </template>
                    </div>
                </div>
                <!-- End Breadcrumb -->
            </div>
        </div>

        <!-- Sidebar -->

        <!-- Content -->
        <div class="w-full pt-10 px-4 sm:px-6 md:px-8 bg-gray-100 dark:bg-gray-900 min-h-screen">

            <Head :title="title" />
            <JetBanner />
            <slot />
        </div>

        <!-- Quick panel item  -->
        <quick-panel />
        <!-- Quick panel item end  -->

        <!-- Quick panel item  -->
        <notification />
        <!-- Quick panel item end  -->
        <!-- for toast message  -->
        <success-toast />
        <warning-toast />
        <div class="sidebar-overlay"></div>
        <div class="qpanel-overlay"></div>
        <div class="npanel-overlay"></div>
        <AuthorWidget />
    </div>
</template>
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
        filter: alpha(opacity=0);
        visibility: hidden;
        transition: all 0.24s ease-in-out;
    }

    .dark .sidebar-overlay,
    .dark .qpanel-overlay,
    .dark .npanel-overlay {
        background: rgba(0, 0, 0, 0.8);
    }
</style>