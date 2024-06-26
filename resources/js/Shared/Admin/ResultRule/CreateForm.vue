<template>
    <form @submit.prevent="submit">
        <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-2">
                <global-label for="name" value="Name" :required="false" />
                <global-input type="text" id="name" v-model="form.name" name="name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="mb-2">
                <global-label for="gpa" value="GPA" :required="false" />
                <global-input type="text" id="gpa" v-model="form.gpa" name="gpa"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('GPA')" :error="$page.props.errors.gpa" />
                <input-error :error="$page.props.errors.gpa" />
            </div>
            <div class="mb-2">
                <global-label for="min_mark" value="Min Mark" :required="false" />
                <global-input type="text" id="min_mark" v-model="form.min_mark" name="min_mark"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Min Mark')" :error="$page.props.errors.min_mark" />
                <input-error :error="$page.props.errors.min_mark" />
            </div>
            <div class="mb-2">
                <global-label for="max_mark" value="Max Mark" :required="false" />
                <global-input type="text" id="name" v-model="form.max_mark" name="max_mark"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Max Mark')" :error="$page.props.errors.max_mark" />
                <input-error :error="$page.props.errors.max_mark" />
            </div>
            <div class="mb-2">
                <global-label for="grade_remark" value="Grade Remark" :required="false" />
                <global-input type="text" id="grade_remark" v-model="form.grade_remark" name="grade_remark"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Grade Remark')" :error="$page.props.errors.grade_remark" />
                <input-error :error="$page.props.errors.grade_remark" />
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
    data() {
        return {
            loading: false,
            form: {
                name: '',
                gpa: '',
                min_mark: '',
                max_mark: '',
                grade_remark: '',
            }
        }
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(this.route('result.rule.store'), this.form, {
                onSuccess: () => {
                    this.form.reset()
                },
                onFinish: visit => { this.loading = false },
            })
        }
    }
}
</script>

<style>

</style>
