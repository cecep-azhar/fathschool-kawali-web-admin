<template>
    <div id="nPanel"
        class="translate-x-full fixed top-0 right-0 transition-all duration-300 transform h-full max-w-md w-full z-[80] bg-white border-l dark:bg-gray-800 dark:border-gray-700"
        >
        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-white">
                {{ __('Notifications') }}
            </h3>
            <button @click="toggleNotificationPanel" type="button"
                class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800"
                >
                <span class="sr-only">Close</span>
                <XMarkIcon class="w-6 h-6 text-black dark:text-white" />
            </button>
        </div>
        <div class="p-4">
            <template v-if="$page.props.notifications.length > 0">
                <div v-for="(notification, index) in $page.props.notifications" :key="index" class="flex items-center w-full p-4 mb-4 text-gray-500 bg-white rounded-lg border shadow-xs dark:text-gray-400 dark:bg-gray-800"
                    role="alert">
                    <Link :href="notification?.data['url'] ?? '#'" class="flex">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <CheckCircleIcon class="w-6 h-6" />
                        </div>
                        <div class="ml-3 text-sm font-normal">
                            {{ notification.data ? notification.data['title'] : '' }}
                        </div>
                    </Link>
                </div>
            </template>
            <template v-else>
                <div class="ml-3 text-sm font-bold text-center dark:text-gray-400">
                   {{ __('You Dont Have Any Notifications') }}
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/24/outline';

// Notification Panel
let isnPanel = ref(false);
// isNotification.value = localStorage.getItem("notificationPanel") == "true";
const toggleNotificationPanel = () => {
    if (localStorage.getItem("nPanel") == "true") {
        document.querySelector('#nPanel').classList.remove("open");
        document.querySelector(".npanel-overlay").classList.remove('active');
        localStorage.setItem("nPanel", "false");
        isnPanel.value = false;
    } else {
        document.querySelector('#nPanel').classList.add("open");
        document.querySelector(".npanel-overlay").classList.add('active');
        localStorage.setItem("nPanel", "true");
        isnPanel.value = true;
    }
};
</script>

<style>
#nPanel.open{
    transform: translateX(0);
}
</style>
