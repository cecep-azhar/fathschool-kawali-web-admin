<template>
    <template v-if="announcements.length && showAnnouncement">
        <div class="relative bg-indigo-600">
            <div class="mx-auto max-w-7xl py-3 px-3 sm:px-6 lg:px-8" v-for="announcement in announcements"
                :key="announcement.id">
                <div class="pr-16 sm:px-16 sm:text-center">
                    <p class="font-medium text-white mb-0">
                        <span class="inline">{{ announcement.title }}</span>
                        <span class="block sm:ml-2 sm:inline-block">
                            <Link :href="route('announcement.details', announcement.id)"
                                class="font-bold text-white underline">
                            {{ __('Learn more') }}
                            <span aria-hidden="true"> &rarr;</span>
                            </Link>
                        </span>
                    </p>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-start pt-1 pr-1 sm:items-start sm:pt-1 sm:pr-2">
                    <button @click="hideAnnouncement" type="button"
                        class="flex rounded-md p-2 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="sr-only">{{ __('Dismiss') }}</span>
                        <XMarkIcon class="w-6 h-6 text-white" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>
    </template>

    <div class="bg-white">
        <header class="relative bg-blue-gray-800">
            <div class="absolute inset-0">
                <img class="h-full w-full object-cover" src="/images/bg-smkkawali.jpg" :alt="setting.text_logo_name" />
                <div class="absolute inset-0 bg-blue-gray-500 mix-blend-multiply" aria-hidden="true" />
            </div>
            <Popover as="div" class="relative z-10">
                <nav class="relative mx-auto flex max-w-7xl items-center justify-between px-4 pt-6 pb-2 sm:px-6 lg:px-8"
                    aria-label="Global">
                    <div class="flex flex-1 items-center">
                        <div class="flex w-full items-center justify-between lg:w-auto">
                            <Link href="/">
                            <span class="sr-only">{{ text_logo_name }}</span>
                            <img class="h-8 w-auto sm:h-10" :src="setting.dark_logo_url" :alt="setting.text_logo_name" />
                            </Link>
                            <div class="-mr-2 flex items-center lg:hidden">
                                <PopoverButton
                                    class="focus-ring-inset inline-flex items-center justify-center rounded-md bg-blue-gray-900 bg-opacity-0 p-2 text-white hover:bg-opacity-100 focus:outline-none focus:ring-2 focus:ring-white">
                                    <span class="sr-only">Open main menu</span>
                                    <Bars3Icon class="w-6 h-6" aria-hidden="true" />
                                </PopoverButton>
                            </div>
                        </div>
                        <div class="hidden space-x-10 lg:ml-10 lg:flex">
                            <Link :href="item.href" v-for="item in navigation" :key="item.name"
                                class="text-base font-medium text-white hover:text-blue-100">
                            {{ item.name }}
                            </Link>
                        </div>
                    </div>
                    <div class="hidden lg:flex lg:items-center lg:space-x-6">
                        <Link preserve-scroll v-if="$page.props.user" :href="route('dashboard')"
                            class="rounded-md border border-transparent bg-blue-500 py-2 px-6 text-base font-medium text-white shadow-md hover:bg-blue-600">
                        {{ __('Dashboard') }}
                        </Link>

                        <template v-else>
                            <Link preserve-scroll :href="route('login')"
                                class="rounded-md border border-transparent bg-blue-500 py-2 px-6 text-base font-medium text-white shadow-md hover:bg-blue-600">
                            {{ __('Login') }}
                            </Link>

                            <Link preserve-scroll v-if="canRegister" :href="route('register')"
                                class="ml-4 rounded-md border border-transparent bg-blue-500 py-2 px-6 text-base font-medium text-white shadow-md hover:bg-blue-600">
                            {{ __('Register') }}
                            </Link>
                        </template>
                    </div>
                </nav>

                <transition enter-active-class="duration-150 ease-out" enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in"
                    leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                    <PopoverPanel focus class="absolute inset-x-0 top-0 origin-top transform p-2 transition lg:hidden">
                        <div class="overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="flex items-center justify-between px-5 pt-4">
                                <div>
                                    <img class="h-8 w-auto" :src="setting.dark_logo_url" :alt="setting.text_logo_name" />
                                </div>
                                <div class="-mr-2">
                                    <PopoverButton
                                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-blue-gray-400 hover:bg-blue-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                                        <span class="sr-only">Close menu</span>
                                        <XMarkIcon class="w-6 h-6" aria-hidden="true" />
                                    </PopoverButton>
                                </div>
                            </div>
                            <div class="pt-5 pb-6">
                                <div class="space-y-1 px-2">
                                    <a v-for="item in navigation" :key="item.name" :href="item.href"
                                        class="block rounded-md px-3 py-2 text-base font-medium text-blue-gray-900 hover:bg-blue-gray-50">
                                        {{ item.name }}
                                    </a>
                                </div>
                                <div class="mt-6 px-5">
                                    <Link :href="route('login')"
                                        class="block w-full rounded-md border border-transparent bg-blue-500 py-2 px-4 text-center font-medium text-white shadow hover:bg-blue-600">
                                        {{ __('Login') }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </PopoverPanel>
                </transition>
            </Popover>

            <div class="relative mx-auto mt-24 max-w-md px-4 pb-32 sm:max-w-3xl sm:px-6 md:mt-32 lg:max-w-7xl lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <main>
            <!-- <div class="flex flex-col lg:flex-row lg:items-center lg:justify-center">
                <div class="flex-1 p-4">
                    <iframe :width="videoWidth" :height="videoHeight" :src="videoSrc" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="flex-1 p-4">
                    <h1>Video Profile SMKN 1 KAWALI</h1>
                    <p>Lihat Lingkungan dan Fasilitas-fasilitas SMKN 1 KAWALI Dalam Bentuk Video.</p>
                    
                </div>
            </div> -->
            <slot />
        </main>

        <footer class="bg-gray-900">
            <div class="mx-auto max-w-md overflow-hidden py-12 px-4 sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="flex justify-center gap-6">
                    <template v-for="(link, index) in social_links" :key="index">
                        <a :href="link.url" class="flex items-center text-white" target="_blank">
                            <img :src="link.icon_url" alt="icon" class="h-7 w-7 object-cover">
                        </a>
                    </template>
                </div>

                <p class="mt-8 text-center text-base text-gray-400">
                    &copy; {{ yearNow }} {{ setting.text_logo_name }}
                    {{ __('All rights reserved') }}
                </p>
            </div>
        </footer>
    </div>

    <success-toast />
    <warning-toast />
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import SuccessToast from "@/Shared/SuccessToast.vue";
import WarningToast from "@/Shared/WarningToast.vue";
import AuthorWidgetVue from '../Shared/Components/AuthorWidget.vue';
import { defineComponent, h } from 'vue'
import {
    Bars3Icon,
    XMarkIcon,
    LinkIcon
} from '@heroicons/vue/24/outline'

export default {
    components: {
        AuthorWidgetVue,
        SuccessToast,
        WarningToast,
        Bars3Icon,
        XMarkIcon,
        Popover,
        PopoverButton,
        PopoverPanel,
        defineComponent,
        h,
    },
    data() {
        return {
            social_links: this.$page.props.social_links,
            setting: this.$page.props.setting,
            announcements: [],
            yearNow: new Date().getFullYear(),
            navigation: [
                { name: 'Tentang', href: '/aboutschool' },
                { name: 'Fitur', href: '/feature' },
                // { name: 'Kontak', href: '/contact' },
                { name: 'Dokumentasi Program', href: '/documentation' },
            ],
            showAnnouncement: true,
            videoSrc: "https://www.youtube.com/embed/dQw4w9WgXcQ",
            videoWidth: "560",
            videoHeight: "315"
        }
    },
    methods: {
        hideAnnouncement() {
            this.showAnnouncement = false;
            localStorage.setItem("showAnnouncement", 'false');
        },
        startVideo() {
            // Implement logic to start video if needed, for now, it's an embedded video
        }
    },
    async mounted() {
        let response = await axios.get(route('pinnedAnnouncement'))
        this.announcements = response.data
    },
    created() {
        this.showAnnouncement = localStorage.getItem("showAnnouncement") == 'false' ? false : true;
    },
}
</script>

<style>
.haha{
  font-size: 40px;
}

.img{
    margin-left: 160px;
    margin-top: 70px;
}
.hi {
    font-weight: bold;
    margin-left: 30px;
}
</style>
