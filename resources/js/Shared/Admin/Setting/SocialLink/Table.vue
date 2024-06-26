<template>
    <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg">
        <global-table classes="bg-white">
            <template #head>
                <th class="py-5 px-5">
                    {{ __('Icon') }}
                </th>
                <th class="py-4 px-5">
                    {{ __('Name') }}
                </th>
                <th class="py-4 px-5">
                    {{ __('URL') }}
                </th>
                <th class="py-4 px-5">
                    {{ __('Status') }}
                </th>
                <th width="10%" class="py-4 px-5">
                    {{ __('Action') }}
                </th>
            </template>
            <template #body>
                <template v-if="socialLinks.data.length > 0">
                    <template v-for="socialLink in socialLinks.data" :key="socialLink.id">
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-5 px-5">
                                <img :src="socialLink.icon_url" alt="icon" class="h-7 w-7 object-cover">
                            </td>
                            <td class="py-4 px-5">{{ socialLink.name }}</td>
                            <td class="py-4 px-5">{{ socialLink.url }}</td>
                            <td class="py-4 px-5">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input @change="
                                        updateStatus($event, socialLink.id)
                                    " :checked="socialLink.status" type="checkbox" class="sr-only peer" />
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex gap-2">
                                    <button type="button" @click="edit(socialLink)" class="group relative" :id="'socialEdit'+socialLink.id">
                                        <PencilSquareIcon class="w-6 h-6 text-blue-400 hover:text-blue-300" />
                                        <tool-tip text="Edit" />
                                    </button>
                                    <button type="button" @click="destroy(socialLink.id)" class="group relative" :id="'socialDelete'+socialLink.id">
                                        <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                        <tool-tip text="Delete" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </template>
                <template v-else>
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            Nothing Found.
                        </td>
                    </tr>
                </template>
            </template>
        </global-table>
    </div>
</template>

<script>
import ToolTip from "@/Shared/ToolTip.vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";

export default {
    props: {
        socialLinks: Array,
    },
    components: {
        ToolTip,
        TrashIcon,
        PencilSquareIcon,
    },
    data() {
        return {
            status: "",
        };
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(
                    this.route("settings.social.destroy", id)
                );
            } else {
                return false;
            }
        },
        edit(socialLink) {
            this.$emit("edit", socialLink);
        },
        updateStatus(event, socialLink) {
            let value = event.target.checked;

            this.$inertia.post(
                this.route("settings.social.status.update", socialLink),
                {
                    status: value,
                },
                {
                    preserveScroll: true,
                }
            );
        },
    },
};
</script>
