<template>
    <form @submit.prevent="submit">
        <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-3">
                <global-label for="mark" value="Enter mark" :required="false" />
                <global-input v-model="form.marks" type="text" id="mark"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter mark')" :error="$page.props.errors.marks" />
                <input-error :error="$page.props.errors.marks" />
            </div>
            <div class="mb-3">
                <global-label for="grade" value="Grade" :required="false" />
                <global-input v-model="form.grade" type="text" id="grade"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter grade')" :error="$page.props.errors.grade" />
                <input-error :error="$page.props.errors.grade" />
            </div>
            <div class="mb-3">
                <global-label for="gpa" value="GPA" :required="false" />
                <global-input @change="validateDecimal($event)" v-model="form.gpa" type="text" id="gpa"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Enter gpa')" :error="$page.props.errors.gpa" />
                <input-error :error="$page.props.errors.gpa" />
            </div>
        </div>
        <div class="flex gap-2">
            <global-button :loading="loading" type="submit"
                cssClass="ml-5" theme="primary">
                {{ __('Save') }}
            </global-button>
            <Link preserve-scroll v-if="this.update" :href="route('grades.index')" class="hover:text-gray-500">
            <back-button />
            </Link>
        </div>
        <br>
    </form>
</template>

<script>
export default {
    props: {
        grade: Object,
        update: Boolean,
    },
    data() {
        return {
            loading: false,
            form: {
                marks: this.grade.name ?? null,
                grade: this.grade.start_date ?? null,
                gpa: this.grade.end_date ?? null,
                _method: "",
            },
        };
    },
    watch: {
        grade: {
            deep: true,
            handler(val, oldVal) {
                this.form.marks = val.marks;
                this.form.grade = val.grade;
                this.form.gpa = val.gpa;
                this.form._method = this.update ? "PUT" : "POST";
            },
        },
    },
    methods: {
        validateDecimal(e) {
            var num = this.form.gpa;
            var num2 = parseFloat(num).toFixed(2);
            this.form.gpa = num2;
        },
        submit() {
            this.loading = true;

            if (this.update) {
                this.$inertia.post(this.route("grades.update", this.grade.id), this.form, {
                    onSuccess: () => {
                        this.reset();
                    },
                    onFinish: visit => { this.loading = false },
                });
            } else {
                this.$inertia.post(this.route("grades.store"), this.form, {
                    onSuccess: () => {
                        this.reset();
                    },
                    onFinish: visit => { this.loading = false },
                });
            }
        },
        reset() {
            this.form.marks = "";
            this.form.grade = null;
            this.form.gpa = "";
        }
    },
};
</script>
