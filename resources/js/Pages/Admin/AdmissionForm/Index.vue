<template>
    <Head :title="__('Admission Form')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Admission Form')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Admission Form') }}
            </page-header>

            <div class="rounded-md bg-yellow-50 -mt-2 p-4 mb-2">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">
                            {{ __('Attention Needed!') }}
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p class="m-0">
                                {{ __('You can arrange the items by dragging the indicator icon') }}.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-2">
                <div class="bg-white dark:bg-gray-800 rounded p-8">
                    <div class="">
                        <draggable class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-3" :list="fields"
                            @change="log">
                            <template v-for="(field, index) in fields" :key="index">
                                <div class="bg-white dark:bg-gray-700 dark:text-gray-400">
                                    <div
                                        class="flex custom-wrap-css justify-between items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <div class="cursor-move py-4 flex items-center">
                                            <drag-icon />
                                            <label for="bordered-radio-1"
                                                class="w-full ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ field.field_name }}
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input @change="statusChange($event, field.id)" :checked="field.status"
                                                    type="checkbox" value="" class="sr-only peer">
                                                <div :id="'test_' + field.name"
                                                    class="custom-class w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                                <span
                                                    class="ml-3 mr-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    Show On Form
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded p-8">
                    <div class="text-lg font-bold -mt-2 dark:text-gray-400">
                        {{ __('Form Preview') }}
                    </div>
                    <form class="mt-4 grid grid-cols-1 gap-y-4 gap-x-2 md:grid-cols-2">
                        <div v-for="field in active_fields" :key="field.id">
                            <div v-if="field.name == 'name'">
                                <global-label for="name" value="Full Name" :required="true" />
                                <global-input type="text" v-model="form.name" id="name" name="name"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Name')" :error="form.errors.name" />
                                <input-error :error="form.errors.name" />
                            </div>
                            <div v-if="field.name == 'email'">
                                <global-label for="email" value="Email" :required="true" />
                                <global-input type="text" v-model="form.email" id="email" name="email"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Email')" :error="form.errors.email" />
                                <input-error :error="form.errors.email" />
                            </div>
                            <div v-if="field.name == 'profile_photo'">
    <global-label for="dropzone-file" value="Avatar" :required="false" />
    <a-upload
        accept="image/*"
        :max-count="1"
        v-model:file-list="avatar_value"
        action=""
        list-type="picture"
        :before-upload="beforeUploadAvatar"
    >
        <a-button>
            <upload-outlined></upload-outlined>
            {{ __('Select Avatar') }}
        </a-button>
    </a-upload>
    <input-error :error="form.errors.avatar" />
</div>
<div v-if="field.name == 'guardian_photo'">
    <global-label for="dropzone-file" value="Guardian Avatar" :required="false" />
    <a-upload
        :max-count="1"
        accept="image/*"
        v-model:file-list="parent_avatar_value"
        action=""
        list-type="picture"
        :before-upload="beforeUploadGuardian"
    >
        <a-button>
            <upload-outlined></upload-outlined>
            {{ __('Select Guardian Avatar') }}
        </a-button>
    </a-upload>
    <input-error :error="form.errors.parent_avatar" />
</div>
                            <div v-if="field.name == 'date_of_birth'">
                                <global-label for="date_of_birth" value="Date Of Birth" :required="true" />
                                <global-input type="date" v-model="form.date_of_birth" id="date_of_birth"
                                    name="date_of_birth"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Date Of Birth')" :error="form.errors.date_of_birth" />
                                <input-error :error="form.errors.date_of_birth" />
                            </div>
                            <div v-if="field.name == 'gender'">
                                <global-label for="gender" value="Gender" :required="true" />
                                <global-input type="text" v-model="form.gender" id="gender" name="gender"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Gender')" :error="form.errors.gender" />
                                <input-error :error="form.errors.gender" />
                            </div>
                            <div v-if="field.name == 'phone'">
                                <global-label for="phone" value="Phone" :required="false" />
                                <global-input type="text" v-model="form.phone" id="phone" name="phone"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Phone')" :error="form.errors.phone" />
                                <input-error :error="form.errors.phone" />
                            </div>
                            <div v-if="field.name == 'course'">
                                <global-label for="classes" value="Select Course" :required="true" />
                                <Multiselect id="classes" :close-on-select="true" :can-clear="false" :searchable="true"
                                    mode="tags" v-model="form.classes" :create-option="false"
                                    :placeholder="__('Select Course')" :options="courses.map((course) => ({
                                        value: course.id, label: course.name
                                    }))" autocomplete="off" />
                                <input-error :error="form.errors.classes" />
                            </div>
                            <div v-if="field.name == 'guardian_name'">
                                <global-label for="parent_name" value="Guardian Name" :required="true" />
                                <global-input type="text" v-model="form.parent_name" id="parent_name" name="parent_name"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Guardian Name')" :error="form.errors.parent_name" />
                                <input-error :error="form.errors.parent_name" />
                            </div>
                            <div v-if="field.name == 'guardian_email'">
                                <global-label for="parent_email" value="Guardian Email Address" :required="true" />
                                <global-input type="text" v-model="form.parent_email" id="parent_email" name="parent_email"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Guardian Email Address')" :error="form.errors.parent_email" />
                                <input-error :error="form.errors.parent_email" />
                            </div>
                            <div v-if="field.name == 'address'" class="col-span-2">
                                <global-label for="address" value="Your Address" :required="false" />
                                <global-textarea v-model="form.address" id="address" name="address"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Your Address')" :error="form.errors.address" />
                                <input-error :error="form.errors.address" />
                            </div>
                            <div v-if="field.name == 'note'" class="col-span-2">
                                <global-label for="note" value="Note" :required="false" />
                                <global-textarea v-model="form.note" id="note" name="note"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Note')" :error="form.errors.note" />
                                <input-error :error="form.errors.note" />
                            </div>
                            <div v-if="field.name == 'national_identification_number'">
                                <global-label for="national_identification_number" value="National Identification Number"
                                    :required="false" />
                                <global-input type="text" v-model="form.national_identification_number"
                                    id="national_identification_number" name="national_identification_number"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('National Identification Number')"
                                    :error="form.errors.national_identification_number" />
                                <input-error :error="form.errors.national_identification_number" />
                            </div>
                            <div v-if="field.name == 'blood_group'">
                                <global-label for="blood_group" value="Blood Group" :required="false" />
                                <Multiselect id="blood_group" :close-on-select="true" :can-clear="false" :searchable="true"
                                    v-model="form.blood_group" :create-option="false" :placeholder="__('Blood Group')"
                                    :options="[
                                        { value: 'A+', label: 'A+' },
                                        { value: 'A-', label: 'A-' },
                                        { value: 'B+', label: 'B+' },
                                        { value: 'B-', label: 'B-' },
                                        { value: 'O+', label: 'O+' },
                                        { value: 'O-', label: 'O-' },
                                        { value: 'AB+', label: 'AB+' },
                                        { value: 'AB-', label: 'AB-' },
                                    ]" autocomplete="off" />
                                <input-error :error="form.errors.blood_group" />
                            </div>
                            <div v-if="field.name == 'physical_disability'">
                                <global-label for="physical_disability" value="Physical Disability" :required="false" />
                                <global-input type="text" v-model="form.physical_disability" id="physical_disability"
                                    name="physical_disability"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Physical Disability')" :error="form.errors.physical_disability" />
                                <input-error :error="form.errors.physical_disability" />
                            </div>
                            <div v-if="field.name == 'religion'">
                                <global-label for="religion" value="Religion" :required="false" />
                                <global-input type="text" v-model="form.religion" id="religion" name="religion"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Religion')" :error="form.errors.religion" />
                                <input-error :error="form.errors.religion" />
                            </div>
                            <div v-if="field.name == 'previous_school_name'">
                                <global-label for="previous_school_name" value="Previous School Name" :required="false" />
                                <global-input type="text" v-model="form.previous_school_name" id="previous_school_name"
                                    name="previous_school_name"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Previous School Name')" :error="form.errors.previous_school_name" />
                                <input-error :error="form.errors.previous_school_name" />
                            </div>
                            <div v-if="field.name == 'previous_school_year_of_exist'">
                                <global-label for="previous_school_year_of_exist" value="Previous School Year Of Exist"
                                    :required="false" />
                                <global-input type="text" v-model="form.previous_school_year_of_exist"
                                    id="previous_school_year_of_exist" name="previous_school_year_of_exist"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Previous School Year Of Exist')"
                                    :error="form.errors.previous_school_year_of_exist" />
                                <input-error :error="form.errors.previous_school_year_of_exist" />
                            </div>
                            <div v-if="field.name == 'bank_name'">
                                <global-label for="bank_name" value="Bank Name" :required="false" />
                                <global-input type="text" v-model="form.bank_name" id="bank_name" name="bank_name"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Bank Name')" :error="form.errors.bank_name" />
                                <input-error :error="form.errors.bank_name" />
                            </div>
                            <div v-if="field.name == 'bank_account_number'">
                                <global-label for="bank_account_number" value="Bank Account Number" :required="false" />
                                <global-input type="text" v-model="form.bank_account_number" id="bank_account_number"
                                    name="bank_account_number"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Bank Account Number')" :error="form.errors.bank_account_number" />
                                <input-error :error="form.errors.bank_account_number" />
                            </div>

                            <div v-if="field.name == 'documents'" class="col-span-2">
                                <global-label for="document" value="Document" :required="false" />
                                <div v-for="(item, index) in document_size" :key="index"
                                    class="flex items-center gap-3 mb-2">
                                    <div class="w-full">
                                        <global-input type="text" v-model="document_titles[index]" :id="'title' + index"
                                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Document Title')" :error="$page.props.errors.note" />
                                    </div>
                                    <div class="w-full">
                                        <input type="file" @change="picDocs"
                                            :class="$page.props.errors.document ? 'border-red-500 dark:border-red-500' : ''"
                                            :id="'document' + index" name="document" accept="image/*, pdf/*, doc/*"
                                            class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" />
                                    </div>
                                    <div @click="addDocument(index)">
                                        <global-button :loading="loading" type="button" cssClass="font-bold"
                                            :theme="index == 0 ? 'primary' : 'danger'">
                                            <PlusCircleIcon v-if="index == 0" class="h-5 w-5" />
                                            <MinusCircleIcon v-else class="h-5 w-5" />
                                        </global-button>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-3 p-1" v-if="admission && admission.documents.length > 0">
                                    <div class="relative mt-2" v-for="(doc, index) in admission.documents" :key="doc.id">
                                        <a :href="doc.file_url_format" download>
                                            {{ __('Download Document') }} ({{ index + 1 }})
                                        </a>
                                        <button @click="removeDoc(doc.id)" type="button"
                                            class="absolute -top-4 bg-red-500 rounded-full -right-3">
                                            <trash-icon class="w-5 h-5 text-white p-0.5" />
                                        </button>
                                    </div>
                                </div>
                                <input-error :error="$page.props.errors.document" />
                            </div>
                        </div>
                    </form>
                    <div class="flex justify-center">
                        <global-button :loading="form.processing" disabled type="submit" cssClass="mt-3 font-bold"
                            theme="primary">
                            {{ __('Submit Admission Request') }}
                        </global-button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { VueDraggableNext } from 'vue-draggable-next'
import { useForm } from "@inertiajs/inertia-vue3";
import { CursorArrowRippleIcon } from "@heroicons/vue/24/outline";
import { PlusCircleIcon, MinusCircleIcon } from "@heroicons/vue/24/outline";
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import DragIcon from "@/Components/Svg/DragIcon.vue";
export default {
    props: {
        fields: Object,
        active_fields: Object,
        courses: Object,
    },
    data() {
        return {
            enabled: true,
            dragging: false,
            document_size: [1],
            document_titles: [],
            form: useForm({
                index: 0,
                old_index: 0,
                _method: 'PUT'
            }),
            status: useForm({
                value: false,
            })
        };
    },
    components: {
        DragIcon,
        AppLayout,
        CursorArrowRippleIcon,
        draggable: VueDraggableNext,
        PlusCircleIcon,
        Multiselect,
        MinusCircleIcon
    },
    methods: {
        log(moved) {
            let index = moved.moved.newIndex + 1;
            let old_index = moved.moved.oldIndex + 1;
            let field = moved.moved.element.id;
            this.form.field = field;
            this.form.index = index;
            this.form.old_index = old_index;
            this.form.post(this.route('form.update', field), {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.form.reset('index', 'old_index');
                },
            })
        },
        addDocument(index) {
            if (index == 0) {
                this.document_size.push(1);
            } else {
                this.document_size.splice(index, 1)
                this.form.document_titles.splice(index, 1)
                this.form.documents.splice(index, 1)
            }
        },
        picDocs(e) {
            this.form.documents.push(e.target.files[0]);
        },
        removeDoc(id) {
            if (confirm('Are your sure ??')) {
                this.$inertia.post(
                    this.route("admin.doc.destroy", id),
                    {
                        preserveScroll: true,
                    }
                );
            }
        },
        statusChange(e, id) {
            let value = e.target.checked;
            this.status.value = value;
            this.status.post(this.route('form.status.change', id), {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.status.reset('value');
                },
            })
        }
    },
};
</script>
<style>
.ant-tooltip-content {
    display: none !important;
}

.ant-tooltip .ant-tooltip-placement-top {
    display: none !important;
}

.ant-upload-list-picture .ant-upload-list-item-error,
.ant-upload-list-picture-card .ant-upload-list-item-error {
    border-color: green;
}

.ant-upload-list-item-error,
.ant-upload-list-item-error .ant-upload-text-icon>.anticon,
.ant-upload-list-item-error .ant-upload-list-item-name {
    color: green;
}

.custom-wrap-css .flex-wrap {
    padding-bottom: 12px;
}
</style>
