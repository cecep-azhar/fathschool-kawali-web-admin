<template>
    <div class="p-6 dark:text-gray-400">
        <div class="w-full">
            <div class="my-2 flex items-center">
                <div>
                    <img class="w-24 h-24 object-cover rounded-lg" :src="user.profile_photo_url" alt="">
                </div>
                <div class="ml-3">
                    <h2 class="dark:text-gray-400 text-lg font-bold">{{ user.name }}</h2>
                    <h2 class="dark:text-gray-400 text-sm text-gray-500">
                        <span
                            class="border-blue-100 border-2 w-full text-gray-600 px-4 text-xs font-semibold mr-2 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                            {{ user.role }}
                        </span>
                    </h2>
                </div>
            </div>
            <h2 class="dark:text-gray-400" v-if="user.department">
                {{ __('Department') }}: {{ user.department.name }}</h2>
            <h2 class="dark:text-gray-400">{{ __('Phone') }}: {{ user.phone }}</h2>
            <h2 class="dark:text-gray-400">{{ __('Address') }}: {{ user.address }}</h2>
            <h2 class="dark:text-gray-400" v-if="user.profile">{{ __('Roll No') }}: {{ user.profile.roll_no }}</h2>
            <h2 class="dark:text-gray-400" v-if="user.profile">{{ __('Session') }}: {{ user.profile.session }}</h2>
            <h2 class="dark:text-gray-400" v-if="user.profile">{{ __('Course') }}: {{ user.profile.class.name }}</h2>
            <h2 class="dark:text-gray-400" v-if="user.profile">{{ __('Parent') }}: {{ user.profile.parent.name }}</h2>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: Object
    },
}
</script>

<style>

</style>
