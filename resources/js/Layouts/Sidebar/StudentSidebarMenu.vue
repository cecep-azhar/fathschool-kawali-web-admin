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
    <li class="my_course_section">
        <NavLink :href="route('my.courses')" :active="route().current('my.courses')">
            <ComputerDesktopIcon class="h-6 w-6" />
            {{ __("My Course") }}
        </NavLink>
    </li>
    <li class="assignment_section">
        <NavLink :href="route('assignment.list')" :active="route().current('assignment.*')">
            <DocumentIcon class="w-6 h-6" />
            {{ __("Assignment") }}
        </NavLink>
    </li>
    <li class="online_class_section">
        <NavLink :href="route('online.classes')" :active="route().current('online.classes')">
            <PlayCircleIcon class="w-6 h-6" />
            {{ __("Online Class") }}
        </NavLink>
    </li>
    <li v-if="can('attendance.index')" class="student_attendance_section">
        <NavLink :href="route('my.attendance')" :active="route().current('my.attendance')">
            <DocumentCheckIcon class="h-6 w-6" />
            {{ __("Attendance") }}
        </NavLink>
    </li>
    <li class="student_routine_section">
        <NavLink :href="route('class.routine')" :active="route().current('class.routine')">
            <CalendarDaysIcon class="h-6 w-6" />
            {{ __("Class Schedule") }}
        </NavLink>
    </li>
    <li v-if="can('exam-result.index')" class="student_result_section">
        <NavLink :href="route('result.index')" :active="route().current('result.index')">
            <ClipboardDocumentCheckIcon class="h-6 w-6" />
            {{ __("Exam & Results") }}
        </NavLink>
    </li>
    <li v-if="can('group.chat')" class="group_chat_section">
        <NavLink :href="route('group.chat')" :active="route().current('group.chat')">
            <ChatBubbleBottomCenterIcon class="w-6 h-6" />
            {{ __("Messages") }}
        </NavLink>
    </li>
    <li class="text-xs uppercase mb-2 text-gray-500 pt-6 pl-2">
        {{ __('Others') }}
    </li>
    <li v-if="can('notice-board.index')" class="notice_board_section">
        <NavLink :href="route('notice-board.index')" :active="route().current('notice-board.index')">
            <BellAlertIcon class="w-6 h-6" />
            {{ __("Notice Board") }}
        </NavLink>
    </li>
    <li v-if="can('request-leave.index')" class="leave_request_section">
        <NavLink :href="route('manage-leave.index')" :active="route().current('manage-leave.index')">
            <UserMinusIcon class="w-6 h-6" />
            {{ __("Leave Request") }}
        </NavLink>
    </li>
    <li v-if="can('transaction.index')" class="student_fees_section">
        <NavLink :href="route('transaction.index')" :active="route().current('transaction.*')">
            <WalletIcon class="h-6 w-6" />
            {{ __("Fees Payment") }}
        </NavLink>
    </li>
    <li v-if="can('holiday.index')" class="holiday_section">
        <NavLink :href="route('holiday.index')" :active="false">
            <CalendarIcon class="w-6 h-6" />
            {{ __("Holiday") }}
        </NavLink>
    </li>
    <li v-if="can('event.index')" class="event_section">
        <NavLink :href="route('event.index')" :active="route().current('event.index')">
            <CalendarDaysIcon class="h-6 w-6" />
            {{ __("All Events") }}
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
import Shepherd from "shepherd.js";

export default {
    data() {
        return {
            list17: false,
            tour: null,
            steps: [
                {
                    title: this.getOnboardingContent('welcome', 'title'),
                    text: this.getOnboardingContent('welcome', 'description'),
                    attachTo: {
                        element: "#welcome",
                        on: "bottom"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('topbar_section', 'title'),
                    text: this.getOnboardingContent('topbar_section', 'description'),
                    attachTo: {
                        element: ".topbar_section",
                        on: "bottom"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('sidebar_section', 'title'),
                    text: this.getOnboardingContent('sidebar_section', 'description'),
                    attachTo: {
                        element: ".sidebar_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.complete,
                            text: "Complete"
                        },
                        {
                            action: this.tourGoNext,
                            text: "Ouick over"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('notice_board_top_section', 'title'),
                    text: this.getOnboardingContent('notice_board_top_section', 'description'),
                    attachTo: {
                        element: ".notice_board_top_section",
                        on: "bottom"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },

                {
                    title: this.getOnboardingContent('notification', 'title'),
                    text: this.getOnboardingContent('notification', 'description'),
                    attachTo: {
                        element: "#notification",
                        on: "bottom"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },

                {
                    title: this.getOnboardingContent('currency', 'title'),
                    text: this.getOnboardingContent('currency', 'description'),
                    attachTo: {
                        element: "#currency",
                        on: "bottom"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },

                {
                    title: this.getOnboardingContent('language', 'title'),
                    text: this.getOnboardingContent('language', 'description'),
                    attachTo: {
                        element: "#language",
                        on: "bottom"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },

                {
                    title: this.getOnboardingContent('darkMode', 'title'),
                    text: this.getOnboardingContent('darkMode', 'description'),
                    attachTo: {
                        element: "#darkMode",
                        on: "bottom"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('my_course_section', 'title'),
                    text: this.getOnboardingContent('my_course_section', 'description'),
                    attachTo: {
                        element: ".my_course_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('assignment_section', 'title'),
                    text: this.getOnboardingContent('assignment_section', 'description'),
                    attachTo: {
                        element: ".assignment_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('online_class_section', 'title'),
                    text: this.getOnboardingContent('online_class_section', 'description'),
                    attachTo: {
                        element: ".online_class_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('student_attendance_section', 'title'),
                    text: this.getOnboardingContent('student_attendance_section', 'description'),
                    attachTo: {
                        element: ".student_attendance_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('my_schedule_section', 'title'),
                    text: this.getOnboardingContent('my_schedule_section', 'description'),
                    attachTo: {
                        element: ".student_routine_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('student_result_section', 'title'),
                    text: this.getOnboardingContent('student_result_section', 'description'),
                    attachTo: {
                        element: ".student_result_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('group_chat_section', 'title'),
                    text: this.getOnboardingContent('group_chat_section', 'description'),
                    attachTo: {
                        element: ".group_chat_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('notice_board_section', 'title'),
                    text: this.getOnboardingContent('notice_board_section', 'description'),
                    attachTo: {
                        element: ".notice_board_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('leave_request_section', 'title'),
                    text: this.getOnboardingContent('leave_request_section', 'description'),
                    attachTo: {
                        element: ".leave_request_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('student_fees_section', 'title'),
                    text: this.getOnboardingContent('student_fees_section', 'description'),
                    attachTo: {
                        element: ".student_fees_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('holiday_section', 'title'),
                    text: this.getOnboardingContent('holiday_section', 'description'),
                    attachTo: {
                        element: ".holiday_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Next"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('event_section', 'title'),
                    text: this.getOnboardingContent('event_section', 'description'),
                    attachTo: {
                        element: ".event_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Complete"
                        }
                    ]
                },
            ]
        }
    },
    mounted: function () {
        this.tour = new Shepherd.Tour({
            useModalOverlay: true,
            tourName: "UserTour",
            defaultStepOptions: {
                scrollTo: {
                    behavior: "smooth",
                    block: "center"
                },
                cancelIcon: {
                    enabled: true,
                    label: "Close tour"
                }
            }
        });

        this.steps.forEach(step => {
            this.tour.addStep(step);
        });

        if (!this.$page.props.auth.tour_completed) {
            this.tour.start();
        }

        this.tour.on('cancel', () => {
            const sidebar = document.querySelector(".sidebar");
            const sidebarOverlay = document.querySelector(".sidebar-overlay");
            sidebar.classList.remove("active");
            sidebarOverlay.classList.remove("active");
            this.$inertia.post(this.route('tour.completed'), {}, {
                preserveScroll: true
            });
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
                const sidebarOverlay = document.querySelector(".sidebar-overlay");
                sidebar.classList.remove("active");
                sidebarOverlay.classList.remove("active");
                this.$inertia.post(this.route('tour.completed'), {}, {
                    preserveScroll: true
                });
            }

        },
        complete(){
          this.tour.cancel();
        },
        tourGoback() {
            this.tour.back();
        },
        toggleList(arg) {
            if (this.list17) {
                this.list17 = false;
            } else {
                this.list17 = true;
            }
        },
    },
    components: {
        NavLink,
        HomeIcon,
        BellAlertIcon,
        PlayCircleIcon,
        CalendarIcon,
        ComputerDesktopIcon,
        DocumentIcon,
        WalletIcon,
        UserIcon,
        ChatBubbleBottomCenterIcon,
        UserMinusIcon,
        DocumentCheckIcon,
        CalendarDaysIcon,
        ClipboardDocumentCheckIcon
    }
}
</script>
