<template>
    <div class="p-6 dark:text-gray-400">
        <div class="w-full">
            <h2 class="dark:text-gray-400">
                {{ __('Topic') }}: {{ meeting.topic }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __('Meeting Id') }}: {{ meeting.meeting_id }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __('Meeting Uuid') }}: {{ meeting.meeting_uuid }}
            </h2>
            <h2 class="dark:text-gray-400">
               {{ __('Start Time') }}: {{ meeting.start_date_format }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __('Host Email') }}: {{ meeting.host_email }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __('Description') }}: {{ meeting.description }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __('Meeting Start Url') }}: <a :href="meeting.meeting_start_url">Start Meeting</a>
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __('Meeting Join Url') }}: <a :href="meeting.meeting_join_url">Join Meeting</a>
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __('Password') }}: {{ meeting.password }}
            </h2>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        meeting: Object
    },
    methods: {
    }
}
</script>

<style>

</style>
