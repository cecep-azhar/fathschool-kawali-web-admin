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
                    :placeholder="__('Name')" :error="$page.props.errors.gpa" />
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
        <div class="flex gap-2 ml-5">
            <global-button :loading="loading" type="submit" theme="primary" class="mr-2">
                {{ __('Update') }}
            </global-button>

            <Link preserve-scroll :href="route('result.rule.index')">
                <global-button :loading="false" type="button" theme="outline-danger">
                    {{ __('Cancel') }}
                </global-button>
            </Link>
        </div>
        <br>
    </form>
</template>

<script>
export default {
    props: { rule: Object },
    data() {
        return {
            loading: false,
            form: {
                name: this.rule.name,
                gpa: this.rule.gpa,
                min_mark: this.rule.min_mark,
                max_mark: this.rule.max_mark,
                grade_remark: this.rule.grade_remark,
                _method: "PUT",
            },
        };
    },
    watch: {
        rule: {
            deep: true,
            handler(val) {
                this.form.name = val.name;
                this.form.gpa = val.gpa;
                this.form.min_mark = val.min_mark;
                this.form.max_mark = val.max_mark;
                this.form.grade_remark = val.grade_remark;
            },
        },
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(
                this.route("result.rule.update", this.rule.id),
                this.form,
                {
                    onSuccess: () => {
                        this.$inertia.get(this.route("result.rule.index"));
                    },
                    onFinish: visit => { this.loading = false },
                }
            );
        },
    },
};
</script>
