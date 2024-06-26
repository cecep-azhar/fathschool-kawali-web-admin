<template>
    <AppLayout :title="__(text)">
        <Breadcrumb>
            <BreadcrumbLink :title="text" />
        </Breadcrumb>

        <div class="mx-auto pb-12">
            <div
                class="rounded-lg flex justify-between items-center mb-4 py-4 px-6 text-lg font-semibold rtl:text-right text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <div class="dark:text-gray-400">
                    {{ __(text) }}
                </div>
                <Link preserve-scroll :href="route('sms.template.index')">
                <global-button :loading="false" type="button" theme="primary">
                    {{ __('Message Template') }}
                </global-button>
                </Link>
            </div>
            <div class="rounded-lg">
                <form @submit.prevent="submit">
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <div class="col-span-2">
                                    <global-label for="class" value="Type" />
                                    <Multiselect id="class" class="dark:text-gray-900" v-model="form.type_id"
                                        :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                        :placeholder="__('Select Type')"
                                        :options="types.map(item => ({ value: item.id, label: item.type }))"
                                        autocomplete="off" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-span-2">
                                    <global-label for="class" value="Template" />
                                    <Multiselect id="class" class="dark:text-gray-900" v-model="form.message"
                                        :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                        :placeholder="__('Select A Template')"
                                        :options="templates.map(item => ({ value: item.message, label: item.title }))"
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <div class="col-span-2" v-if="form.type_id == 2">
                                    <global-label for="role" value="Role" />
                                    <Multiselect id="role" class="dark:text-gray-900" v-model="form.role_id"
                                        :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                        :placeholder="__('Select Course')"
                                        :options="roles.map(item => ({ value: item.name, label: item.name }))"
                                        autocomplete="off" />
                                </div>
                                <div class="col-span-2" v-if="form.type_id == 3">
                                    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                                        <div class="col-span-1">
                                            <global-label for="role" value="Role" />
                                            <Multiselect id="role" class="dark:text-gray-900"
                                                v-model="form.individualRole_id" :close-on-select="true" :can-clear="false"
                                                :searchable="true" :create-option="false" :placeholder="__('Select Course')"
                                                :options="roles.map(item => ({ value: item.name, label: item.name }))"
                                                autocomplete="off" />
                                        </div>
                                        <div class="col-span-1">
                                            <global-label for="users" value="Send to" />
                                            <Multiselect id="users" class="dark:text-gray-900" v-model="form.user_id"
                                                :close-on-select="true" :can-clear="false" :searchable="true"
                                                :create-option="false" :placeholder="__('Select User')"
                                                :options="form.individualRole_id === 'Student' ? users.map(item =>
                                                    ({ value: item.user_id, label: item.student_id })) : users.map(item => ({ value: item.id, label: item.name }))"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2" v-if="form.type_id == 4">
                                    <global-label for="Course" value="Course" />
                                    <Multiselect id="Course" class="dark:text-gray-900" v-model="form.course_id"
                                        :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                        :placeholder="__('Select Course')"
                                        :options="courses.map(item => ({ value: item.id, label: item.name }))"
                                        autocomplete="off" />
                                </div>
                            </div>
                            <div class="mb-1">
                                <global-label for="message" value="Message" :required="false" />
                                <textarea rows="4" v-model="form.message" name="" :placeholder="__('Message')"
                                    id="description" maxlength="320"
                                    class="pl-4 bg-gray-50 border rounded-lg border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </textarea>
                                <p class="text-right ">{{ remainingCharacters }} characters remaining</p>
                                <b>Dynamic Tag :</b><button v-for="(value, key) in uniqueKey" :key="key" type="button"
                                    class="bg-transparent border border-gray-700 text-gray-700 dark:border-gray-300 dark:text-gray-300 mx-1 px-2 py-1 rounded-lg"
                                    @click="insertValue(key)">
                                    {{ value }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mt-3" theme="primary">
                        {{ __('Send') }}
                    </global-button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Multiselect from '@vueform/multiselect'
import { useForm } from "@inertiajs/inertia-vue3";


export default {
    props: {
        types: Array,
        templates: Array,
        roles: Array,
        courses: Array,
        filter_data: Object,
        users: Array,
    },
    components: {
        AppLayout,
        Multiselect,
        useForm,
    },
    data() {
        return {
            loading: false,
            text: "Send SMS",
            form: useForm({
                type_id: this.filter_data.type_id ?? "",
                role_id: this.filter_data.role_id ?? "",
                user_id: this.filter_data.user_id ?? "",
                message: this.filter_data.message ?? "",
                course_id: this.filter_data.course_id ?? "",
                individualRole_id: this.filter_data.individualRole_id ?? "",
            }),
            maxLength: 320,
            uniqueKey: {
                name: '{name}',
                email: '{email}',
                phone: '{phone}',
            },
        };
    },
    watch: {
        'form.individualRole_id': function (newVal) {
            if (newVal) {
                this.filterData();
            }
        }
    },
    methods: {
        insertValue(key) {
            this.form.message += this.uniqueKey[key];
        },
        filterData() {
            this.form.get(this.route('sms.index'));
        },
        submit() {
            this.$inertia.post(this.route("sms.send"), this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.reset();
                },
                onFinish: (visit) => {
                    this.loading = false;
                },
            });
        },
        reset() {
            this.form.type_id = "";
            this.form.template_message = "";
            this.form.role_id = "";
            this.form.user_id = "";
            this.form.message = "";
            this.form.course_id = "";
            this.form.individualRole_id = "";
        },
    },
    computed: {
        remainingCharacters() {
            return this.maxLength - this.form.message.length
        }
    }
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>

