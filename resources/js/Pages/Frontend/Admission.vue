<template>
    <Head :title="__('Admission')" />
    <FrontendLayout>
        <div class="relative bg-white dark:bg-gray-900">
            <div class="lg:absolute lg:inset-0">
                <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                    <img class="h-56 w-full object-cover object-left-top lg:absolute lg:h-full"
                        src="https://images.unsplash.com/photo-1485546246426-74dc88dec4d9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2338&q=80"
                        alt="" />
                </div>
            </div>
            <div class="relative py-12 lg:mx-auto lg:grid lg:max-w-7xl lg:grid-cols-2">
                <div class="lg:pr-8">
                    <div class="mx-auto max-w-md sm:max-w-lg lg:mx-0">
                        <h2 class="text-3xl font-bold tracking-tight dark:text-gray-400 sm:text-4xl">
                            {{ __('Lets work together') }}
                        </h2>
                        <p class="mt-4 text-lg text-gray-500 sm:mt-3">
                            {{ __('We had love to hear from you Send us a message using the form opposite or email us We had love to hear from you Send us a message using the form opposite or email us') }}
                        </p>

                        <form @submit.prevent="saveData" class="mt-9 grid grid-cols-1 gap-y-4 gap-x-2 sm:grid-cols-2">
                            <template v-for="field in fields" :key="field.id">
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
                                    <a-upload :max-count="1" accept="image/*" v-model:file-list="avatar_value" action=""
                                        list-type="picture">
                                        <a-button>
                                            <upload-outlined></upload-outlined>
                                            {{ __('Select Avatar') }}
                                        </a-button>
                                    </a-upload>
                                    <input-error :error="form.errors.avatar" />
                                </div>
                                <div v-if="field.name == 'guardian_photo'">
                                    <global-label for="dropzone-file" value="Guardian Avatar" :required="false" />

                                    <a-upload :max-count="1" accept="image/*" v-model:file-list="parent_avatar_value" action=""
                                        list-type="picture" id="parent_image_id">
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
                                    <global-input type="text" v-model="form.gender" id="gender"
                                        name="gender"
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
                                    <global-input type="text" v-model="form.parent_email" id="parent_email"
                                        name="parent_email"
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
                                    <global-label for="national_identification_number"
                                        value="National Identification Number" :required="false" />
                                    <global-input type="text" v-model="form.national_identification_number"
                                        id="national_identification_number" name="national_identification_number"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('National Identification Number')"
                                        :error="form.errors.national_identification_number" />
                                    <input-error :error="form.errors.national_identification_number" />
                                </div>
                                <div v-if="field.name == 'blood_group'">
                                    <global-label for="blood_group" value="Blood Group" :required="false" />
                                    <Multiselect id="blood_group" :close-on-select="true" :can-clear="false"
                                        :searchable="true" v-model="form.blood_group" :create-option="false"
                                        :placeholder="__('Blood Group')" :options="[
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
                                    <global-label for="previous_school_name" value="Previous School Name"
                                        :required="false" />
                                    <global-input type="text" v-model="form.previous_school_name" id="previous_school_name"
                                        name="previous_school_name"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Previous School Name')"
                                        :error="form.errors.previous_school_name" />
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
                                            <global-input type="text" v-model="form.document_titles[index]"
                                                :id="'title' + index"
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
                                                <PlusCircleIcon v-if="index == 0" class="w-6 h-6" />
                                                <MinusCircleIcon v-else class="w-6 h-6" />
                                            </global-button>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-3 p-1"
                                        v-if="admission && admission.documents.length > 0">
                                        <div class="relative mt-2" v-for="(doc, index) in admission.documents"
                                            :key="doc.id">
                                            <a :href="doc.file_url_format" download>
                                                {{ __('Download Document') }} ({{ index + 1 }})
                                            </a>
                                            <button @click="removeDoc(doc.id)" type="button"
                                                class="absolute -top-4 bg-red-500 rounded-full -right-3">
                                                <trash-icon class="w-6 h-6 text-white p-0.5" />
                                            </button>
                                        </div>
                                    </div>
                                    <input-error :error="$page.props.errors.document" />
                                </div>
                            </template>
                            <div class="text-right sm:col-span-2">
                                <global-button :loading="form.processing" type="submit" cssClass="mt-3 font-bold"
                                    theme="primary">
                                    {{ __('Submit Admission Request') }}
                                </global-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </FrontendLayout>
</template>

<script>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import { PlusCircleIcon, MinusCircleIcon } from "@heroicons/vue/24/outline";
export default {
    props: {
        courses: {
            type: Array,
            default: () => [],
        },
        fields: {
            type: Array,
            default: () => [],
        },
        session: {
            type: String,
            default: "",
        },
    },
    components: {
        FrontendLayout,
        Multiselect,
        PlusCircleIcon,
        MinusCircleIcon
    },
    data() {
        return {
            avatar_value: null,
            parent_avatar_value: null,
            document_size: [1],
            form: useForm({
                name: "",
                email: "",
                phone: "",
                avatar: null,
                parent_avatar: null,
                classes: [],
                parent_email: "",
                parent_name: "",
                address: "",
                gender: "",
                date_of_birth: "",
                // additional
                national_identification_number: '',
                blood_group: '',
                physical_disability: '',
                religion: '',
                previous_school_name: '',
                previous_school_year_of_exist: '',
                bank_name: '',
                bank_account_number: '',
                note: '',
                documents: [],
                document_titles: [],
            }),
        };
    },
    watch: {
        avatar_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal.length > 0) {
                    this.form.avatar = newVal[0].originFileObj;
                } else {
                    this.form.avatar = null;
                }
            },
        },
        parent_avatar_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal.length > 0) {
                    this.form.parent_avatar = newVal[0].originFileObj;
                } else {
                    this.form.parent_avatar = null;
                }
            },
        },
    },
    methods: {
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
        saveData() {
            this.form.post(route("admission.store"), {
                preserveScroll: true,
                onSuccess: (visit) => {
                    this.form.reset(
                        "name",
                        "email",
                        "phone",
                        "avatar",
                        "parent_avatar",
                        "classes",
                        "parent_email",
                        "parent_name",
                        "address",
                        "gender",
                        "date_of_birth",
                        "national_identification_number",
                        "blood_group",
                        "physical_disability",
                        "religion",
                        "previous_school_name",
                        "previous_school_year_of_exist",
                        "bank_name",
                        "bank_account_number",
                        "note",
                        "documents",
                        "document_titles",
                    );
                },
            });
        },
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
input#date_of_birth {
    display: inline-block;
    position: relative;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
</style>
