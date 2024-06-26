<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';
import { XMarkIcon } from '@heroicons/vue/24/outline';
const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(['close']);


watch(() => props.show, () => {
    if (props.show) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = null;
    }
});

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        'sm': 'sm:max-w-sm',
        'md': 'sm:max-w-md',
        'lg': 'sm:max-w-lg',
        'xl': 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
        '3xl': 'sm:max-w-3xl',
        '4xl': 'sm:max-w-4xl',
        '5xl': 'sm:max-w-5xl',
        '6xl': 'sm:max-w-6xl',
        '7xl': 'sm:max-w-7xl',
        'w-11/12': 'sm:w-11/12',
    }[props.maxWidth];
});
</script>

<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div v-show="show" class="fixed inset-0 grid place-items-center h-screen overflow-y-auto px-4 py-6 sm:px-0 z-50"
                scroll-region style="z-index: 9999;">
                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0"
                    enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-500 opacity-75" />
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div v-show="show"
                        class="mb-6 bg-white dark:bg-gray-900 rounded-lg shadow-xl transform transition-all w-full"
                        :class="maxWidthClass">
                        <div class="bg-white dark:bg-gray-900 dark:text-gray-400 rounded-lg px-6 py-4 pt-6">
                            <div class="text-center sm:text-left sm:rtl:text-right ">
                                <h3 class="text-lg dark:text-gray-400">
                                    <div class="flex justify-between items-center">
                                        <slot name="title" />
                                        <div class="flex gap-2 items-center">
                                            <slot name="icon" />
                                            <div class="cursor-pointer" @click="close">
                                                <XMarkIcon class="w-7 h-7 text-red-500" />
                                            </div>
                                        </div>
                                    </div>
                                </h3>

                                <div class="mt-2 dark:text-gray-400">
                                    <slot name="content" />
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex flex-row justify-between px-6 py-4 bg-white dark:bg-gray-900 text-right rounded-b-lg">
                            <slot name="footer" />
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>

