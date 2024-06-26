<template>
    <!-- Admission Request Start -->
    <Link v-if="$page.props.auth.role == 'admin'" :href="route('student.admission.all')"
        class="relative inline-flex flex-shrink-0 justify-center items-center gap-2 h-[2.375rem] w-[2.375rem] rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
    <AcademicCapIcon class="w-6 h-6" />
    <div v-if="$page.props.admission_request_count"
        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
        {{ $page.props.admission_request_count }}
    </div>
    </Link>
    <!-- Admission Request Start End -->
    <!-- Dark Mood -->
    <button @click="toggleDarkMode" type="button" id="darkMode"
        class="inline-flex flex-shrink-0 justify-center items-center rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
        <SunIcon class="sm:w-6 w-5 sm:h-6 h-5" :class="{ '': !isDark, hidden: isDark }" />
        <MoonIcon class="sm:w-6 w-5 sm:h-6 h-5" :class="{ hidden: !isDark, '': isDark }" />
    </button>
    <!-- Dark Mood End -->
    <!-- Language Switcher -->
    <JetDropdown align="right" width="48" v-if="$page.props.all_locals && $page.props.all_locals.length > 1" id="language">
        <template #trigger>
            <button id="hs-dropdown-with-header" type="button"
                class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                <LanguageIcon class="sm:w-6 w-5 sm:h-6 h-5" />
            </button>
        </template>

        <template #content>
            <div v-for="(lang, index) in $page.props.all_locals" :key="index">
                <JetDropdownLink @click="changeDic($page.props.locale, $page.props.all_locals, lang.direction)" :href="route('change.language', lang.code)"
                    :class="$page.props.locale == lang.code ? 'bg-gray-100' : ''">
                    {{ lang.name }}
                </JetDropdownLink>
                <div v-if="$page.props.all_locals.length != index + 1" class="border-t border-gray-100"></div>
            </div>
        </template>
    </JetDropdown>
    <!-- Language Switcher End -->
    <!-- Currency Switcher -->
    <JetDropdown align="right" width="48" v-if="$page.props.all_currencies && $page.props.all_currencies.length > 1" id="currency">
        <template #trigger>
            <button id="hs-dropdown-with-header" type="button"
                class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center  rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                <BanknotesIcon class="sm:w-6 w-4 sm:h-6 h-4" />
            </button>
        </template>

        <template #content>
            <div v-for="(currency, index) in $page.props.all_currencies" :key="index">
                <JetDropdownLink :href="route('change.currency.session', currency.code)"
                    :class="$page.props.default_currency == currency.code ? 'bg-gray-100' : ''">
                    {{ currency.symbol + " - " + currency.code }}
                </JetDropdownLink>
                <div v-if="$page.props.all_currencies.length != index + 1" class="border-t border-gray-100"></div>
            </div>
        </template>
    </JetDropdown>
    <!-- Currency Switcher End -->
    <!-- Notification -->
    <button @click="toggleNotificationPanel" type="button" id="notification"
        class="inline-flex flex-shrink-0 justify-center items-center gap-2 rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800"
        data-hs-offcanvas="#hs-notification-panel-right">
        <BellIcon class="sm:w-6 w-5 sm:h-6 h-5" />
    </button>

    <!-- Pending Leave -->
    <Link v-if="$page.props.auth.role == 'Admin'" :href="route('manage-leave.index')" :data="{ status: 'pending' }"
        class="leave_request_top_section relative inline-flex flex-shrink-0 justify-center items-center rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
    <QueueListIcon class="sm:w-6 w-5 sm:h-6 h-5" />
    <div class="absolute inline-flex items-center justify-center sm:w-6 w-5 h-5 sm:h-6 sm:text-xs text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900"
        v-if="$page.props.pending_leave_count">
        {{ $page.props.pending_leave_count }}
    </div>
    </Link>

    <Link :href="route('notice-board.index')" v-if="can('notice-board.index')"
        class="notice_board_top_section hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
    <SpeakerWaveIcon class="sm:w-6 w-5 sm:h-6 h-5" />
    </Link>
    <div class="hs-dropdown relative inline-flex" data-hs-dropdown-placement="bottom-right">
        <button id="hs-dropdown-with-header" v-if="$page.props.jetstream.managesProfilePhotos" type="button"
            class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
            <img class="inline-block sm:h-8 h-5 sm:w-8 w-5 rounded-full ring-2 ring-white dark:ring-gray-800"
                :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
        </button>
        <span v-else class="inline-flex rounded-md">
            <button type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                {{ $page.props.user.name }}
                <ArrowDownIcon class="md:w-6 w-4 md:h-6 h-4" />
            </button>
        </span>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700"
            aria-labelledby="hs-dropdown-with-header">
            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg dark:bg-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Signed in as') }}
                    <span
                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-600 dark:text-gray-400">
                        {{ $page.props.auth.role }}
                    </span>
                </p>
                <p class="text-sm font-medium text-gray-800 dark:text-gray-300">
                    {{ $page.props.auth.email }}
                </p>
            </div>
            <div class="mt-2 py-2 first:pt-0 last:pb-0" id="logout">
                <Link preserve-scroll :href="route('profile')"
                    class="flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                <user-icon classes="md:w-6 w-4 md:h-6 h-4" />
                {{ __("Profile") }}
                </Link>
                <Link preserve-scroll href="javascript:void(0)" @click="logout"
                    class="flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                <log-out classes="md:w-6 w-4 md:h-6 h-4" />
                {{ __("Logout") }}
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { PlusCircleIcon, SunIcon, MoonIcon, LanguageIcon, BellIcon, AcademicCapIcon, QueueListIcon, SpeakerWaveIcon, CurrencyDollarIcon, BanknotesIcon } from '@heroicons/vue/24/outline'
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";

// Dark Light Mode
let isDark = ref(false);
isDark.value = localStorage.getItem("darkMode") == "true";
const toggleDarkMode = () => {
    if (localStorage.getItem("darkMode") == "true") {
        document.body.classList.remove("dark");
        localStorage.setItem("darkMode", "false");
        isDark.value = false;
        // changeLogo(false);
    } else {
        document.body.classList.add("dark");
        localStorage.setItem("darkMode", "true");
        isDark.value = true;
        // changeLogo(true);
    }
};

// Notification Panel
let isNotification = ref(false);
isNotification.value = localStorage.getItem("nPanel") == "true";
const toggleNotificationPanel = () => {
    if (localStorage.getItem("notificationPanel") == "true") {
        document.querySelector('#nPanel').classList.remove("open");
        document.querySelector(".npanel-overlay").classList.remove('active');
        localStorage.setItem("nPanel", "false");
        isNotification.value = false;
    } else {
        document.querySelector('#nPanel').classList.add("open");
        document.querySelector(".npanel-overlay").classList.add('active');
        localStorage.setItem("nPanel", "true");
        isNotification.value = true;
    }
};


const changeDic = (locale, languages, direction) => {

    const languageObject = languages.find(lang => lang.code === locale);

    let localeDirection;

    if (languageObject) {
        localeDirection = languageObject.direction;
    } else {

    }

    if (localeDirection != direction) {
        window.location.reload();
    }

};

const logout = () => {
    Inertia.post(route("logout"));
};
</script>
<style></style>
