<template>
    <div id="quickPanel"
        class="translate-x-full fixed top-0 right-0 transition-all duration-300 transform h-full max-w-md w-full z-[80] bg-white border-l dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-white">
                {{ __(' Quick Actions') }}
            </h3>
            <button @click="toggleQuickPanel" type="button"
                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                <span class="sr-only">Close</span>
                <XMarkIcon class="w-6 h-6 text-black dark:text-white" />
            </button>
        </div>
        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-1">
            <!-- For Admin  -->
            <template v-if="$page.props.auth.role == 'Admin'">
                <template v-for="(action, index) in adminActions" :key="index">
                    <Link :href="action.link" class="py-3 px-3 bg-white dark:bg-gray-700 dark:border-gray-700 border rounded-lg leading-none flex items-center justify-start space-x-2">
                        <component :is="action.icon" class="w-6 h-6 text-blue-500"/>

                        <div class="whitespace-pre text-blue-500 group-hover:text-slate-800 transition duration-200">
                            {{ __(action.title) }}
                        </div>
                    </Link>
                </template>
            </template>

            <!-- For Teacher-->
            <template v-if="$page.props.auth.role == 'Teacher'">
                <template v-for="(action, index) in teacherActions" :key="index">
                    <Link :href="action.link" class="py-3 px-3 bg-white dark:bg-gray-700 dark:border-gray-700 border rounded-lg leading-none flex items-center justify-start space-x-2">
                        <component :is="action.icon" class="w-6 h-6 text-blue-500"/>

                        <div class="whitespace-nowrap text-blue-500 group-hover:text-slate-800 transition duration-200">
                            {{ __(action.title) }}
                        </div>
                    </Link>
                </template>
            </template>

            <!-- For Accountant-->
            <template v-if="$page.props.auth.role == 'Accountant'">
                <template v-for="(action, index) in accountantActions" :key="index">
                    <Link :href="action.link" class="py-3 px-3 bg-white dark:bg-gray-700 dark:border-gray-700 border rounded-lg leading-none flex items-center justify-start space-x-2">
                        <component :is="action.icon" class="w-6 h-6 text-blue-500"/>

                        <div class="whitespace-pre text-blue-500 group-hover:text-slate-800 transition duration-200">
                            {{ __(action.title) }}
                        </div>
                    </Link>
                </template>
            </template>
        </div>
    </div>
</template>

<script setup>
    import { ref } from "vue";
    import {
        XMarkIcon,
        UserCircleIcon,
        GiftIcon,
        ListBulletIcon,
        DocumentIcon,
        WalletIcon,
        DocumentTextIcon,
        DocumentPlusIcon,
        ShieldCheckIcon,
        ClipboardDocumentCheckIcon,
        BookOpenIcon,
        CalendarIcon,
        SpeakerWaveIcon,
        QueueListIcon,
        UsersIcon,
        UserIcon,
        VideoCameraIcon,
        ComputerDesktopIcon
    } from '@heroicons/vue/24/outline'

    // Quick Panel
    let isQuickPanel = ref(false);
    const qPanel = document.querySelector('#quickPanel')
    isQuickPanel.value = localStorage.getItem("qPanel") == "true";
    const toggleQuickPanel = () => {
        if (localStorage.getItem("qPanel") == "true") {
            document.querySelector('#quickPanel').classList.remove("open");
            document.querySelector(".qpanel-overlay").classList.remove('active');
            localStorage.setItem("qPanel", "false");
            isQuickPanel.value = false;
        } else {
            document.querySelector('#quickPanel').classList.add("open");
            document.querySelector(".panel-overlay").classList.add('active');
            localStorage.setItem("qPanel", "true");
            isQuickPanel.value = true;
        }
    };

    // admin actions
    const adminActions = [
        {
            'icon': UsersIcon,
            'link': route('student.admission.create'),
            'title': 'Student Admission'
        },
        {
            'icon': UsersIcon,
            'link': route('users.create'),
            'title': 'Teacher Registration'
        },
        {
            'icon': QueueListIcon,
            'link': route('manage-leave.index', {'status': 'pending'}),
            'title': 'Pending Leave'
        },
        {
            'icon': SpeakerWaveIcon,
            'link': route('notice-board.create'),
            'title': 'Add an Announcement'
        },
        {
            'icon': CalendarIcon,
            'link': route('event.index'),
            'title': 'Create an Event'
        },
    ]

    // teacher actions
    const teacherActions = [
        {
            'icon': BookOpenIcon,
            'link': route('my-subject'),
            'title': 'Create a Class'
        },
        {
            'icon': ComputerDesktopIcon,
            'link': route('online.class.index'),
            'title': 'Create a Online Class'
        },
        {
            'icon': ClipboardDocumentCheckIcon,
            'link': route('assignment.create'),
            'title': 'Create an Assignment'
        },
        {
            'icon': ShieldCheckIcon,
            'link': route('my.attendance'),
            'title': 'View Today Attendance'
        },
        {
            'icon': VideoCameraIcon,
            'link': route('meeting.index'),
            'title': 'Create New Meeting'
        }
    ]

    // accountant actions
    const accountantActions = [
        {
            'icon': DocumentPlusIcon,
            'link': route('transaction.create'),
            'title': 'Add Transaction'
        },
        {
            'icon': DocumentTextIcon,
            'link': route('invoice.create'),
            'title': 'Add Recurring Invoice'
        },
    ]
</script>

<style>
    #quickPanel.open {
        transform: translateX(0);
    }
</style>
