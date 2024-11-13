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
        </div>
        <div class="flex gap-2 ml-5">
            <global-button :loading="loading" type="submit" theme="primary" class="mr-2">
                {{ __('Update') }}
            </global-button>

            <Link preserve-scroll :href="route('study_programs.index')">
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
    props: { studyProgram: Object },
    data() {
        return {
            loading: false,
            form: {
                name: this.studyProgram.name,
                _method: "PUT",
            },
        };
    },
    watch: {
        studyProgram: {
            deep: true,
            handler(val, oldVal) {
                this.form.name = val.name;
            },
        },
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(
                this.route("study_programs.update", this.studyProgram.id),
                this.form,
                {
                    onSuccess: () => {
                        this.$inertia.get(this.route("study_programs.index"));
                    },
                    onFinish: visit => { this.loading = false },
                }
            );
        },
    },
};
</script>
