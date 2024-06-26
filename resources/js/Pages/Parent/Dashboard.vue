<template>
    <ParentLayout :title="__('Dashboard')">
        <div class="container mx-auto">
            <Breadcrumb>
                <BreadcrumbLink :title=" __('Dashboard')" />
            </Breadcrumb>
        </div>

        <div class="container mx-auto pb-12">
            <page-header>
                {{ __('Dashboard') }}
            </page-header>
            <div class="">
                <div id="childrens">
                    <div class="py-3 font-bold text-lg dark:text-gray-400 your_children_section">
                        {{ __('Your Children') }} ({{ all_childrens.length }})
                    </div>
                    <div class="flex gap-6 overflow-x-auto">
                        <template v-for="child in all_childrens" :key="child.id">
                            <single-child-card @click="visitChild(child.profile.roll_no)" :child="child" />
                        </template>
                    </div>
                </div>
                <div class="py-3 mt-2 font-bold text-lg dark:text-gray-400 unpaid_invoice_section">
                    {{ __('Pending Fees') }} ({{ unpaid_invoices.total }})
                </div>
                <div class="mt-1">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div class="dark:text-gray-400 dark:bg-gray-800 rounded-lg">
                            <transaction :transactions="unpaid_invoices" />
                            <div class="flex justify-center">
                                <pagination class="mt-6" :links="unpaid_invoices.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </ParentLayout>
</template>

<script>
import ParentLayout from '@/Layouts/ParentLayout.vue';
import LineChartOne from '@/Components/Chart/LineChartOne.vue';
import SingleChildCard from './SingleChildCard.vue';
import StatCard from '@/Components/Dashboard/StatCard.vue'
import TdUserShow from "@/Shared/TdUserShow.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import { EyeIcon } from '@heroicons/vue/24/outline'
import Transaction from './Transaction.vue';
import NothingFound from "@/Shared/NothingFound.vue";
import Shepherd from "shepherd.js";

export default {
    props: {
        all_childrens: Object,
        unpaid_invoices: Array
    },
    data() {
        return {
            activeTab: 'day',
            tour: null,
            steps: [
                {
                    title: this.getOnboardingContent('your_children_section', 'title'),
                    text: this.getOnboardingContent('your_children_section', 'description'),
                    attachTo: {
                        element: ".your_children_section",
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
                    title: this.getOnboardingContent('unpaid_invoice_section', 'title'),
                    text: this.getOnboardingContent('unpaid_invoice_section', 'description'),
                    attachTo: {
                        element: ".unpaid_invoice_section",
                        on: "bottom"
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
    components: {
        ParentLayout,
        LineChartOne,
        SingleChildCard,
        Pagination,
        StatCard,
        EyeIcon,
        TdUserShow,
        Transaction,
        NothingFound
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
                this.$inertia.post(this.route('tour.completed'), {}, {
                    preserveScroll: true
                });
            }
        },
        tourGoback() {
            this.tour.back();
        },
        clickTab(e) {
            this.activeTab = e;
        },
        visitChild(arg) {
            localStorage.setItem('selected_child', arg);
            this.$inertia.get(this.route('kid.dashboard', arg));
        }
    }
}
</script>
