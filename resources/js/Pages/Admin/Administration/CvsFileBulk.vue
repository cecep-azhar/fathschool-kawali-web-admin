<template>
    <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
            <div
                class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="mb-3">
                    <global-label
                        for="file"
                        value="Select Your File (.csv, .xlsx, .xls)"
                        :required="true"
                    />
                    <global-input
                        ref="file_input"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                        type="file"
                        @change="picFile($event)"
                        :placeholder="__('Description')"
                        id="name"
                        :error="$page.props.errors.file"
                        class="block w-full text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    />
                    <input-error :error="$page.props.errors.file" />
                    <template v-if="form.file">
                        <progress
                            class="mt-2 rounded-full"
                            v-if="form.progress"
                            :value="form.progress.percentage"
                            max="100"
                        >
                            {{ form.progress.percentage }}%
                        </progress>
                    </template>
                </div>
            </div>

            <div
                class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="mb-3">
                    <div class="mb-3">
                        <global-label
                            for="file"
                            value="Select Your File"
                            :required="true"
                        />
                        <a
                            href="/files/student.xlsx"
                            download
                            class="inline-flex group relative"
                        >
                            <global-button
                                :loading="false"
                                type="button"
                                theme="primary"
                            >
                                <ArrowDownTrayIcon class="w-6 h-6 mr-1" />
                                {{ __("Download Example File") }}
                            </global-button>
                            <tool-tip
                                class="text-md"
                                :text="__('Download example file')"
                            />
                        </a>
                        <button
                            @click="visible = true"
                            type="button"
                            class="bg-purple-500 inline-flex ml-4 hover:bg-purple-400 rounded-full p-1 group relative"
                        >
                            <eye-icon class="w-6 h-6 text-white" />
                            <tool-tip
                                class="text-md"
                                :text="__('View Example Demo')"
                            />
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <global-button
            :loading="form.processing"
            type="submit"
            cssClass="w-full mt-3"
            theme="primary"
        >
            {{ __("Save") }}
        </global-button>
    </form>
    <!-- demo file modal  -->
    <demo-modal maxWidth="w-11/12" :show="visible" @close="closeModal">
        <template #title>
            {{ __("Example File Demo") }}
        </template>

        <template #content>
            <img
                class="h-full w-full rounded-sm"
                src="/images/students_sheet.png"
                alt=""
            />
        </template>

        <template #footer>
            <global-button
                :loading="false"
                type="button"
                @click="closeModal(true)"
                theme="danger"
            >
                {{ __("Close") }}
            </global-button>
        </template>
    </demo-modal>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import DemoModal from "@/Shared/Modal.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import { EyeIcon, ArrowDownTrayIcon } from "@heroicons/vue/24/outline";

export default {
    components: {
        DemoModal,
        ArrowDownTrayIcon,
        ToolTip,
        EyeIcon,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            visible: false,
            form: useForm({
                file: "",
            }),
        };
    },
    methods: {
        downloadFile(arg) {
            axios.get(arg, { responseType: "arraybuffer" }).then((response) => {
                var fileURL = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                var fileLink = document.createElement("a");
                fileLink.href = fileURL;
                fileLink.setAttribute("download", "test.xlsx");
                document.body.appendChild(fileLink);
                fileLink.click();
            });
        },
        picFile(e) {
            this.form.file = e.target.files[0];
        },
        submit() {
            this.form.post(this.route("administration.file.bulk"), {
                preserveScroll: true,
            });
        },
        closeModal(button) {
            this.visible = false;
        },
    },
};
</script>

<style></style>
