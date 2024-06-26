<template>
    <a-modal width="500px" v-model:visible="visible" :wrap-style="{ overflow: 'auto' }" @ok="handleOk">
        <!-- Content -->
        <div class="w-full rounded-lg">
            <div class="mb-3">
                <global-label for="topic" value="Topic" :required="true" />
                <global-input type="text" v-model="form.topic" id="topic" name="topic"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter Topic')" :error="$page.props.errors.topic" />
                <input-error :error="$page.props.errors.topic" />
            </div>
            <div class="mb-3">
                <global-label for="start_date" value="Start Date" :required="true" />
                <a-date-picker v-model:value="start_date_value" id="start_date"
                    class="w-full custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400" show-time
                    :format="getDateTimeFormat() + ' HH:mm:ss'" :placeholder="__('Select Start Date')" />
                <input-error :error="$page.props.errors.start_date" />
            </div>
            <div class="mb-3">
                <global-label for="title" :value="__('Select Subject')" :required="true" />
                <a-select :class="$page.props.errors.subject ? 'border-custom ' : ''" class="width-100" size="large"
                    v-model:value="form.subject" show-search :placeholder="__('Select a subject')" :options="subjects.map((item) => ({
                        value: item.id,
                        label: item.name,
                    }))
                        " :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                </a-select>
                <input-error :error="$page.props.errors.subject" />
            </div>
            <div class="mb-3">
                <global-label for="duration" :value="__('Duration')" :required="false" />
                <global-input type="number" v-model="form.duration" id="duration" name="duration"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter Duration In Minutes ')" :error="$page.props.errors.duration" />
                <input-error :error="$page.props.errors.duration" />
            </div>
            <div class="mb-3">
                <global-label for="password" value="Class Password" :required="true" />
                <global-input type="text" v-model="form.password" id="password" name="password"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter password')" :error="$page.props.errors.password" />
                <input-error :error="$page.props.errors.password" />
            </div>
            <div class="mb-3 w-full">
                <global-label for="status_waiting" value="Status" :required="true" />
                <div class="flex justify-between items-center gap-2 w-full">
                    <div class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                        <input v-model="form.status" id="status_waiting" type="radio" value="waiting" name="status"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="status_waiting"
                            class="w-full py-2 ml-2 mr-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('Waiting') }}
                        </label>
                    </div>
                    <div class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                        <input v-model="form.status" id="status_upcoming" type="radio" value="upcoming" name="status"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="status_upcoming"
                            class="w-full py-2 ml-2 mr-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('Upcoming') }}
                        </label>
                    </div>
                    <div class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                        <input v-model="form.status" id="status_completed" type="radio" value="completed" name="status"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="status_completed"
                            class="w-full py-2 ml-2 mr-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('Completed') }}
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <global-label for="description" value="Class Description" :required="false" />
                <global-textarea v-model="form.description" id="description" name="description"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 h-20"
                    :placeholder="__('Enter Description')" :error="$page.props.errors.description" />
                <input-error :error="$page.props.errors.description" />
            </div>
        </div>
        <!-- COntent ENd-->
        <template #title>
            <div class="width-100">{{ __('Add Class') }}</div>
        </template>
        <template #footer>
            <global-button :loading="form.processing" type="button" @click="submit()" theme="primary">
                {{ edit_item ? __('Update Class') : __('Create a New Class') }}
            </global-button>
        </template>
    </a-modal>
</template>

<script>
import dayjs, { Dayjs } from "dayjs";
import { useForm } from "@inertiajs/inertia-vue3";
import { TimePicker } from "ant-design-vue";

export default {
    components: {
        "a-time-picker": TimePicker,
    },
    props: {
        course: Object,
        edit_item: Object,
        errors: Object,
        subjects: Object,
    },
    data() {
        return {
            visible: false,
            start_date_value: null,
            form: useForm({
                topic: "",
                start_date: "",
                duration: "",
                password: "",
                description: "",
                _method: this.meeting ? "PUT" : "POST",
                course: this.course.id,
                status: '',
                subject: null,
            }),
        };
    },
    watch: {
        edit_item: {
            deep: true,
            handler(val, oldVal) {
                this.form.topic = val.topic;
                this.form.start_date = val.start_time;
                this.form.duration = val.duration;
                this.form.password = val.password;
                this.form.description = val.description;
                this.form.course = val.course_id;
                this.form.subject = val.subject_id;
                this.form.status = val.status;
                this.form._method = this.edit_item ? "PUT" : "POST";

                this.start_date_value = dayjs(val.start_time);
            },
        },
    },
    methods: {
        showModal() {
            this.visible = true;
        },
        handleOk(e) {
            this.visible = false;
        },
        submit() {
            if (this.start_date_value) {
                this.form.start_date = dayjs(this.start_date_value).format(
                    "YYYY-MM-DDTHH:mm:ssZZ"
                );
            } else {
                this.form.start_date = "";
            }

            if (this.edit_item) {
                this.form.post(
                    this.route(
                        "online.class.update",
                        this.edit_item.id
                    ),
                    {
                        preserveScroll: true,
                        onSuccess: (page) => {
                            this.form.reset();
                            this.visible = false;
                        },
                    }
                );
            } else {
                this.form.post(this.route("online.class.store"), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.form.reset();
                        this.visible = false;
                    },
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
