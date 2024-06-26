<template>
    <a-modal width="600px" v-model:visible="visible" :wrap-style="{ overflow: 'auto' }" @ok="handleOk">
        <!-- Content -->
        <div class="w-full  dark:border-gray-700 rounded-lg">
            <div class="mb-3">
                <global-label for="topic" value="Topic" :required="true" />
                <global-input type="text" v-model="form.topic" id="topic" name="topic"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter Topic')" :error="$page.props.errors.topic" />
                <input-error :error="$page.props.errors.topic" />
            </div>
            <div class="mb-3">
                <global-label for="start_date" value="Start Date" :required="true" />
                <a-date-picker v-model:value="start_date" id="start_date"
                    class="w-full custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400" show-time
                    :format="getDateTimeFormat() + ' HH:mm:ss'"
                    :placeholder="__('Select Start Date')" />
                <input-error :error="$page.props.errors.start_date" />
            </div>
            <div class="mb-3">
                <global-label for="password" :value="__('Meeting Password')" :required="true" />
                <global-input type="password" v-model="form.password" id="password" name="password"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter password')" :error="$page.props.errors.password" />
                <input-error :error="$page.props.errors.password" />
            </div>

            <div class="mb-3">
                <global-label for="participants" :value="__('Select Participants Role')" :required="true" />
                <ul
                    class="grid grid-cols-1 md:grid-cols-3 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <label :for="'role' + role.id" v-for="role in roles" :key="role.index"
                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input v-model="form.selected_role" @change="getRole(role.name)" :id="'role' + role.id"
                                type="radio" :value="role.name" name="role"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label :for="'role' + role.id"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ role.name }}
                            </label>
                        </div>
                    </label>
                </ul>
            </div>
            <div class="mb-3">
                <global-label for="participants" :value="__('Participants')" :required="true" />
                <div class="md:flex justify-between items-center gap-2">
                    <div class="md:w-1/2" v-if="!form.all_user">
                        <Multiselect mode="multiple" v-model="form.participants"
                            :close-on-select="false" :searchable="true" :create-option="false"
                            :placeholder="__('Select Participant')" :options="filter_users.map(user => ({
                                value: user.id, label: user.name
                            }))" autocomplete="off" />
                    </div>
                    <div :class="form.all_user ? 'w-full' : 'md:w-1/2'" class="mt-2 md:mt-0 border rounded">
                        <label for="all_user" class="flex items-center ml-4">
                            <input v-model="form.all_user" id="all_user" type="checkbox" value="all_user"
                                :class="form.all_user ? 'ml-3' : ''"
                                class="rounded-full text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="all_user"
                                class="ml-3 flex items-center h-10 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ __('All Users This Role') }}
                            </label>
                        </label>
                    </div>
                </div>
                <input-error :error="$page.props.errors.participants" />
            </div>
            <div>
                <global-label for="description" :value="__('Meeting Description')" :required="false" />
                <global-textarea v-model="form.description" id="description" name="description"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter Description')" :error="$page.props.errors.description" />
                <input-error :error="$page.props.errors.description" />
            </div>
        </div>
        <!-- COntent ENd-->
        <template #title>
            <div class="width-100">
                {{ __('Add Meeting') }}
            </div>
        </template>
        <template #footer>
            <global-button :loading="form.processing" type="button" @click="submit()"
                class="text-white w-full bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 mr-2 mb-2 dark:focus:ring-blue-300">
                {{ __('Save') }}
            </global-button>
        </template>
    </a-modal>
</template>

<script>
import dayjs, { Dayjs } from 'dayjs';
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import ToolTip from '@/Shared/ToolTip.vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Multiselect,
        ToolTip,
    },
    props: {
        users: Object,
        meeting: Object,
        roles: Object,
        errors: Object
    },
    data() {
        return {
            filter_users: [],
            customDateFormat: 'DD-MM-YYYY',
            timeFormat: 'h:m A',
            visible: false,
            start_date: null,
            form: useForm({
                topic: '',
                start_date: '',
                password: '',
                selected_role: 'Student',
                participants: [],
                description: '',
                all_user: false,
                _method: this.meeting ? 'PUT' : 'POST',
            }),
        };
    },
    watch: {
        meeting: {
            deep: true,
            handler(val, oldVal) {
                this.form.topic = val.topic;
                this.start_date = dayjs(val.start_time);
                this.form.start_date = dayjs(val.start_time);
                this.form.description = val.description;
                this.form.password = val.password;
                this.form._method = this.meeting ? 'PUT' : 'POST';
                // participants
                let role = '';
                val.participants.forEach(participant => {
                    this.form.participants.push(participant.user_id);
                    role = participant.user.role ?? null;
                });
                this.form.selected_role = role;
                this.getRole(role);
            },
        }
    },
    mounted() {
        this.getRole(this.form.selected_role);
    },
    methods: {
        showModal() {
            this.visible = true;
        },
        handleOk(e) {
            this.visible = false;
        },
        getRole(arg) {
            let users = [];
            this.users.forEach(user => {
                if (user.role == arg) {
                    users.push(user);
                }
            });
            this.filter_users = users;
        },
        submit() {
            if (this.start_date) {
                this.form.start_date = dayjs(this.start_date).format('YYYY-MM-DDTHH:mm:ssZZ');
            } else {
                this.form.start_date = '';
            }

            if (this.meeting) {
                this.form.post(this.route("meeting.update", this.meeting.id), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.visible = false;
                        this.form._method = "POST";
                        this.form.reset('topic',
                            'start_date',
                            'start_date',
                            'description',
                            'password');
                    },
                });
            } else {
                this.form.post(this.route("meeting.store"), {
                    onSuccess: (page) => {
                        this.visible = false;
                        this.form.reset('topic',
                            'start_date',
                            'start_date',
                            'description',
                            'password');
                    }
                });
            }
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

.h-scroll {
    overflow: auto;
}
</style>
