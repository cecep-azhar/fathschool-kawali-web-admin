<template>
    <div class="p-6 bg-white cursor-pointer hover:shadow-lg transition-all duration-300 rounded-lg dark:bg-gray-800 dark:border-gray-800">
        <img class="rounded-md object-cover w-full h-64" :src="child.profile_photo_url" :alt="child.name">
        <div class="flex justify-between items-center">
            <h2 class="mb-3 font-semibold text-base mt-2 text-gray-500 dark:text-gray-400">
                {{ child.name }}
            </h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor"
                class="w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
        </div>
        <div class="text-gray-500 dark:text-gray-400">
            {{ __('Roll No') }} : {{ child.profile.roll_no }}
        </div>
        <slot />
        <div class="flex justify-between mt-3 text-sm text-gray-500 dark:text-gray-400">
            <div>
                <div>{{ __('Attendance') }}</div>
                <div>{{ child.profile.attendance_present_avarage }}%</div>
            </div>
            <div>
                <div>{{ __('Assignment Marks') }}</div>
                <div>{{ child.profile.assignment_avarage_mark }}%</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        child: Object
    }
}
</script>

<style>

</style>
