<template>
    <div class="flex gap-2 items-center">
        <img class="h-10 w-10 rounded-full" :src="image" :alt="name">
        <div>
            {{ name }}
            <div class="text-gray-500">
                {{ email }}
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        image: String,
        name: String,
        email: String,
    }
}
</script>

