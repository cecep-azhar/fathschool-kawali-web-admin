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

    <li class="academic_section" v-if="can('academic.management')">
        <a @click="toggleList('list')"
            class="flex justify-between gap-x-3 py-2 px-2.5 text-sm hover:bg-blue-100 text-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 rounded-lg dark:hover:text-white"
            href="javascript:void(0)">
            <div class="flex gap-x-3 items-center">
                <AcademicCapIcon class="w-6 h-6" />
                <div class="text-sm">{{ __("Academic") }}</div>
            </div>
            <div>
                <ChevronUpIcon v-if="list" class="w-4 h-4" />
                <ChevronDownIcon v-else class="w-4 h-4" />
            </div>
        </a>
        <Transition>
            <ul class="ml-4" v-if="route().current('departments.*')
                ? (list = true)
                : list || route().current('course.*')
                    ? (list = true)
                    : list || route().current('subjects.*')
                        ? (list = true)
                        : list || route().current('exam.*')
                            ? (list = true)
                            : list || route().current('grades.*')
                                ? (list = true)
                                : list || route().current('result.*')
                                    ? (list = true)
                                    : list || route().current('routine.*')
                                        ? (list = true)
                                        : list
                ">
                <li>
                    <NavLink class="mt-1" :active="route().current('course.index')" :href="route('course.index')">
                        <list-icon />
                        {{ __("Course") }}
                    </NavLink>
                </li>
                <li>
                    <NavLink class="mt-1" :active="route().current('subjects.index')" :href="route('subjects.index')">
                        <list-icon />
                        {{ __("Subject") }}
                    </NavLink>
                </li>
                <li>
                    <NavLink class="mt-1" :active="route().current('result.rule.*')" :href="route('result.rule.index')">
                        <list-icon />
                        {{ __("Result Rule") }}
                    </NavLink>
                </li>
                <li>
                    <NavLink class="mt-1" :active="route().current('exam.*')" :href="route('exam.index')">
                        <list-icon />
                        {{ __("Exam") }}
                    </NavLink>
                </li>
                <li>
                    <NavLink class="mt-1" :active="route().current('routine.*')" :href="route('routine.index')">
                        <list-icon />
                        {{ __("Class Schedule") }}
                    </NavLink>
                </li>
                <li>
                    <NavLink :href="route('departments.index')" :active="route().current('departments.index')">
                        <list-icon />
                        {{ __("Department") }}
                    </NavLink>
                </li>
            </ul>
        </Transition>
    </li>
    <li v-if="can('meeting.index')">
        <NavLink :href="route('meeting.index')" :active="route().current('meeting.*')">
            <VideoCameraIcon class="h-6 w-6" />
            {{ __("Meeting") }}
        </NavLink>
    </li>
    <li v-if="can('event.index')" class="leave_request_section">
        <NavLink :href="route('manage-leave.index')" :active="route().current('manage-leave.*')">
            <QueueListIcon class="w-6 h-6" />
            {{ __("Leave Request") }}
        </NavLink>
    </li>
    <li v-if="can('transaction.index')" class="transaction_section">
        <NavLink :href="route('all.transaction')" :active="route().current('all.transaction')">
            <WalletIcon class="h-6 w-6" />
            {{ __("All Transaction") }}
        </NavLink>
    </li>
    <li v-if="can('invoice.index')" class="recurring_invoices_section">
        <NavLink :href="route('invoice.index')" :active="route().current('invoice.*')">
            <BanknotesIcon class="h-6 w-6" />
            {{ __("Recurring Invoice") }}
        </NavLink>
    </li>
    <li v-if="can('transaction-type.index')">
        <NavLink :href="route('transaction-type.index')" :active="route().current('transaction-type.*')">
            <RectangleStackIcon class="h-6 w-6" />
            {{ __("Transaction Categories") }}
        </NavLink>
    </li>
    <li v-if="can('plan.index')" class="admission_plan_section">
        <NavLink :href="route('plan.index')" :active="route().current('plan.*')">
            <CurrencyDollarIcon class="h-6 w-6" />
            {{ __("Admission Plan") }}
        </NavLink>
    </li>
    <li v-if="can('event.index')">
        <NavLink :href="route('event.index')" :active="route().current('event.*')">
            <CalendarIcon class="w-6 h-6" />
            {{ __("Event List") }}
        </NavLink>
    </li>
    <li v-if="can('notice-board.index')" class="notice_board_section">
        <NavLink :href="route('notice-board.index')" :active="route().current('notice-board.*')">
            <SpeakerWaveIcon class="w-6 h-6" />
            {{ __("Notice Board") }}
        </NavLink>
    </li>
    <li v-if="can('student.index')">
        <NavLink :href="route('student.admission.all')"
            :active="route().current('student.admission.all') || route().current('student.bulk.*')">
            <UserIcon class="h-6 w-6" />
            {{ __("All Students") }}
        </NavLink>
    </li>
    <li v-if="can('admission.index')">
        <NavLink :href="route('student.admission.index')"
            :active="!route().current('student.admission.all') && route().current('student.admission.*')" class="relative">
            <DocumentPlusIcon class="w-6 h-6" />
            {{ __("Student Admission") }}
            <span v-if="$page.props.admission_request_count"
                class="absolute inline-flex items-center justify-center w-6 h-auto text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full top-3  right-0 dark:border-gray-900 leading-0">
                {{ $page.props.admission_request_count }}
            </span>
        </NavLink>
    </li>
    <li v-if="can('student.promotion')">
        <NavLink :href="route('student.promotion')" :active="route().current('student.promotion')">
            <ArrowUpIcon class="h-6 w-6" />
            {{ __("Student Promotion") }}
        </NavLink>
    </li>
    <li v-if="can('admission.form')">
        <NavLink :href="route('form.index')" :active="route().current('form.*')">
            <NewspaperIcon class="h-6 w-6" />
            {{ __("Admission Form") }}
        </NavLink>
    </li>
    <li v-if="can('users.index')">
        <NavLink :href="route('users.index')" :active="route().current('users.*') ||
            route().current('teacher.classes')
            ">
            <UserIcon class="w-6 h-6" />
            {{ __("All Users") }}
        </NavLink>
    </li>
    <li v-if="can('teacher.list')">
        <NavLink :href="route('teachers.index')" :active="route().current('teachers.*') ||
            route().current('teacher.classes')
            ">
            <UsersIcon class="w-6 h-6" />
            {{ __("All Teachers") }}
        </NavLink>
    </li>
    <li v-if="can('holiday.index')">
        <NavLink :href="route('holiday.index')" :active="route().current('holiday.*')">
            <CalendarIcon class="w-6 h-6" />
            {{ __("Holiday") }}
        </NavLink>
    </li>
    <li v-if="can('sms')">
        <NavLink :href="route('sms.index')" :active="route().current('sms.*')">
            <EnvelopeIcon class="h-6 w-5" />
            {{ __("Send Sms") }}
        </NavLink>
    </li>
    <li v-if="can('report.index')">
        <NavLink :href="route('reports.index')" :active="route().current('reports.*')">
            <FlagIcon class="h-6 w-6" />
            {{ __("Reports") }}
        </NavLink>
    </li>
    <li v-if="can('settings')" class="website_settings_section">
        <NavLink :href="route('settings.general')"
            :active="route().current('admin.website.*') || route().current('settings.*') || route().current('roles.*')">
            <Cog8ToothIcon class="h-6 w-6" />
            {{ __("Settings") }}
        </NavLink>
    </li>
</template>

<script>
import NavLink from "@/Components/Sidebar/NavLink.vue";
import {
    HomeIcon,
    AcademicCapIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    QueueListIcon,
    SpeakerWaveIcon,
    DocumentPlusIcon,
    ArrowUpIcon,
    UserIcon,
    UsersIcon,
    FlagIcon,
    Cog8ToothIcon,
    WalletIcon,
    BanknotesIcon,
    NewspaperIcon,
    RectangleStackIcon,
    CurrencyDollarIcon,
    CalendarIcon,
    VideoCameraIcon
} from "@heroicons/vue/24/outline";
import Shepherd from "shepherd.js";

export default {
    components: {
        NavLink,
        HomeIcon,
        AcademicCapIcon,
        ChevronUpIcon,
        ChevronDownIcon,
        QueueListIcon,
        CalendarIcon,
        SpeakerWaveIcon,
        DocumentPlusIcon,
        ArrowUpIcon,
        UserIcon,
        UsersIcon,
        CalendarIcon,
        FlagIcon,
        Cog8ToothIcon,
        WalletIcon,
        BanknotesIcon,
        RectangleStackIcon,
        CurrencyDollarIcon,
        NewspaperIcon,
        VideoCameraIcon
    },
    data() {
        return {
            list: false,
            list2: false,
            list3: false,
            menuitems: [
                {
                    name: "Application",
                    items: [
                        {
                            name: "Dashboard",
                            icon: HomeIcon,
                        }
                    ]
                },
            ],
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
                    title: this.getOnboardingContent('leave_request_top_section', 'title'),
                    text: this.getOnboardingContent('leave_request_top_section', 'description'),
                    attachTo: {
                        element: ".leave_request_top_section",
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
                    title: this.getOnboardingContent('academic_section', 'title'),
                    text: this.getOnboardingContent('academic_section', 'description'),
                    attachTo: {
                        element: ".academic_section",
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
                    title: this.getOnboardingContent('meeting', 'title'),
                    text: this.getOnboardingContent('meeting', 'description'),
                    attachTo: {
                        element: ".meeting_section",
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
                    title: this.getOnboardingContent('transaction_section', 'title'),
                    text: this.getOnboardingContent('transaction_section', 'description'),
                    attachTo: {
                        element: ".transaction_section",
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
                    title: this.getOnboardingContent('admission_plan_section', 'title'),
                    text: this.getOnboardingContent('admission_plan_section', 'description'),
                    attachTo: {
                        element: ".admission_plan_section",
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
                    title: this.getOnboardingContent('student_section', 'title'),
                    text: this.getOnboardingContent('student_section', 'description'),
                    attachTo: {
                        element: ".student_section",
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
                    title: this.getOnboardingContent('admission_section', 'title'),
                    text: this.getOnboardingContent('admission_section', 'description'),
                    attachTo: {
                        element: ".admission_section",
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
                    title: this.getOnboardingContent('promotion_section', 'title'),
                    text: this.getOnboardingContent('promotion_section', 'description'),
                    attachTo: {
                        element: ".promotion_section",
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
                    title: this.getOnboardingContent('admission_form_section', 'title'),
                    text: this.getOnboardingContent('admission_form_section', 'description'),
                    attachTo: {
                        element: ".admission_form_section",
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
                    title: this.getOnboardingContent('users_section', 'title'),
                    text: this.getOnboardingContent('users_section', 'description'),
                    attachTo: {
                        element: ".users_section",
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
                    title: this.getOnboardingContent('teachers_section', 'title'),
                    text: this.getOnboardingContent('teachers_section', 'description'),
                    attachTo: {
                        element: ".teachers_section",
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
                    title: this.getOnboardingContent('report_section', 'title'),
                    text: this.getOnboardingContent('report_section', 'description'),
                    attachTo: {
                        element: ".report_section",
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
                    title: this.getOnboardingContent('sms_section', 'title'),
                    text: this.getOnboardingContent('sms_section', 'description'),
                    attachTo: {
                        element: ".sms_section",
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
                    title: this.getOnboardingContent('website_settings_section', 'title'),
                    text: this.getOnboardingContent('website_settings_section', 'description'),
                    attachTo: {
                        element: ".website_settings_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Complete"
                        }
                    ]
                }
            ]
        };
    },
    mounted() {
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
        tourGoback() {
            this.tour.back();
        },
        toggleList(arg) {
            if (arg == "list") {
                if (this.list) {
                    this.list = false;
                } else {
                    this.list = true;
                }
            }
            if (arg == "list2") {
                if (this.list2) {
                    this.list2 = false;
                } else {
                    this.list2 = true;
                }
            }
            if (arg == "list3") {
                if (this.list3) {
                    this.list3 = false;
                } else {
                    this.list3 = true;
                }
            }
        },
    },
};
</script>

<style>
.v-enter-active,
.v-leave-active {
    opacity: 0;
}

.v-enter-from,
.v-leave-to {
    transition: opacity 0.1s ease;
}
</style>
