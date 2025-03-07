<template>
    <!-- <li class="text-xs uppercase mb-2 text-gray-500 pt-6 pl-2">
        {{ __("Application") }}
    </li> -->
    <li>
        <NavLink
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <HomeIcon class="w-6 h-6" />
            {{ __("Dashboard") }}
        </NavLink>
    </li>

    <li>
        <NavLink
            :href="route('leave-student.index')"
            :active="route().current('leave-student.index')"
        >
            <ArrowLeftOnRectangleIcon class="w-6 h-6" />
            {{ __("Leave Request") }}
        </NavLink>
    </li>

    <li v-if="can('report.index')" class="report_section">
        <NavLink
            :href="route('reports.index')"
            :active="route().current('reports.*')"
        >
            <FlagIcon class="h-6 w-5" />
            {{ __("Reports") }}
        </NavLink>
    </li>

    <!-- <li v-if="can('online-class.index')" class="online_class_section">
        <NavLink
            :href="route('online.class.index')"
            :active="
                route().current('online.class.*') ||
                route().current('online.class.*')
            "
        >
            <PlayCircleIcon class="w-6 h-6" />
            {{ __("Online Classes") }}
        </NavLink>
    </li>
    <li v-if="can('assignment.index')" class="assignment_section">
        <NavLink
            :href="route('assignment.index')"
            :active="
                route().current('assignment.*') ||
                route().current('assignment.detail')
            "
        >
            <ClipboardDocumentListIcon class="h-6 w-6" />
            {{ __("Assignment") }}
        </NavLink>
    </li>
    <li v-if="can('attendance.index')" class="attendance_section">
        <NavLink
            :href="route('student.attendance.index')"
            :active="route().current('student.attendance.*')"
        >
            <ShieldCheckIcon class="h-6 w-6" />
            {{ __("Attendance") }}
        </NavLink>
    </li>
    <li v-if="can('exam-result.index')" class="exam_section">
        <NavLink
            :href="route('result.index')"
            :active="route().current('result.index')"
            class="hover-icons"
        >
            <ClipboardDocumentListIcon class="h-6 w-6" />
            {{ __("Publish Exam Result") }}
        </NavLink>
    </li>
    <li v-if="can('group.chat')" class="group_chat_section">
        <NavLink
            :href="route('group.chat')"
            :active="route().current('group.chat')"
        >
            <PaperAirplaneIcon class="w-6 h-6" />
            {{ __("My Messages") }}
        </NavLink>
    </li> -->

    <!-- <li class="text-xs uppercase mb-2 text-gray-500 pt-6 pl-2">
        {{ __("Others") }}
    </li>
    <li v-if="can('syllabus.index')" class="syllabus_section">
        <NavLink
            :href="route('syllabus.index')"
            :active="route().current('syllabus.*')"
        >
            <DocumentDuplicateIcon class="h-6 w-6" />
            {{ __("Syllabus") }}
        </NavLink>
    </li>
    <li v-if="can('meeting.index')" class="meeting">
        <NavLink
            :href="route('meeting.index')"
            :active="route().current('meeting.*')"
        >
            <VideoCameraIcon class="h-6 w-6" />
            {{ __("Meeting") }}
        </NavLink>
    </li>
    <li v-if="can('holiday.index')" class="holiday_section">
        <NavLink
            :href="route('holiday.index')"
            :active="route().current('holiday.*')"
        >
            <CalendarIcon class="w-6 h-6" />
            {{ __("Holiday") }}
        </NavLink>
    </li>
    <li v-if="can('event.index')" class="event_section">
        <NavLink
            :href="route('event.index')"
            :active="route().current('event.index')"
        >
            <CalendarDaysIcon class="h-6 w-6" />
            {{ __("All Events") }}
        </NavLink>
    </li>
    <li v-if="can('notice-board.index')" class="notice_board_section">
        <NavLink
            :href="route('notice-board.index')"
            :active="route().current('notice-board.index')"
        >
            <BellAlertIcon class="w-6 h-6" />
            {{ __("Notice Board") }}
        </NavLink>
    </li>
    <li v-if="can('sms')" class="sms_section">
        <NavLink :href="route('sms.index')" :active="route().current('sms.*')">
            <EnvelopeIcon class="h-6 w-5" />
            {{ __("Send Sms") }}
        </NavLink>
    </li>

    <li v-if="can('request-leave.index')" class="leave_request_section">
        <NavLink
            :href="route('manage-leave.index')"
            :active="route().current('manage-leave.index')"
        >
            <ArrowLeftOnRectangleIcon class="w-6 h-6" />
            {{ __("Leave Request") }}
        </NavLink>
    </li> -->
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import NavLink from "@/Components/Sidebar/NavLink.vue";
import {
    BellAlertIcon,
    ClipboardDocumentListIcon,
    FlagIcon,
    DocumentDuplicateIcon,
    ShieldCheckIcon,
    BookOpenIcon,
    PlusCircleIcon,
    VideoCameraIcon,
    PaperAirplaneIcon,
    HomeIcon,
    CalendarIcon,
    CalendarDaysIcon,
    GiftIcon,
    PlayCircleIcon,
    ArrowLeftOnRectangleIcon,
} from "@heroicons/vue/24/outline";
import Shepherd from "shepherd.js";
export default {
    components: {
        PlusCircleIcon,
        Link,
        NavLink,
        BellAlertIcon,
        ClipboardDocumentListIcon,
        DocumentDuplicateIcon,
        ShieldCheckIcon,
        BookOpenIcon,
        VideoCameraIcon,
        FlagIcon,
        PaperAirplaneIcon,
        HomeIcon,
        CalendarIcon,
        GiftIcon,
        CalendarDaysIcon,
        PlayCircleIcon,
        ArrowLeftOnRectangleIcon,
    },
    data() {
        return {
            tour: null,
            steps: [
                {
                    title: this.getOnboardingContent("welcome", "title"),
                    text: this.getOnboardingContent("welcome", "description"),
                    attachTo: { element: "#welcome", on: "bottom" },
                    buttons: [{ action: this.tourGoNext, text: "Next" }],
                },
                {
                    title: this.getOnboardingContent("topbar_section", "title"),
                    text: this.getOnboardingContent(
                        "topbar_section",
                        "description"
                    ),
                    attachTo: { element: ".topbar_section", on: "bottom" },
                    buttons: [{ action: this.tourGoNext, text: "Next" }],
                },
                {
                    title: this.getOnboardingContent(
                        "sidebar_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "sidebar_section",
                        "description"
                    ),
                    attachTo: { element: ".sidebar_section", on: "right" },
                    buttons: [
                        { action: this.complete, text: "Complete" },
                        { action: this.tourGoNext, text: "Quick overview" },
                    ],
                },
            ],
        };
    },

    mounted() {
        // Cek apakah tour sudah pernah diselesaikan
        if (localStorage.getItem("tourCompleted") === "true") {
            return; // Tidak menjalankan tour lagi
        }

        this.tour = new Shepherd.Tour({
            useModalOverlay: true,
            tourName: "UserTour",
            defaultStepOptions: {
                scrollTo: { behavior: "smooth", block: "center" },
                cancelIcon: { enabled: true, label: "Close tour" },
            },
        });

        this.steps.forEach((step) => {
            this.tour.addStep(step);
        });

        // Cek apakah user sudah menyelesaikan tour sebelumnya
        if (!this.$page.props.auth.tour_completed) {
            this.tour.start();
        }

        this.tour.on("cancel", () => {
            this.closeTour();
        });
    },

    methods: {
        tourGoNext() {
            this.tour.next();
            this.completeStep();
        },
        completeStep() {
            let total_steps = this.tour.steps.length;
            let current_step = this.tour.steps.indexOf(this.tour.currentStep);
            if (total_steps === current_step + 1) {
                this.complete();
            }
        },
        complete() {
            localStorage.setItem("tourCompleted", "true"); // Simpan status selesai
            this.closeTour();
        },
        closeTour() {
            this.tour.cancel(); // Menutup tour
            this.tour = null; // Hapus instance tour
            this.steps = []; // Kosongkan langkah-langkah

            // Tutup sidebar jika masih terbuka
            const sidebar = document.querySelector(".sidebar");
            const sidebarOverlay = document.querySelector(".sidebar-overlay");
            if (sidebar && sidebarOverlay) {
                sidebar.classList.remove("active");
                sidebarOverlay.classList.remove("active");
            }
        },
        tourGoback() {
            this.tour.back();
        },
    },
};
</script>
<style>
.hover-icons .hoverPlus {
    display: none;
    /* Hide the PlusCircleIcon by default */
}

.hover-icons:hover .hoverPlus {
    display: inline-block;
    /* Show the PlusCircleIcon when the parent is being hovered */
}
</style>
