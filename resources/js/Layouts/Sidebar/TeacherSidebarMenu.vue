<template>
    <li class="text-xs uppercase mb-2 text-gray-500 pt-6 pl-2">
        {{ __("Application") }}
    </li>
    <li>
        <NavLink
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <HomeIcon class="w-6 h-6" />
            {{ __("Dashboard") }}
        </NavLink>
    </li>
    <li class="leave_request_section">
        <NavLink
            :href="route('manage-leave.index')"
            :active="route().current('manage-leave.index')"
        >
            <GiftIcon class="w-6 h-6" />
            {{ __("Leave Request") }}
        </NavLink>
    </li>
    <li class="report_section">
        <NavLink
            :href="route('reports.index')"
            :active="route().current('reports.*')"
        >
            <FlagIcon class="h-6 w-5" />
            {{ __("Reports") }}
        </NavLink>
    </li>
    <li v-if="can('online-class.index')" class="online_class_section">
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
    </li>

    <li class="text-xs uppercase mb-2 text-gray-500 pt-6 pl-2">
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
    <li v-if="can('report.index')" class="report_section">
        <NavLink
            :href="route('reports.index')"
            :active="route().current('reports.*')"
        >
            <FlagIcon class="h-6 w-5" />
            {{ __("Reports") }}
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
    </li>
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
                    attachTo: {
                        element: "#welcome",
                        on: "bottom",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent("topbar_section", "title"),
                    text: this.getOnboardingContent(
                        "topbar_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".topbar_section",
                        on: "bottom",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
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
                    attachTo: {
                        element: ".sidebar_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.complete,
                            text: "Complete",
                        },
                        {
                            action: this.tourGoNext,
                            text: "Ouick over",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent(
                        "notice_board_top_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "notice_board_top_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".notice_board_top_section",
                        on: "bottom",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent("notification", "title"),
                    text: this.getOnboardingContent(
                        "notification",
                        "description"
                    ),
                    attachTo: {
                        element: "#notification",
                        on: "bottom",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent("currency", "title"),
                    text: this.getOnboardingContent("currency", "description"),
                    attachTo: {
                        element: "#currency",
                        on: "bottom",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent("language", "title"),
                    text: this.getOnboardingContent("language", "description"),
                    attachTo: {
                        element: "#language",
                        on: "bottom",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent("darkMode", "title"),
                    text: this.getOnboardingContent("darkMode", "description"),
                    attachTo: {
                        element: "#darkMode",
                        on: "bottom",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent(
                        "my_course_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "my_course_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".my_course_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent(
                        "my_schedule_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "my_schedule_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".my_schedule_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent(
                        "online_class_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "online_class_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".online_class_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent(
                        "assignment_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "assignment_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".assignment_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent(
                        "attendance_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "attendance_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".attendance_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent("exam_section", "title"),
                    text: this.getOnboardingContent(
                        "exam_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".exam_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent(
                        "group_chat_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "group_chat_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".group_chat_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent(
                        "syllabus_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "syllabus_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".syllabus_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent("meeting", "title"),
                    text: this.getOnboardingContent("meeting", "description"),
                    attachTo: {
                        element: ".meeting",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent(
                        "holiday_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "holiday_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".holiday_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent("event_section", "title"),
                    text: this.getOnboardingContent(
                        "event_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".event_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },

                {
                    title: this.getOnboardingContent(
                        "notice_board_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "notice_board_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".notice_board_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent("report_section", "title"),
                    text: this.getOnboardingContent(
                        "report_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".report_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next",
                        },
                    ],
                },
                {
                    title: this.getOnboardingContent(
                        "leave_request_section",
                        "title"
                    ),
                    text: this.getOnboardingContent(
                        "leave_request_section",
                        "description"
                    ),
                    attachTo: {
                        element: ".leave_request_section",
                        on: "right",
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Complete",
                        },
                    ],
                },
            ],
        };
    },
    mounted: function () {
        this.tour = new Shepherd.Tour({
            useModalOverlay: true,
            tourName: "UserTour",
            defaultStepOptions: {
                scrollTo: {
                    behavior: "smooth",
                    block: "center",
                },
                cancelIcon: {
                    enabled: true,
                    label: "Close tour",
                },
            },
        });

        this.steps.forEach((step) => {
            this.tour.addStep(step);
        });

        if (!this.$page.props.auth.tour_completed) {
            this.tour.start();
        }

        this.tour.on("cancel", () => {
            const sidebar = document.querySelector(".sidebar");
            const sidebarOverlay = document.querySelector(".sidebar-overlay");
            sidebar.classList.remove("active");
            sidebarOverlay.classList.remove("active");
            this.$inertia.post(
                this.route("tour.completed"),
                {},
                {
                    preserveScroll: true,
                }
            );
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
            if (total_steps == current_step + 1) {
                const sidebar = document.querySelector(".sidebar");
                const sidebarOverlay =
                    document.querySelector(".sidebar-overlay");
                sidebar.classList.remove("active");
                sidebarOverlay.classList.remove("active");
                this.$inertia.post(
                    this.route("tour.completed"),
                    {},
                    {
                        preserveScroll: true,
                    }
                );
            }
        },
        complete() {
            this.tour.cancel();
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
