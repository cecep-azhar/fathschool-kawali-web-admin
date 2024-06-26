<template>
    <AppLayout :title="__('Exam & Results')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Exam & Results')" />
        </Breadcrumb>

        <div>
            <page-header>
                {{ __('Exam & Results') }}
                <template #content>
                    <global-button :loading="false" type="button" @click="showModal()" theme="primary">
                        {{ __('Publish New Result') }}
                    </global-button>
                </template>
            </page-header>

            <ol v-if="results && results.length">
                <li class="p-2 bg-white dark:bg-gray-800 mt-2" v-for="result in results" :key="result.id">
                    <div class="mt-2 ml-4 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                       <div>
                            <p class="text-sm text-neutral-500">
                                {{ formatTime(result?.exam?.start_date) ?? '' }} - {{ formatTime(result?.exam?.end_date) ?? '' }}
                            </p>
                            <h4 class="mb-1.5 text-xl font-semibold">
                                {{ result?.exam?.name ?? '' }}
                            </h4>
                       </div>

                        <div class="flex gap-2 items-center">
                            <!-- <global-button @click="editData(result)" type="button" class="text-white bg-blue-500 dark:bg-blue-500 hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600  0">
                                {{ __('Edit') }}
                            </global-button> -->
                           <a :href="result.attachment_url" download>
                                <global-button type="submit" class="text-white bg-gray-500 dark:bg-gray-500 hover:bg-gray-500">
                                    {{ __('Download Sheets') }}
                                </global-button>
                            </a>

                        </div>
                    </div>
                </li>
            </ol>
            <template v-else>
                <NothingFound asShow="div" />
            </template>
        </div>


        <!-- Modal For Create N Update -->
        <a-modal v-model:visible="visible" width="600px" :title="update ? __('Edit Exam Result') : __('Publish Exam Result')"
        @ok="handleOk">
            <template #footer>
                <div class="flex gap-2">
                    <global-button :loading="form.processing" type="button" @click="submit" theme="primary">
                        {{ __('Save') }}
                    </global-button>
                    <global-button :loading="false" type="button" @click="handleOk" theme="outline-danger">
                        {{ __('Cancel') }}
                    </global-button>
                </div>
            </template>

            <form class="dark:bg-gray-800 rounded-lg">
                <div class="mb-3">
                    <global-label for="class" value="Select Exam" :required="true" />
                    <Multiselect id="exam" :close-on-select="true" :can-clear="false"
                    :searchable="true" v-model="form.exam" :create-option="false"
                    :placeholder="__('Exam')" :options="exams.map(item => ({
                        value: item.id, label: item.name
                    }))" autocomplete="off" />
                    <input-error :error="$page.props.errors.exam" />
                </div>
                <div>
                    <global-label for="name" value="Attachment" :required="update ? false:true" />
                    <global-input accept=".xlsx" type="file" id="name" name="name"
                        class="mt-1 block w-full dark:bg-gray-700" @change="onFileChange" />
                    <input-error :error="$page.props.errors.attachment" />
                    <div class="flex justify-between font-bold text-xs ml-1 dark:text-gray-400 mt-0.5">
                       <span>{{ __('Supported extension') }} .xlsx</span>
                        <a href="/files/result.xlsx" download>{{ __('Download Example File') }}</a>
                    </div>
                </div>
            </form>
        </a-modal>

    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { EnvelopeIcon } from '@heroicons/vue/24/outline';
import NothingFound from "@/Shared/NothingFound.vue";
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';

export default {
    components: {
        AppLayout,
        EnvelopeIcon,
        NothingFound,
        Multiselect,
    },
    props: {
        results: {
            type: Array,
            required: true
        },
        exams: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            visible: false,
            loading: false,
            update: false,
            form: this.$inertia.form({
                exam: '',
                attachment: '',
                id: ''
            })
        }
    },
    methods: {
        showModal() {
            this.visible = true;
        },
        handleOk() {
            this.visible = false;
            this.update = false;
            this.form.id = '';
            this.form.exam = '';
            this.form.attachment = '';
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.form.attachment = file;
        },
        editData(result) {
            this.update = true;
            this.form.id = result.id;
            this.form.exam = result.exam_id;
            this.visible = true;
        },
        submit() {
            if (this.update) {
                this.form.post(this.route("result.update", this.form.id), {
                    onSuccess: (page) => {
                        this.form.exam = '';
                        this.form.attachment = '';
                        this.form.id = '';
                        this.form.reset();
                        this.visible = false;
                    },
                });
            }else{
                this.form.post(this.route("result.store"), {
                    onSuccess: (page) => {
                        this.form.exam = '';
                        this.form.attachment = '';
                        this.form.id = '';
                        this.form.reset();
                        this.visible = false;
                    },
                });
            }
        }
    }
};
</script>
