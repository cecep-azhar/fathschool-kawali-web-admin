<template>
    <Link :href="url" v-if="type == 'link'"
        class="sm:px-4 px-2.5 py-1.5 sm:py-2.5 border border-transparent rounded-md font-semibold text-xs tracking-widest focus:ring focus:ring-gray-300 disabled:opacity-25 disabled:cursor-not-allowed transition text-center flex justify-center items-center"
        :class="checkTheme(theme)">
    <div v-if="loading" class="btn-spinner mr-2" />
    <slot />
    </Link>
    <button :disabled="loading" v-else :type="type ? type : 'submit'"
        class="sm:px-4 px-2.5 py-1.5 sm:py-2.5 border border-transparent rounded-md font-semibold text-xs tracking-widest focus:ring focus:ring-gray-300 disabled:opacity-25 disabled:cursor-not-allowed transition text-center flex justify-center items-center"
        :class="checkTheme(theme)">
        <div v-if="loading" class="btn-spinner mr-2" />
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        type: String,
        loading: {
            type: Boolean,
            default: false
        },
        url: String,
        cssClass: '',
        theme: {
            type: String,
            default: 'primary'
        }
    },
    methods: {
        checkTheme() {
            let style = '';
            if (this.theme == 'danger') {
                // red theme
                style = 'text-white hover:text-white bg-red-500 dark:bg-red-500  hover:bg-red-500 active:bg-red-600 dark:active:bg-red-600 focus:border-red-600 dark:focus:border-red-600 focus:ring focus:ring-red-300 dark:focus:ring-red-300 ';
            } else if (this.theme == 'secondary') {
                // pink theme
                style = 'text-white hover:text-white bg-pink-500 dark:bg-pink-500  hover:bg-pink-400 active:bg-pink-600 dark:active:bg-pink-600 focus:border-pink-600 dark:focus:border-pink-600 focus:ring focus:ring-pink-300 dark:focus:ring-pink-300 ';
            } else if (this.theme == 'sky') {
                // pink theme
                style = 'text-white hover:text-white bg-sky-500 dark:bg-sky-500  hover:bg-sky-400 active:bg-sky-600 dark:active:bg-sky-600 focus:border-sky-600 dark:focus:border-sky-600 focus:ring focus:ring-sky-300 dark:focus:ring-sky-300 ';
            } else if(this.theme == 'outline-danger') {
                style = 'text-red-500 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900'
            }else {
                // blue theme
                style = 'text-white hover:text-white bg-blue-500 dark:bg-blue-500 hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300'
            }
            return style +' ' + this.cssClass;
        }
    }
}
</script>

<style>

</style>

