<template>
    <template>
        <div>
            <template v-if="setting.app_logo_type == 'text'">
                <h2 class="mb-0 text-lg font-bold dark:text-gray-400">
                    {{ setting.text_logo_name }}
                </h2>
            </template>
            <template v-else>
                <template v-if="dark_class">
                    <img class="sm:min-w-[64px] sm:max-w-[64px] min-w-[40px] max-w-[40px] h-auto object-contain" :src="setting.light_logo_url" :alt="setting.text_logo_name">
                </template>
                <template v-else>
                    <img class="sm:min-w-[64px] sm:max-w-[64px] min-w-[40px] max-w-[40px] h-auto object-contain" :src="setting.dark_logo_url" :alt="setting.text_logo_name">
                </template>
            </template>
        </div>
    </template>
</template>

<script>
export default {
  computed: {
    setting(){
      return this.$page.props.setting;
    }
  },
}
</script>

<style>

</style>
