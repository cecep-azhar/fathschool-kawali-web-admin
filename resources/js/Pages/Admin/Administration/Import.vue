<template>
    <AppLayout :title="__('Import Administration')">
        <Breadcrumb>
            <BreadcrumbLink
                :href="route('administrations.index')"
                title="Administration"
            />
            <BreadcrumbLink :title="__('Import Administration')" />
        </Breadcrumb>

        <div>
            <page-header>
                {{ __("Import Administration") }}
                <template #content>
                    <Link
                        preserve-scroll
                        :href="route('administrations.index')"
                    >
                        <global-button
                            :loading="false"
                            type="button"
                            class="text-white bg-black dark:bg-black hover:bg-black active:bg-black dark:active:bg-black focus:border-black dark:focus:border-black focus:ring focus:ring-black dark:focus:ring-black dark:text-gray-400"
                        >
                            {{ __("Go To Back") }}
                        </global-button>
                    </Link>
                </template>
            </page-header>
            <div class="mb-4">
                <cvs-file-bulk />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CvsFileBulk from "./CvsFileBulk.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import { ExclamationCircleIcon } from "@heroicons/vue/24/outline";

export default {
    components: {
        AppLayout,
        CvsFileBulk,
        ExclamationCircleIcon,
        ToolTip,
    },
    props: {
        errors: Object,
        departments: Object,
        parents: Object,
        classes: Object,
        plans: Object,
    },
    data() {
        return {};
    },
    methods: {},
};
</script>
