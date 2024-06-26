<template>
    <div
        class="bg-white mb-5 dark:bg-gray-800 dark:text-gray-400 rounded-lg px-6 py-4 font-semibold text-base col-span-3">
        {{ __('Subject Assignment') }}
    </div>
    <template v-if="assignments.data.length > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg dark:text-gray-400" v-for="assignment in assignments.data"
                :key="assignment.id">
                <single-assignment :submitAssignmentFunctionParent="submitAssignment" :assignment="assignment" />
            </div>
        </div>
        <div class="flex justify-center col-span-3">
            <pagination class="mt-6" :links="assignments.links" />
        </div>
    </template>
    <template v-else>
        <NothingFound asShow="div" cssClass="text-center mt-3 dark:text-gray-400" />
    </template>
    <!-- assignment submit modal  -->
    <file-upload-modal :show="visible" @close="visible = false">
        <template #title>
            {{ __('Submit Your Assignment') }}
        </template>

        <template #content>
            <!-- Content -->
            <global-label for="file" value="Select Your File" :required="true" />
            <global-input ref="file_input" type="file" @change="picFile($event)" :placeholder="__('Description')"
                id="name" :error="$page.props.errors.file"
                class="block w-full text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
            <span class="text-gray-500">{{ __('Supported format') }} - png, jpg, jpeg, pdf, zip, doc, docx</span>
            <input-error :error="$page.props.errors.file" />
            <div v-if="form.file">
                <progress class="mt-2 w-full rounded-full" v-if="form.progress" :value="form.progress.percentage"
                    max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div>

            <global-label for="file" value="Description" class="mt-5" />
            <global-textarea :placeholder="__('Description')" id="name" :error="$page.props.errors.description"
                v-model="form.description"
                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" rows="6" />
        </template>

        <template #footer>
            <global-button :loading="false" type="button" @click="closeModal(true)" class="mr-2" theme="outline-danger">
                {{ __('Cancel') }}
            </global-button>
            <global-button :loading="form.processing" type="button" @click="upload()">
                {{ __('Save') }}
            </global-button>
        </template>
    </file-upload-modal>
</template>

<script>
    import SingleAssignment from './../../../Pages/Student/SingleAssignment.vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import { Progress, Tooltip } from "ant-design-vue";
    import FileUploadModal from '@/Shared/Modal.vue';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        props: {
            assignments: Object,
        },
        components: {
            SingleAssignment,
            Pagination,
            FileUploadModal,
            NothingFound
        },
        data() {
            return {
                visible: false,
                form: useForm({
                    assignment: '',
                    file: '',
                    description: '',
                }),
            }
        },
        methods: {
            submitAssignment(arg) {
                this.form.assignment = arg;
                this.visible = true;
            },
            picFile(e) {
                this.form.file = e.target.files[0]
            },
            closeModal(button) {
                if (this.form.progress) {
                    if (button && button != undefined) {
                        this.form.reset('file');
                        this.$refs.file_input.value = '';
                        this.visible = false;
                    }
                } else {
                    this.form.reset('file')
                    this.$refs.file_input.value = '';
                    this.visible = false;
                }
            },
            upload() {
                this.form.post(this.route('assignment.submit'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal();
                    },

                });
            },
        }
    };
</script>
<style scoped>
</style>
