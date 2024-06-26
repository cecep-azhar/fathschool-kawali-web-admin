<template>
    <li class="text-xs uppercase mb-2 text-gray-500 pt-6 pl-2">
        {{ __('Application') }}
    </li>
    <li>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <HomeIcon class="w-6 h-6" />
            {{ __('Dashboard') }}
        </NavLink>
    </li>
    <li v-if="can('transaction.index')">
        <NavLink :href="route('transaction.index')" :active="route().current('transaction.index')">
            <WalletIcon class="h-6 w-6" />
            {{ __("Fees Payment") }}
        </NavLink>
    </li>
    <li v-if="can('assignment.index')">
        <NavLink :href="route('assignment.list')"
            :active="route().current('student.assignment.*') || route().current('assignment.detail')">
            <DocumentIcon class="w-6 h-6" />
            {{ __("Assignment") }}
        </NavLink>
    </li>
    <li v-if="can('attendance.index')">
        <NavLink :href="route('my.attendance')" :active="route().current('my.attendance')">
            <DocumentCheckIcon class="h-6 w-6" />
            {{ __("Attendance") }}
        </NavLink>
    </li>
    <li v-if="can('course-schedule.index')">
        <NavLink :href="route('class.routine')" :active="route().current('class.routine')">
            <CalendarDaysIcon class="h-6 w-6" />
            {{ __("Class Schedule") }}
        </NavLink>
    </li>
    <li v-if="can('exam-result.index')">
        <NavLink :href="route('result.index')" :active="route().current('result.index')">
            <ClipboardDocumentCheckIcon class="h-6 w-6" />
            {{ __("Exam & Results") }}
        </NavLink>
    </li>
</template>

<script>
import NavLink from "@/Components/Sidebar/NavLink.vue";
import {
    BellAlertIcon,
    ComputerDesktopIcon,
    DocumentIcon,
    UserIcon,
    DocumentCheckIcon,
    CalendarDaysIcon,
    UserMinusIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    HomeIcon,
    ChatBubbleBottomCenterIcon,
    WalletIcon,
    CalendarIcon,
    PlayCircleIcon,
    ClipboardDocumentCheckIcon
} from "@heroicons/vue/24/outline";

export default {
    components: {
        NavLink,
        DocumentIcon,
        DocumentCheckIcon,
        CalendarDaysIcon,
        HomeIcon,
        WalletIcon,
        ClipboardDocumentCheckIcon
    },
    data() {
        return {
            list: false,
        }
    },
    methods: {
        toggleList() {
            if (this.list) {
                this.list = false;
            } else {
                this.list = true;
            }
        }
    }
}
</script>

<style>
</style>
