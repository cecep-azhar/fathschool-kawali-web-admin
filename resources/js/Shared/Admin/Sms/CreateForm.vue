<template>
    <form @submit.prevent="submit">
        <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-2">
                <global-label for="title" value="Title" :required="false" />
                <global-input type="text" id="title" v-model="form.title" name="title"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Title')" :error="$page.props.errors.title" />
                <input-error :error="$page.props.errors.title" />
            </div>
            <div class="mb-2">
                <global-label for="message" value="Message" :required="false" />
                <textarea rows="8" v-model="form.message" name="message" :placeholder="__('Message')" id="message"
                    maxlength="320"
                    class="pl-4 bg-gray-50 border rounded-lg border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                <p class="text-right ">{{ remainingCharacters }} characters remaining</p>
            </div>
            <b>Dynamic Tag :</b><button v-for="(value, key) in uniqueKey" :key="key" type="button"
                class="bg-transparent border border-gray-700 text-gray-700 dark:border-gray-300 dark:text-gray-300 mx-1 px-2 py-1 rounded-lg"
                @click="insertValue(key)">
                {{ value }}
            </button>
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
                title: '',
                message: '',
            },
            maxLength: 320,

            uniqueKey: {
                name: '{name}',
                email: '{email}',
                phone: '{phone}',
            }
        }
    },
    methods: {
        insertValue(key) {
            this.form.message += this.uniqueKey[key];
        },
        submit() {
            this.loading = true;
            this.$inertia.post(this.route('sms.template.store'), this.form, {
                onSuccess: () => {
                    this.form.title = "";
                    this.form.message = "";
                },
                onFinish: visit => { this.loading = false },
            })
        }
    },
    computed: {
        remainingCharacters() {
            return this.maxLength - this.form.message.length
        }
    },
}
</script>

<style></style>
