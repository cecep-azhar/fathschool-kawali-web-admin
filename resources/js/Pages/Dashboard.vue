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
    <li v-if="can('transaction.create')" class="add_transaction_section">
        <NavLink :href="route('transaction.create')" :active="route().current('transaction.create')">
            <DocumentPlusIcon class="h-6 w-6" />
            {{ __("Add Transaction") }}
        </NavLink>
    </li>
    <li v-if="can('transaction.index')" class="transaction_section">
        <NavLink :href="route('transaction.index')" :active="route().current('transaction.index')">
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
        <NavLink :href="route('plan.index')" class="hover-icons" :active="route().current('plan.*')">
            <CurrencyDollarIcon class="h-6 w-6" />
            {{ __("Admission Plan") }}
            <Link :href="route('plan.create')">
            <PlusCircleIcon class="w-6 h-6 hoverPlus" />
            </Link>
        </NavLink>
    </li>
    <li class="text-xs uppercase mb-2 text-gray-500 pt-6 pl-2">
        {{ __('Others') }}
    </li>
    <li v-if="can('meeting.index')" class="meeting_section">
        <NavLink :href="route('meeting.index')" :active="route().current('meeting.*')">
            <VideoCameraIcon class="h-6 w-6" />
            {{ __("Meeting") }}
        </NavLink>
    </li>
    <li v-if="can('request-leave.index')" class="leave_request_section">
        <NavLink :href="route('manage-leave.index')" :active="route().current('manage-leave.index')">
            <GiftIcon class="w-6 h-6" />
            {{ __("Leave Request") }}
        </NavLink>
    </li>
    <li v-if="can('sms')" class="sms_section">
        <NavLink :href="route('sms.index')" :active="route().current('sms.*')">
            <EnvelopeIcon class="h-6 w-5" />
            {{ __("Send Sms") }}
        </NavLink>
    </li>
    <li v-if="can('report.index')" class="report_section">
        <NavLink :href="route('reports.index')" :active="route().current('reports.*')">
            <FlagIcon class="h-6 w-5" />
            {{ __("Reports") }}
        </NavLink>
    </li>
    <li v-if="can('notice-board.index')" class="notice_board_section">
        <NavLink :href="route('notice-board.index')" :active="route().current('notice-board.index')">
            <BellAlertIcon class="w-6 h-6" />
            {{ __("Notice Board") }}
        </NavLink>
    </li>
        <li v-if="can('courses.qr-codes')" class="corseqr_board_section">
        <NavLink :href="route('courses.qr-codes')" :active="route().current('courses.qr-codes')">
            <BellAlertIcon class="w-6 h-6" />
            {{ __("Course Qr Board") }}
        </NavLink>
    </li>
</template>

<script>
import NavLink from "@/Components/Sidebar/NavLink.vue";
import { Link } from '@inertiajs/inertia-vue3';

import { CurrencyDollarIcon, FlagIcon, PlusCircleIcon, VideoCameraIcon, BanknotesIcon, RectangleStackIcon, WalletIcon, BellAlertIcon, GiftIcon, DocumentPlusIcon, HomeIcon } from "@heroicons/vue/24/outline";
import Shepherd from "shepherd.js";

export default {
    components: {
        PlusCircleIcon,
        Link,
        NavLink,
        FlagIcon,
        VideoCameraIcon,
        RectangleStackIcon,
        WalletIcon,
        GiftIcon,
        BellAlertIcon,
        DocumentPlusIcon,
        BanknotesIcon,
        CurrencyDollarIcon,
        HomeIcon
    },
    data() {
        return {
            tour: null,
            steps: [
                {
                    title: this.getOnboardingContent('welcome', 'title'),
                    text: this.getOnboardingContent('welcome', 'description'),
                    attachTo: {
                        element: "",
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
                    title: this.getOnboardingContent('add_transaction_section', 'title'),
                    text: this.getOnboardingContent('add_transaction_section', 'description'),
                    attachTo: {
                        element: ".add_transaction_section",
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
                    title: this.getOnboardingContent('recurring_invoices_section', 'title'),
                    text: this.getOnboardingContent('recurring_invoices_section', 'description'),
                    attachTo: {
                        element: ".recurring_invoices_section",
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
                    title: this.getOnboardingContent('notice_board_section', 'title'),
                    text: this.getOnboardingContent('notice_board_section', 'description'),
                    attachTo: {
                        element: ".notice_board_section",
                        on: "right"
                    },
                    buttons: [
                        {
                            action: this.tourGoNext,
                            text: "Complete"
                        }
                    ]
                },
                {
                    title: this.getOnboardingContent('courseqr_board_section', 'title'),
                    text: this.getOnboardingContent('courseqr_board_section', 'description'),
                    attachTo: {
                        element: ".courseqr_board_section",
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

        const sidebar = document.querySelector(".sidebar");
        const sidebarOverlay = document.querySelector(".sidebar-overlay");
        if (!this.$page.props.auth.tour_completed) {
            sidebar.classList.add("active");
            sidebarOverlay.classList.add("active");
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
        complete() {
            this.tour.cancel();
        },
    }
}
</script>

<style>
/* .shepherd-element{
        left: 10px !important;
        right: 10px !important;
    } */
.tour:has(.shepherd-element) {
    margin: 20px;
}

[data-popper-arrow]:after {
    visibility: hidden;
}
</style>
