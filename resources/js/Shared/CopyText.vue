<template>
    <span @click="copyURL(text)" class="ml-2 cursor-pointer"><ClipboardDocumentListIcon class="h-4 w-4"/></span>
</template>

<script>
import { ClipboardDocumentListIcon } from "@heroicons/vue/24/outline";

export default {
    props: {
        text: String,
    },
    components:{
        ClipboardDocumentListIcon,
    },
    methods: {
        async copyURL(mytext) {
            try {
                await navigator.clipboard.writeText(mytext);
                alert('Copied');
            } catch($e) {
                alert('Failed to copy');
            }
        }
    }
}
</script>
