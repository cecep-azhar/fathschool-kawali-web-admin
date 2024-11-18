<template>
    <Head :title="__('Course List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Course')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Course Management') }}
                <template #content>
                    <global-button type="button" theme="primary" @click="createModalvisible = true">
                        {{ __('Add Course') }}
                    </global-button>
                </template>
            </page-header>
            <template v-if="courses && courses.length">
                <div
                    class="grid gap-4 xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 col-span-3 auto-rows-min">
                    <div class="card bg-white dark:bg-gray-800 rounded-lg" v-for="course in courses" :key="course.id">
                        <div class="flex justify-between px-6 pt-6 pb-2.5 items-center">
                            <h2 class="text-[#000] m-0 font-bold text-lg dark:text-gray-400">
                                {{ course.name }}
                            </h2>
                            <div class="flex gap-2">
                                <div>
                                    <button @click="showModal(course)" :id="'testEditCourse' + course.id">
                                        <PencilSquareIcon class="w-6 h-6 text-blue-400" />
                                    </button>
                                </div>
                                <form @submit.prevent="destroyData(course.id)" :id="'testDeleteCourse' + course.id">
                                    <button type="submit">
                                        <trash-icon class="w-6 h-6 text-red-400" />
                                    </button>
                                </form>

                            </div>
                        </div>
                        <div class="px-6 pt-4 pb-6 border-t-2 dark:border-gray-600">
                            <div class="mb-2 text-[#000] font-medium dark:text-gray-400">
                                <h2 class="mb-1 text-[#000] font-bold dark:text-gray-400">
                                    {{ __('Subjects') }}:
                                </h2>
                                <div class="flex flex-wrap gap-1">
                                    <span v-for="(subject, i) in course.subjects" :key="i"
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 mr-1">
                                        {{ subject.name }}
                                    </span>
                                </div>
                            </div>
                            <div class="my-2 flex gap-2 items-center">
                                <h2 class="m-0 text-gray-900 font-bold dark:text-gray-400">
                                    {{ __('Plan') }}:
                                </h2>
                                <template v-if="course.plans">
                                    <p v-for="(plan, index) in course.plans" :key="index"
                                        class="m-0 text-gray-700 dark:text-gray-400">
                                        {{ plan ? plan.title : "" }}
                                        <template v-if="index != course.plans.length - 1">,</template>
                                    </p>
                                </template>
                            </div>
                            <div class="flex gap-3 items-center">
                                <div class="flex ml-3 items-center">
                                    <img v-for="item in course.students" :key="item.id"
                                        class="w-10 h-10 object-fill rounded-full"
                                        :class="i == 0 ? '' : '-ml-3 z-[' + i + 1 + '0]'" :src="item.user.profile_photo_url"
                                        :alt="item.name" />
                                    <div
                                        class="w-10 h-10 bg-white rounded-full mb-0 text-xs leading-5 text-gray-900 dark:text-gray-400 border -ml-3 border-gray-100 flex justify-center items-center">
                                        +{{ course.students_count }}
                                    </div>
                                </div>
                                <div>
                                    <!-- <h4 class="mb-0 text-sm text-gray-700 dark:text-gray-500">{{ __('Students') }}</h4> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <NothingFound asShow="div" />
            </template>
        </div>
        <!-- Create Modal -->
        <template>
            <div>
                <a-modal v-model:visible="createModalvisible" :title="__('Create A New Course')"
                    @ok="createModalvisible = false" footer="" width="800px">
                    <form @submit.prevent="storeData()">
                        <div class="mb-2">
                            <global-label for="name" value="Name" :required="false" />
                            <global-input type="text" id="name" v-model="form.name"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Name')" :error="$page.props.errors.name" />
                            <input-error :error="$page.props.errors.name" />
                        </div>
                        <div class="mb-2">
                            <global-label for="study_program_id" value="Select Study Program" :required="false" />
                            <a-select :class="$page.props.errors.study_program_id ? 'border-custom ' : ''" size="large" class="width-100"
                                v-model="form.study_program_id" show-search :placeholder="__('Select Study Program')" :options="options"
                                :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                            </a-select>
                            <input-error :error="$page.props.errors.study_program_id" />
                        </div>
                        <div class="mb-2">
                            <global-label for="qr_code_id" value="Unique Id" :required="false" />
                            <global-input type="text" id="qr_code_id" v-model="form.qr_code_id"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('QR Code ID')" :error="$page.props.errors.qr_code_id" />
                            <input-error :error="$page.props.errors.qr_code_id" />
                        </div>
                        <div class="mb-2">
                        <global-label for="file" class="tetx-lg" :value="__('Image')" :required="true" />
                        <button type="button" @click="picFile" class="bg-gray-100 dark:bg-gray-700 w-full py-2.5 px-3 rounded testImage">
                            <div class="flex gap-2 items-center">
                                <div>
                                    <ArrowUpTrayIcon class="w-6 h-6 dark:text-gray-400" />
                                </div>
                                <div>
                                    <span v-if="file_name" class="text-blue-500">
                                        {{ file_name }}
                                    </span>
                                    <span v-else class="dark:text-gray-500">
                                        {{ __('Upload Image') }}
                                    </span>
                                </div>
                            </div>
                        </button>
                        <span class="text-gray-500">
                            {{ __('Supported format - png, jpg, jpeg') }}
                        </span>
                        <input @change="change"
                            accept="image/*"
                            type="file" ref="assignment_file" class="hidden" readonly>
                        <input-error :error="$page.props.errors.file" />
                    </div>
                        <div class="mb-2">
                            <div class="relative flex items-start">
                                <div class="flex h-5 items-center">
                                    <input id="multiple_subjects" type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                        @change="checkboxChange('create')" v-model="form.has_multiple_subject" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="multiple_subjects" class="font-medium text-gray-700">
                                        {{ __('Has Multiple Subject') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2" v-if="form.has_multiple_subject">
                            <div class="flex gap-2 justify-between items-center">
                                <div class="flex gap-2">
                                    <div class="mb-1">
                                        <global-input type="text" id="name" v-model="subject_name"
                                            class="mt-1 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 w-full"
                                            placeholder="Subject Name" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="flex items-center">
                                            <global-input type="text" id="name" v-model="subject_color"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Color')" :error="$page.props.errors.subject_color" />

                                            <div class="relative ml-3">
                                                <button type="button" @click="
                                                    isOpenColorPicker =
                                                    !isOpenColorPicker
                                                    "
                                                    class="w-10 h-10 rounded-full focus:outline-none focus:shadow-outline inline-flex p-2 shadow"
                                                    :style="`background: ${subject_color}; color: white`">
                                                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none"
                                                            d="M15.584 10.001L13.998 8.417 5.903 16.512 5.374 18.626 7.488 18.097z" />
                                                        <path
                                                            d="M4.03,15.758l-1,4c-0.086,0.341,0.015,0.701,0.263,0.949C3.482,20.896,3.738,21,4,21c0.081,0,0.162-0.01,0.242-0.03l4-1 c0.176-0.044,0.337-0.135,0.465-0.263l8.292-8.292l1.294,1.292l1.414-1.414l-1.294-1.292L21,7.414 c0.378-0.378,0.586-0.88,0.586-1.414S21.378,4.964,21,4.586L19.414,3c-0.756-0.756-2.072-0.756-2.828,0l-2.589,2.589l-1.298-1.296 l-1.414,1.414l1.298,1.296l-8.29,8.29C4.165,15.421,4.074,15.582,4.03,15.758z M5.903,16.512l8.095-8.095l1.586,1.584 l-8.096,8.096l-2.114,0.529L5.903,16.512z" />
                                                    </svg>
                                                </button>

                                                <div v-if="isOpenColorPicker" v-click-outside="() => (isOpenColorPicker = false)
                                                    "
                                                    class="origin-top-right absolute right-16 mt-2 w-40 rounded-md shadow-lg">
                                                    <div class="rounded-md bg-white shadow-xs px-4 py-3">
                                                        <div class="flex flex-wrap -mx-2">
                                                            <ColorPicker theme="dark" :color="subject_color"
                                                                :sucker-hide="true" @changeColor="changeColor"
                                                                @openSucker="openSucker" :colors-default="swatches" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="addMore('create')" type="button"
                                    class="px-3 py-2 border border-transparent rounded-md font-semibold text-xs tracking-widest disabled:opacity-25 disabled:cursor-not-allowed transition text-center flex justify-center items-center text-white hover:text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                                    {{ __('Add Subject') }}
                                </button>
                            </div>
                            <div class="mb-5 mt-5" v-if="form.subjects && form.subjects.length">
                                <h4 class="text-lg dark:text-gray-400">{{ __('Subjects') }}</h4>

                                <div class="bg-gray-200 dark:bg-zinc-700 inline-flex items-center text-sm rounded mr-1 px-2 mb-1"
                                    v-for="(subject, index) in form.subjects" :key="index">
                                    <span class="leading-relaxed truncate max-w-sm text-md dark:text-zinc-300">
                                        {{ subject.name }} - <span :style="`background: ${subject.color}; color: white`">{{
                                            subject.color }}</span>
                                    </span>
                                    <button @click.prevent="removeField(index, 'create')"
                                        class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                                        <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42    -1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <global-button :loading="loading" type="submit" theme="primary">
                                {{ __('Save') }}
                            </global-button>
                        </div>
                    </form>
                </a-modal>
            </div>
        </template>

        <!-- Edit Modal  -->
        <template>
            <div>
                <a-modal v-model:visible="visible" footer="" :title="__('Edit Course')" @ok="handleOk" width="800px">
                    <form @submit.prevent="updateData(this.courseInfo.id)">
                        <div class="mb-2">
                            <global-label value="Name" for="name" />
                            <global-input type="text" id="name" v-model="courseInfo.name" name="name"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Name')" :error="$page.props.errors.name" />
                            <input-error :error="$page.props.errors.name" />
                        </div>
                        <div class="mb-2">
                            <global-label for="study_program_id" value="Study Program" :required="false">
                                <Multiselect id="class" :close-on-select="true" :can-clear="true" :searchable="true"
                                    v-model="courseInfo.study_program_id" :create-option="false" :placeholder="__('Select Study Program')" :options="
                                     study_programs.map((item) => ({
                                    value: item.id,
                                    label: item.name,
                                }))
                            " autocomplete="off"/>
                            </global-label>
                        </div>
                        <div class="mb-2">
                        <global-label for="file" class="tetx-lg" :value="__('Image')" :required="true" />
                        <button type="button" @click="picFile" class="bg-gray-100 dark:bg-gray-700 w-full py-2.5 px-3 rounded testImage">
                            <div class="flex gap-2 items-center">
                                <div>
                                    <ArrowUpTrayIcon class="w-6 h-6 dark:text-gray-400" />
                                </div>
                                <div>
                                    <span v-if="file_name" class="text-blue-500">
                                        {{ file_name }}
                                    </span>
                                    <span v-else class="dark:text-gray-500">
                                        {{ __('Upload Image') }}
                                    </span>
                                </div>
                            </div>
                        </button>
                        <span class="text-gray-500">
                            {{ __('Supported format - png, jpg, jpeg') }}
                        </span>
                        <input @change="change"
                            accept="image/*"
                            type="file" ref="assignment_file" class="hidden" readonly>
                        <input-error :error="$page.props.errors.file" />
                    </div>
                        <div class="mb-2">
                            <div class="relative flex items-start">
                                <div class="flex h-5 items-center">
                                    <input id="edit_multiple_subjects" type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 :checked:bg-blue-600"
                                        @change="checkboxChange('edit')" v-model="courseInfo.has_multiple_subject"
                                        :checked="courseInfo.has_multiple_subject" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="edit_multiple_subjects" class="font-medium text-gray-700">
                                        {{ __('Has Multiple Subject') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2" v-if="courseInfo.has_multiple_subject">
                            <div class="flex gap-2 justify-between items-center">
                                <div class="flex gap-2">
                                    <div class="mb-1">
                                        <global-input type="text" id="name" v-model="subject_name"
                                            class="mt-1 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 w-full"
                                            placeholder="Subject Name" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="flex items-center">
                                            <global-input type="text" id="color" v-model="subject_color"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Color')" :error="$page.props.errors.subject_color" />

                                            <div class="relative ml-3">
                                                <button type="button" @click="
                                                    isOpenColorPicker =
                                                    !isOpenColorPicker
                                                    "
                                                    class="w-10 h-10 rounded-full focus:outline-none focus:shadow-outline inline-flex p-2 shadow"
                                                    :style="`background: ${subject_color}; color: white`">
                                                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none"
                                                            d="M15.584 10.001L13.998 8.417 5.903 16.512 5.374 18.626 7.488 18.097z" />
                                                        <path
                                                            d="M4.03,15.758l-1,4c-0.086,0.341,0.015,0.701,0.263,0.949C3.482,20.896,3.738,21,4,21c0.081,0,0.162-0.01,0.242-0.03l4-1 c0.176-0.044,0.337-0.135,0.465-0.263l8.292-8.292l1.294,1.292l1.414-1.414l-1.294-1.292L21,7.414 c0.378-0.378,0.586-0.88,0.586-1.414S21.378,4.964,21,4.586L19.414,3c-0.756-0.756-2.072-0.756-2.828,0l-2.589,2.589l-1.298-1.296 l-1.414,1.414l1.298,1.296l-8.29,8.29C4.165,15.421,4.074,15.582,4.03,15.758z M5.903,16.512l8.095-8.095l1.586,1.584 l-8.096,8.096l-2.114,0.529L5.903,16.512z" />
                                                    </svg>
                                                </button>

                                                <div v-if="isOpenColorPicker" v-click-outside="() => (isOpenColorPicker = false)
                                                    "
                                                    class="origin-top-right absolute right-16 mt-2 w-40 rounded-md shadow-lg">
                                                    <div class="rounded-md bg-white shadow-xs px-4 py-3">
                                                        <div class="flex flex-wrap -mx-2">
                                                            <ColorPicker theme="dark" :color="subject_color"
                                                                :sucker-hide="true" @changeColor="changeColor"
                                                                @openSucker="openSucker" :colors-default="swatches" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="addMore('edit')" type="button"
                                    class="px-3 py-2 border border-transparent rounded-md font-semibold text-xs tracking-widest disabled:opacity-25 disabled:cursor-not-allowed transition text-center flex justify-center items-center text-white hover:text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                                    {{ __('Add Subject') }}
                                </button>
                            </div>
                            <div class="mb-5 mt-5" v-if="courseInfo.subjects && courseInfo.subjects.length">
                                <h4 class="text-lg dark:text-gray-400">{{ __('Subjects') }}</h4>

                                <div class="bg-gray-200 dark:bg-zinc-700 inline-flex items-center text-sm rounded mr-1 px-2 mb-1"
                                    v-for="(subject, index) in courseInfo.subjects" :key="index">
                                    <span class="leading-relaxed truncate max-w-sm text-md dark:text-zinc-300">
                                        {{ subject.name }} - <span :style="`background: ${subject.color}; color: white`">{{
                                            subject.color }}</span>
                                    </span>
                                    <button @click.prevent="removeField(index, 'edit')"
                                        class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                                        <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42    -1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <global-button :loading="loading" type="submit" theme="primary">
                                {{ __('Save') }}
                            </global-button>
                        </div>
                    </form>
                </a-modal>
            </div>
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import { useForm } from "@inertiajs/inertia-vue3";
import { ColorPicker } from "vue-color-kit";
import "vue-color-kit/dist/vue-color-kit.css";
import NothingFound from "@/Shared/NothingFound.vue";
import { PencilSquareIcon, TrashIcon, EyeIcon } from '@heroicons/vue/24/outline'

export default {
    props: {
        courses: Array,
        study_programs: Object,
        query: Object,
        errors: Object,
    },
    components: {
        AppLayout,
        ColorPicker,
        Multiselect,
        NothingFound,
        PencilSquareIcon,
        TrashIcon,
        EyeIcon,
    },
    data() {
        return {
            file_name: "",
            loading: false,
            options: [],
            options: [],
            form: {
                name: "",
                qr_code_id: "",
                study_program_id: null,
                file: "",
                has_multiple_subject: false,
                subjects: [],
            },
            courseInfo: {
                id: "",
                name: "",
                study_program_id: "",
                qr_code_id: "",
                file: "",
                subjects: [],
                has_multiple_subject: true,
            },
            errors: Object,
            visible: false,
            createModalvisible: false,

            isOpenColorPicker: false,
            isSucking: true,
            swatches: [
                "#1A535C",
                "#C93737",
                "#E5940E",
                "#9F9F0F",
                "#588157",
                "#00A300",
                "#169494",
                "#1E68B1",
                "#0E0E96",
                "#6717B7",
                "#AE14AE",
                "#D00053",
                "#283618",
                "#5E6D81",
            ],

            subject_color: "#FF1900",
            subject_name: "",
        };
    },
    created() {
         // for classes
         for (const [key, value] of Object.entries(this.study_programs)) {
            this.options.push({
                value: value.id,
                label: value.name,
            });
        }
        this.form.study_program_id = this.options[0]?.value;
    },
    methods: {
        picFile() {
        this.$refs.assignment_file.click();
    },
    change(e) {
        const file = e.target.files[0];
        const maxSizeMB = 1; // Batas ukuran maksimum dalam MB

        if (file) {
            if (file.size / 1024 / 1024 > maxSizeMB) {
                alert(`File terlalu besar. Ukuran maksimum adalah ${maxSizeMB} MB.`);
                this.file_name = "";
                this.form.file = "";
            } else {
                // Kompres gambar atau langsung masukkan file
                this.form.file = file;
                this.file_name = file.name;
            }
        }
    },
        storeData() {
            this.loading = true;

            this.$inertia.post(this.route("course.store"), this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.createModalvisible = false;
                    this.form.reset();
                    this.form.subjects = [];
                },
                onFinish: (visit) => {
                    this.loading = false;
                },
            });
        },
        updateData(id) {
            this.loading = true;

            this.$inertia.put(this.route("course.update", id), this.courseInfo, {
                preserveScroll: true,
                onSuccess: () => {
                    this.visible = false;
                    this.form.reset();
                    this.courseInfo.subjects = [];
                },
                onFinish: (visit) => {
                    this.loading = false;
                },
            });
        },
        destroyData(id) {
            if (confirm("Are you sure to delete ?")) {
                this.$inertia.delete(this.route("course.destroy", id), {
                    preserveScroll: true,
                    onSuccess: () => { },
                });
            }
        },
        showModal(course) {
            this.visible = true;
            this.courseInfo.id = course.id;
            this.courseInfo.has_multiple_subject = true;
            this.courseInfo.name = course.name;
            this.courseInfo.study_program_id = course.study_program_id;
            this.courseInfo.qr_code_id = course.qr_code_id;
            this.courseInfo.file = course.file;

            this.courseInfo.subjects = [];
            for (let index = 0; index < course.subjects.length; index++) {
                this.courseInfo.subjects.push({
                    name: course.subjects[index].name,
                    color: course.subjects[index].color,
                });
            }
        },
        handleOk(e) {
            this.visible = false;
        },
        addMore(type) {
            if (!this.subject_name.length || !this.subject_color.length) return false;

            if (type == 'create') {
                this.form.subjects.push({ name: this.subject_name, color: this.subject_color });
            } else {
                this.courseInfo.subjects.push({ name: this.subject_name, color: this.subject_color });
            }

            this.subject_name = "";
            this.subject_color = "#FF1900";
        },
        removeField(index, type) {
            if (type == 'create') {
                this.form.subjects.splice(index, 1);
            } else {
                this.courseInfo.subjects.splice(index, 1);
            }
        },
        checkboxChange(event, type) {
            if (type == 'create') {
                this.form.has_multiple_subject = event.target.checked;
            } else {
                this.courseInfo.has_multiple_subject = event.target.checked;
            }
        },
        changeColor(color) {
            this.subject_color = color.hex;
        },
        changeEditColor(color) {
            this.courseInfo.color = color.hex
        }
    },
};
</script>

<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
