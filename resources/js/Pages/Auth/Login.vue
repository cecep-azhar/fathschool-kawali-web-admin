<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { VueRecaptcha } from 'vue-recaptcha';
import { ref } from "vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
    recaptcha_site_key: String,
    recaptcha_status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
    recaptcha: false,
});

const loading = ref('');
const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const verifyMethod = () => {
    form.recaptcha = true;
}
</script>

<template>
    <Head title="Log in" />
    <div class="flex min-h-screen">
        <div class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <app-logo class="block h-1/2 w-auto" />
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ __('Login to your account') }}</h2>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <div v-if="status"
                            class="p-4 font-bold mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <strong>{{ status }}</strong>
                        </div>
                        <div v-if="$page.props.warning"
                            class="p-4 font-bold mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <strong>{{ $page.props.warning }}</strong>
                        </div>

                        <form @submit.prevent="submit" method="POST" class="space-y-6">
                            <div>
                                <JetLabel for="email" :value="__('Email')" />
                                <global-input id="email" placeholder:="__('Email Address')" v-model="form.email"
                                    type="email" class="mt-1 block w-full" :error="$page.props.errors.email"
                                    :placeholder="__('Email')" />
                                <input-error :error="$page.props.errors.email" />
                            </div>

                            <div class="space-y-1">
                                <JetLabel for="password" :value="__('Password')" />
                                <global-input id="password" :placeholder="__('Password')" v-model="form.password"
                                    type="password" class="mt-1 block w-full" :error="$page.props.errors.password"
                                    autocomplete="current-password" />
                                <input-error :error="$page.props.errors.password" />
                            </div>

                            <div v-if="recaptcha_status" class="space-y-1">
                                <vue-recaptcha ref="recaptcha" @verify="verifyMethod"
                                    :sitekey="recaptcha_site_key"></vue-recaptcha>
                                <input-error :error="$page.props.errors.recaptcha" />
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="flex items-center">
                                        <JetCheckbox v-model:checked="form.remember" name="remember" />
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="text-sm">
                                    <Link preserve-scroll :href="route('password.request')"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">
                                    {{ __('Forgot your password') }}
                                    </Link>
                                </div>
                            </div>

                            <div>
                                <global-button :loading="form.processing" type="submit"
                                    class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    {{ __('Login') }}
                                </global-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="images/loginn.jpg"
                alt="login banner image" />
        </div>
    </div>
</template>