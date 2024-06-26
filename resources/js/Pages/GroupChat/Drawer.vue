<template>
    <div>
        <div class="drawer p-5 transition-all duration-300 bg-gray-50 dark:bg-gray-800 w-72 absolute -right-72 top-0 bottom-0"
            :class="isOpen ? '!right-0 opacity-100':'hidden opacity-0'">
            <div class="flex justify-between mb-5">
                <h2 class="text-xl dark:text-gray-400">{{ __('Attachments') }}</h2>
                <button @click="isOpen=false" type="button"
                    class="flex justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500">
                    <XMarkIcon class="w-6 h-6 text-black dark:text-white" />
                </button>
            </div>
            <div class="drawer-content" v-if="files && files.length">
                <div class="flex flex-wrap gap-3">
                    <div v-for="file in files" :key="file.id">
                        <div class="doc-img p-3 rounded-lg bg-gray-200 dark:bg-gray-700 relative">
                            <img v-if="file.file && file.file_type && file.file_type.split('/')[0] == 'image'" class="w-20 h-20 object-cover" :src="file.file_url" alt="">
                            <img v-else class="w-20 h-20 object-cover" src="/files/files.png" alt="">
                            <div class="img-overlay absolute top-0 left-0 w-full h-full flex justify-center items-center">
                                <a :href="file.file_url" download>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" width="36" height="36">
                                        <circle cx="18" cy="18" r="17" fill="rgba(0, 0, 0, 0.3)" />
                                        <path fill="#FFFFFF" d="M18 27.5l-6.75-6.75h4.25v-12h4v12h4.25z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center text-center" v-else>
                <div class="rounded py-2 px-4 bg-[#FCF4CB]">
                    <div class="text-xs">
                        {{ __('No sharing files found') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="drawer-overlay" :class="{ active: isOpen }" @click="isOpen=false"></div>
    </div>
</template>
<script>
    import { XMarkIcon } from '@heroicons/vue/24/outline'
    export default {
        components: {
            XMarkIcon
        },
        props: {
            group: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                isOpen: false,
                files: [],
            };
        },
        watch: {
            group: {
                deep: true,
                async handler() {
                    await this.loadAttachments();
                },
            },
        },
        methods: {
            open() {
                this.isOpen = true;
            },
            close() {
                this.isOpen = false;
            },
            async loadAttachments() {
                let response = await axios.get(route('fetch.groupAttachments', this.group.id))
                this.files = response.data
            }
        },
        mounted() {
            this.loadAttachments();
        },
    };
</script>
<style>
    .drawer {
        transition: right 0.3s ease-in-out;
        z-index: 9;
    }

    .drawer.open {
        right: 0;
    }

    .drawer-overlay {
        position: absolute;
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

    .dark .drawer-overlay {
        background: rgba(0, 0, 0, 0.8);
    }

    .drawer-overlay.active {
        z-index: 7;
        opacity: 1;
        filter: alpha(opacity=100);
        visibility: visible;
    }

    .doc-img:hover .img-overlay {
        opacity: 1;
        visibility: visible;
    }

    .img-overlay {
        background-color: rgba(255, 255, 255, 0.25);
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.25), inset 0 0 20px rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(2px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.6s ease-in-out;
    }
</style>
