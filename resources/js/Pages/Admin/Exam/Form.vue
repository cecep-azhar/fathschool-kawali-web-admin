<template>
    <AppLayout :title="__(text)">
        <Breadcrumb>
            <BreadcrumbLink :title="__('text')" />
        </Breadcrumb>

        <div class="mx-auto pb-12">
            <div
                class="rounded-lg flex justify-between items-center mb-4 py-4 px-6 text-lg font-semibold rtl:text-right text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <div class="dark:text-gray-400">
                    {{ __(text) }}
                </div>
                <Link preserve-scroll :href="route('exam.index')">
                <global-button :loading="false" type="button" theme="primary">
                    {{ __('All Exam') }}
                </global-button>
                </Link>
            </div>
            <div class="rounded-lg">
                <form @submit.prevent="submit">
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="examName" value="Enter exam name" :required="true" />
                                <global-input v-model="form.name" type="text" id="examName"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter exam name')" :error="$page.props.errors.name" />
                                <input-error :error="$page.props.errors.name" />
                            </div>
                            <div class="mb-3">
                                <global-label for="grade" value="Grade" :required="true" />
                                <global-input v-model="form.grade" type="text" id="mark"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter mark')" :error="$page.props.errors.grade" />
                                <input-error :error="$page.props.errors.grade" />
                            </div>
                            <div class="mb-3">
                                <global-label for="gpa" value="GPA" :required="true" />
                                <global-input v-model="form.gpa" step="any" @change="validateDecimal($event)" type="number"
                                    id="gpa"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter mark')" :error="$page.props.errors.gpa" />
                                <input-error :error="$page.props.errors.gpa" />
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="selectKlass" value="Select Course" :required="true" />
                                <a-select :class="$page.props.errors.course ? 'border-custom ' : ''" size="large"
                                    class="width-100" v-model:value="form.course" show-search
                                    :placeholder="__('Select a course')" :options="options2" :filter-option="filterOption"
                                    @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                                </a-select>
                                <input-error :error="$page.props.errors.course" />
                            </div>
                            <div class="mb-3">
                                <global-label for="date" value="Date" :required="true" />
                                <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                    :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="date"
                                    :format="customDateFormat" id="testDate" />
                                <input-error :error="$page.props.errors.start_date" />
                                <input-error :error="$page.props.errors.end_date" />
                            </div>
                            <div class="mb-1">
                                <global-label for="description" value="Description" :required="false" />
                                <textarea rows="" v-model="form.description" name="" :placeholder="__('Description')"
                                    id="description" :class="$page.props.errors.description
                                        ? 'border-red-500 dark:border-red-500'
                                        : ''
                                        "
                                    class="pl-4 bg-gray-50 border rounded-lg border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                <input-error :error="$page.props.errors.description" />
                            </div>
                        </div>
                    </div>
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mt-3" theme="primary">
                        {{ __('Save') }}
                    </global-button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import dayjs from "dayjs";
export default {
    props: {
        courses: Object,
        exam: Object,
        update: Boolean,
    },
    components: {
        AppLayout,
    },
    data() {
        return {
            loading: false,
            customDateFormat: "DD-MM-YYYY",
            options: [],
            options2: [],
            options3: [],
            text: this.exam ? "Update Exam" : "Create Exam",
            date: [
                this.exam?.start_date
                    ? dayjs(this.exam?.start_date, this.customDateFormat)
                    : "",
                this.exam?.end_date
                    ? dayjs(this.exam?.end_date, this.customDateFormat)
                    : "",
            ],
            form: {
                name: this.exam?.name ?? "",
                grade: this.exam?.grade ?? "",
                gpa: this.exam?.gpa ?? "",
                start_date: this.exam?.start_date ?? "",
                end_date: this.exam?.end_date,
                description: this.exam?.description ?? "",
                course: this.exam?.course_id ?? "",
                _method: this.exam ? "PUT" : "POST",
            },
        };
    },
    watch: {
        date: {
            deep: true,
            handler(val, oldVal) {
                if (val) {
                    console.log(val);
                    this.form.start_date = dayjs(val[0]);
                    this.form.end_date = dayjs(val[1]);
                }
                // this.form.name = val.name;

                // this.form.description = val.description;
                // this.form.course = val.course_id;
                // this.form._method = this.update ? "PUT" : "POST";
                // this.form.grade = val.grade;
                // this.form.gpa = val.gpa;
            },
        },
    },
    created() {
        // for class
        for (const [key, value] of Object.entries(this.courses)) {
            this.options2.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.update) {
            this.form.course = this.options2[0] ? this.options2[0].value : '';
        }
    },
    methods: {
        submit() {
            this.loading = true;
            if (this.exam) {
                this.$inertia.post(
                    this.route("exam.update", this.exam.id),
                    this.form,
                    {
                        preserveScroll: true,
                        onSuccess: () => {
                            this.reset();
                        },
                        onFinish: (visit) => {
                            this.loading = false;
                        },
                    }
                );
            } else {
                this.$inertia.post(this.route("exam.store"), this.form, {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.reset();
                    },
                    onFinish: (visit) => {
                        this.loading = false;
                    },
                });
            }
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
        reset() {
            this.form.name = "";
            this.form.date = null;
            this.form.description = "";
            this.form.course = [];
        },
        validateDecimal(e) {
            var num = this.form.gpa;
            var num2 = parseFloat(num).toFixed(2);
            this.form.gpa = num2;
        },
    },
};
</script>

<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
