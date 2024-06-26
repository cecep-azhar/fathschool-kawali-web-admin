<template>
    <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
        <Link v-if="href" :href="href" class="flex items-center text-gray-500 hover:text-blue-600">
            <ChevronRightIcon class="flex-shrink-0 mx-3 overflow-visible h-4 w-4 text-gray-400 dark:text-gray-600" />
            {{ __(title) }}
        </Link>
        <span v-else class="flex items-center text-gray-500 hover:text-blue-600">
            <ChevronRightIcon class="flex-shrink-0 mx-3 overflow-visible h-4 w-4 text-gray-400 dark:text-gray-600" />
            {{ __(title) }}
        </span>
    </li>
</template>

<script>
import { ChevronRightIcon } from '@heroicons/vue/24/outline'

export default {
    components:{
        ChevronRightIcon
    },
    props: {
        title: {
            type: String,
            required: true
        },
        href: {
            type: String,
            required: false
        }
    }
}
</script>
