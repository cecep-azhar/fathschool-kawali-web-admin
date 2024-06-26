<template>
    <Head :title="__('Leave Request')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Leave Request')" />
        </Breadcrumb>

        <div>
            <!-- over view -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6 mb-4 mt-6">
                <stat-card :title="__('Total Leave Apply')" :value="total_submit" :label="__('Days')" />
                <stat-card :title="__('Total Pending Leave')" :value="total_pending" :label="__('Days')" />
                <stat-card :title="__('Total Approved Leave')" :value="total_approved" :label="__('Days')" />
                <stat-card :title="__('Total Rejected Leave')" :value="total_rejected" :label="__('Days')" />
            </div>
            <!-- over view end -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
                <div class="lg:col-span-2 overflow-x-auto rounded-lg"
                    :class="newLeaveRequest ? 'xl:col-span-2' : 'xl:col-span-3'">
                    <page-header>
                        <div class="dark:text-gray-400 flex items-center">
                            <span>{{ __('Leaves') }}</span>
                            <span class="bg-blue-500 text-white rounded ml-2 rtl:ml-0 rtl:mr-2 px-1 text-xs py-0.5">
                                {{ leaves.total }}
                            </span>
                        </div>
                        <template #content>
                            <global-button @click="newLeaveRequest = !newLeaveRequest" type="button" css theme="primary">
                                {{ __('New Leave Request') }}
                            </global-button>
                        </template>
                    </page-header>
                    <!-- Leave Listing -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        <template v-if="leaves.data.length > 0">
                            <div class="p-6 mb-6 bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700"
                                v-for="leave in leaves.data" :key="leave.id">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        <div>
                                            <img class="w-12 h-12 rounded-full" :src="leave.user.profile_photo_url"
                                                :alt="leave.user.name" />
                                        </div>
                                        <div>
                                            <div class="text-lg font-bold dark:text-gray-400">
                                                {{ leave.user.name }}
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                {{ leave.user.role }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="py-2 dark:opacity-70 px-5 text-sm font-medium text-blue-500 focus:outline-none bg-blue-100 rounded-lg border border-gray-200">
                                            {{ leave.days }}
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-3 mt-3 font-normal text-gray-500 dark:text-gray-400">
                                    {{ leave.description }}
                                </p>
                                <div class="text-md text-gray-700 dark:text-gray-400 mb-2">
                                    {{ formatTime(leave.start, '') }} - {{ formatTime(leave.start, '') }}
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span
                                            class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 rtl:mr-0 rtl:ml-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 capitalize">
                                            {{ leave.type ? leave.type.name : '' }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="capitalize" :class="leave.status == 'accepted' ? 'text-green-500' : '' ||
                                            leave.status == 'pending' ? 'text-purple-500' : '' ||
                                                leave.status == 'rejected' ? 'text-red-500' : ''">
                                            {{ leave.status }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="col-span-1 md:col-span-6 text-center text-gray-400">
                                {{ __('No Leave Request') }}
                            </div>
                        </template>
                    </div>
                    <div class="flex justify-center">
                        <pagination class="mt-6" :links="leaves.links" />
                    </div>
                </div>
                <div v-if="newLeaveRequest" class="w-full p-6 bg-white dark:bg-gray-800 dark:border-gray-700 rounded-lg">
                    <div class="mb-3 text-lg font-bold dark:text-gray-400">
                        {{ __('Request for leave') }}
                    </div>
                    <div v-if="$page.props.auth.role == 'Accountant' || $page.props.auth.role == 'Teacher'" class="mb-3">
                        <div class="rounded-lg bg-gray-50 dark:bg-gray-700">
                            <nav class="flex items-center text-center gap-2">
                                <label v-for="type_item in leave_types" :key="type_item.id"
                                    @click="selectType(type_item.id)" :for="type_item.slug"
                                    :class="tab == type_item.id ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-400'"
                                    class="cursor-pointer whitespace-nowrap text-md rounded-md py-2 px-6 font-bold">
                                    {{ type_item.name }}
                                    <input :value="type_item.id" type="checkbox" :id="type_item.slug"
                                        class="sr-only hidden">
                                </label>
                            </nav>
                        </div>
                        <input-error :error="$page.props.errors.leave_type_id" />
                    </div>
                    <div class="mb-3">
                        <global-label for="end_date" :value="__('Leave Duration')" :required="true" />
                        <a-range-picker :show-time="{ format: 'HH:mm' }" :placeholder="['Start Time', 'End Time']"
                            :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                            class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                            :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="form.date"
                            :format="customDateFormat" />
                        <input-error :error="$page.props.errors.date" />
                    </div>
                    <div v-if="$page.props.auth.role == 'Student'" class="mb-3">
                        <global-label for="type" :value="__('Type')" :required="true" />
                        <Multiselect id="type" :close-on-select="true" :can-clear="true" :searchable="false"
                            v-model="form.status" :create-option="false" :placeholder="__('Select Type')" :options="leave_types.map(item => ({
                                value: item.id, label: item.name
                            }))" autocomplete="off" />
                        <input-error :error="$page.props.errors.leave_type_id" />
                    </div>
                    <div class="mb-1">
                        <global-label for="description" :value="__('Description')" :required="true" />
                        <global-textarea :placeholder="__('Description')" id="name" :error="$page.props.errors.description"
                            v-model="form.description"
                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" />
                        <input-error :error="$page.props.errors.description" />
                    </div>
                    <div class="mt-6 flex gap-4">
                        <global-button :loading="loading" @click="submit()" type="button" cssClass="mt-2" theme="primary">
                            {{ __('Save') }}
                        </global-button>
                        <global-button :loading="false" type="button" @click="newLeaveRequest = false" cssClass="mt-2"
                            theme="danger">
                            {{ __('Cancel') }}
                        </global-button>
                    </div>
                </div>
            </div>
            <!-- calendar -->
            <div class="mt-4 overflow-x-auto rounded-md bg-white dark:bg-gray-800">
                <full-calendar :data="leaves.data" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import dayjs, { Dayjs } from 'dayjs';
import FullCalendar from '@/Shared/Components/FullCalendar.vue';
import StatCard from '@/Components/Dashboard/StatCard.vue'
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';

export default {
    props: {
        leaves: Object,
        leave_types: Array,
        total_submit: String,
        total_approved: String,
        total_rejected: String,
        total_pending: String
    },
    data() {
        return {
            customDateFormat: 'DD-MM-YYYY HH:mm',
            loading: false,
            form: {
                date: '',
                date2: '',
                description: "",
                leave_type_id: this.leave_types[0] ? this.leave_types[0].id : '',
            },
            filter: {
                keyword: "",
                status: "",
            },
            leave: "",
            tab: this.leave_types[0] ? this.leave_types[0].id : '',
            newLeaveRequest: false
        };
    },
    components: {
        AppLayout,
        FullCalendar,
        Pagination,
        StatCard,
        Multiselect
    },
    methods: {
        selectType(arg) {
            this.tab = arg;
            this.form.leave_type_id = arg;
        },
        disabledDate(current) {
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Set the time to midnight

            return current && current.valueOf() < today.valueOf();
        },
        submit() {
            this.loading = true;
            let start = dayjs(this.form.date[0]);
            let end = dayjs(this.form.date[1]);

            this.form.date2 = [
                start,
                end
            ];

            this.$inertia.post(this.route("leave.store"), this.form, {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.form.date = null;
                    this.form.description = "";
                },
                onFinish: visit => { this.loading = false },
            });
        },
    },
};
</script>


<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>

