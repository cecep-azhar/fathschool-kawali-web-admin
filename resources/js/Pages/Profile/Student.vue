<template>
    <div class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-3">
            <global-label for="roll" :value="__('Roll No')" :required="false" />
            <input @keyup="studentDataPush" type="text" v-model="form.roll_no" id="roll" name="roll" :class="$page.props.errors.roll_no ? 'border-red-500 dark:border-red-500' : ''
            "
                class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                :placeholder="__('Enter Roll Number')" />
            <input-error :error="$page.props.errors.roll_no" />
        </div>
        <div class="mb-3">
            <global-label for="session" :value="__('Session')" :required="false" />
            <global-input @keyup="studentDataPush" type="text" v-model="form.session" id="session" name="session"
                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" placeholder="2021-2022"
                :error="$page.props.errors.session" />
            <input-error :error="$page.props.errors.session" />
        </div>
    </div>
    <div class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-3">
            <global-label for="blood_group" value="Blood Group" :required="false" />
            <Multiselect @change="studentDataPush($event, 'select')" id="blood_group" :close-on-select="true"
                :can-clear="false" :searchable="true" v-model="form.blood_group" :create-option="false"
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
            <input-error :error="$page.props.errors.blood_group" />
        </div>
        <div class="mb-3">
            <global-label for="physical_disability" value="Physical Disability" :required="false" />
            <global-input @keyup="studentDataPush" id="physical_disability" v-model="form.physical_disability" type="text"
                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                :placeholder="__('Physical Disability')" :error="$page.props.errors.physical_disability" />
            <input-error :error="$page.props.errors.physical_disability" />
        </div>
        <div class="mb-3">
            <global-label for="religion" value="Religion" :required="false" />
            <global-input @keyup="studentDataPush" id="religion" v-model="form.religion" type="text"
                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" :placeholder="__('Religion')"
                :error="$page.props.errors.religion" />
            <input-error :error="$page.props.errors.religion" />
        </div>
        <div class="mb-3">
            <global-label for="previous_school_name" value="Previous School Name" :required="false" />
            <global-input @keyup="studentDataPush" id="previous_school_name" v-model="form.previous_school_name" type="text"
                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                :placeholder="__('Previous School Name')" :error="$page.props.errors.previous_school_name" />
            <input-error :error="$page.props.errors.previous_school_name" />
        </div>
        <div class="mb-3">
            <global-label for="previous_school_year_of_exist" value="Previous School Year Of Exist" :required="false" />
            <global-input @keyup="studentDataPush" id="previous_school_year_of_exist"
                v-model="form.previous_school_year_of_exist" type="text"
                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                :placeholder="__('Previous School Year Of Exist')"
                :error="$page.props.errors.previous_school_year_of_exist" />
            <input-error :error="$page.props.errors.previous_school_year_of_exist" />
        </div>
    </div>
</template>

<script>
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
export default {
    props: {
        departments: Object,
        classes: Object,
        parents: Object,
        user: Object
    },
    components: { Multiselect },
    inheritAttrs: false,
    data() {
        return {
            options: [],
            options2: [],
            options3: [],
            form: {
                roll_no: this.user ? this.user.profile.roll_no : '',
                class: this.user ? this.user.profile.course_id : '',
                parent: this.user ? this.user.profile.parent_id : '',
                session: this.user ? this.user.profile.session : '',
                blood_group: this.user ? this.user.profile.blood_group : '',
                physical_disability: this.user ? this.user.profile.physical_disability : '',
                religion: this.user ? this.user.profile.religion : '',
                previous_school_name: this.user ? this.user.profile.previous_school_name : '',
                previous_school_year_of_exist: this.user ? this.user.profile.previous_school_year_of_exist : '',
            }
        }
    },
    created() {
        // for class
        for (const [key, value] of Object.entries(this.classes)) {
            this.options.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.user) {
            this.form.class = null;
        }
        // for department
        for (const [key, value] of Object.entries(this.departments)) {
            this.options2.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.user) {
            this.form.department = null;
        }
        // for parent
        for (const [key, value] of Object.entries(this.parents)) {
            this.options3.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.user) {
            this.form.parent = null;
        }
    },
    methods: {
        studentDataPush(e, arg) {
            if (arg == 'select') {
                setTimeout(() => {
                    this.$emit('student-form', this.form)
                }, 100);
            } else {
                this.$emit('student-form', this.form)
            }
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
    }
}
</script>

<style>
</style>
