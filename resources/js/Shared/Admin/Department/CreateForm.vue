<template>
    <form @submit.prevent="submit">
        <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700">
            <div >
                <global-label for="name" value="Name" :required="false" />
                <global-input type="text" id="name" v-model="form.name" name="name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="mt-3">
                <global-label for="study_program_id" value="Study Program" :required="false" />
                    <a-select :class="$page.props.errors.study_program_id ? 'border-custom ' : ''" size="large" class="width-100"
                       v-model="form.study_program_id" show-search :placeholder="__('Select Study Program')" :options="options"
                       :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                    </a-select>
                <input-error :error="$page.props.errors.study_program_id" />
            </div>
        </div>
        <global-button :loading="loading" type="submit"
            class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 rtl:ml-0 rtl:mr-5 ml-5 mb-6 dark:focus:ring-blue-300">
            {{ __('Save') }}
        </global-button>
        <br>
    </form>
</template>

<script>
export default {
    props: {
        study_programs: {
            type: Object,
            default: () => ({}), // Pastikan props memiliki default nilai kosong
        },
    },
    data() {
        return {
            loading: false,
            options: [],
            form: {
                name: '',
                study_program_id: null,
            }
        }
    },
    created() {
        // for study programs
        for (const [key, value] of Object.entries(this.study_programs)) {
            this.options.push({
                value: value.id,
                label: value.name,
            });
        }
        this.form.study_program_id = this.options[0]?.value;
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(this.route('departments.store'), this.form, {
                onSuccess: () => {
                    this.form.name = ''
                    this.form.study_program_id = null
                },
                onFinish: visit => { this.loading = false },
            })
        }
    }
}
</script>

<style>

</style>
