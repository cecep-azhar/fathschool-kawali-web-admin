<template>
    <AppLayout :title="__('Create Attendance')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('attendance.create')" title="Attendance List" />
            <BreadcrumbLink title="Create Attendance" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Create a New Attendance Record') }}
                <template #content>
                    <Link preserve-scroll :href="route('attendance.create')">
                        <global-button :loading="false" type="button" theme="primary">
                            {{ __('Back To List') }}
                        </global-button>
                    </Link>
                </template>
            </page-header>
            <div class="rounded-lg">
                <form class="mt-2" @submit.prevent="submit()">
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <!-- Select Role -->
                            <div class="mb-3">
                                <global-label for="role" value="Select Role" :required="true" />
                                <Multiselect id="role" class="dark:text-gray-900" v-model="form.role"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    placeholder="Select a role"
                                    :options="roles"
                                    autocomplete="off" @change="fetchUsersByRole" />
                                <input-error :error="$page.props.errors.role" />
                            </div>
                            <!-- Select User -->
                            <div class="mb-3">
                                <global-label for="user" value="Select User" :required="true" />
                                <Multiselect id="user" class="dark:text-gray-900" v-model="form.user"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    placeholder="Select a user"
                                    :options="filteredUsers.map(item => ({ value: item.id, label: item.name }))"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.user" />
                            </div>
                            <!-- Select Date -->
                            <div class="mb-3">
                                <global-label for="date" value="Date" :required="true" />
                                <input id="date" type="date" v-model="form.date"
                                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.date" />
                            </div>
                            <!-- Time In -->
                            <div class="mb-3">
                                <global-label for="time_in" value="Time In" :required="true" />
                                <input id="time_in" type="time" v-model="form.time_in"
                                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.time_in" />
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <!-- LatLon In -->
                            <div class="mb-3">
                                <global-label for="latlon_in" value="Latitude, Longitude In" :required="true" />
                                <input id="latlon_in" type="text" v-model="form.latlon_in"
                                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                    placeholder="e.g. 12.3456, 98.7654" autocomplete="off" />
                                <input-error :error="$page.props.errors.latlon_in" />
                            </div>
                            <!-- LatLon Out -->
                            <div class="mb-3">
                                <global-label for="latlon_out" value="Latitude, Longitude Out" />
                                <input id="latlon_out" type="text" v-model="form.latlon_out"
                                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                    placeholder="e.g. 12.3456, 98.7654" autocomplete="off" />
                                <input-error :error="$page.props.errors.latlon_out" />
                            </div>
                            <!-- Time Out -->
                            <div class="mb-3">
                                <global-label for="time_out" value="Time Out" />
                                <input id="time_out" type="time" v-model="form.time_out"
                                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.time_out" />
                            </div>
                        </div>
                    </div>
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mt-3" theme="primary">
                        {{ __('Save') }}
                    </global-button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import axios from "axios";

export default {
    components: {
        AppLayout,
        Multiselect,
    },
    props: {
        users: Array,
        errors: Object,
    },
    data() {
        return {
            roles: [
                { value: 'Teacher', label: 'Teacher' },
                { value: 'Student', label: 'Student' },
                { value: 'Accountant', label: 'Accountant' },
            ],
            filteredUsers: [],
            form: useForm({
                role: null,
                user: null,
                date: null,
                time_in: null,
                time_out: null,
                latlon_in: '',
                latlon_out: '',
            }),
        };
    },
    methods: {
        async fetchUsersByRole() {
            if (!this.form.role) {
                this.filteredUsers = [];
                return;
            }

            try {
                const response = await axios.get(route('users.byRole', { role: this.form.role }));
                this.filteredUsers = response.data;
            } catch (error) {
                console.error('Error fetching users by role:', error);
            }
        },
        submit() {
            this.form.post(route('attendance.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset('role', 'user', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out');
                },
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
