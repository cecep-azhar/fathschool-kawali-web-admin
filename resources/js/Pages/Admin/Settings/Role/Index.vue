<template>

    <Head :title="__('Role List | Settings')" />

    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')" />
            <BreadcrumbLink :title=" __('Roles')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Role') }}
                <template #content>
                    <global-button :url="route('roles.create')" type="link" theme="primary">
                        {{ __('Create Role') }}
                    </global-button>
                </template>
            </page-header>
            <SettingLayout>
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div>
                            <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                                {{__('Roles & Permissions')}}
                            </h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{__('This information will be displayed publicly so be careful what you share.')}}
                            </p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                            <template v-if="roles.data.length > 0">
                                <div v-for="role in roles.data" :key="role.id"
                                    class="max-w-sm px-6 pt-6 bg-white shadow-xs border-2 border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-700">
                                    <div>
                                        <h5
                                            class="mb-1 text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-400">
                                            {{ role.name }}
                                        </h5>
                                    </div>
                                    <p class="font-normal text-gray-500 dark:text-gray-400">
                                        {{ role.description }}
                                    </p>
                                    <div class="mt-2 flex gap-2 mb-3 items-center text-blue-600 hover:underline">
                                        <button class="focus:outline-none"
                                            @click="permissionShow(role.permissions, role.name)" type="button">
                                            <EyeIcon class="text-purple-500 hover:text-purple-400 w-6 h-6" />
                                        </button>
                                        <Link v-if="
                                                role.name != 'Admin' &&
                                                role.name != 'Teacher' &&
                                                role.name != 'Parent' &&
                                                role.name != 'Student' &&
                                                role.name != 'Accountant'
                                            " preserve-scroll :href="route('roles.edit', role.id)"
                                            class="group relative">
                                        <PencilSquareIcon class="text-blue-400 hover:text-blue-300 w-6 h-6" />
                                        <tool-tip text="Edit" />
                                        </Link>
                                        <template v-if="
                                                role.name != 'Admin' &&
                                                role.name != 'Teacher' &&
                                                role.name != 'Parent' &&
                                                role.name != 'Student' &&
                                                role.name != 'Accountant'
                                            ">
                                            <button @click="destroy(role.id)" type="button" class="group relative">
                                                <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                                <tool-tip text="Delete" />
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="text-center p-4">
                                    <NothingFound asShow="div" />
                                </div>
                            </template>
                        </div>
                        <div class="flex justify-center">
                            <pagination class="flex justify-center mb-4 mt-6" :links="roles.links" />
                        </div>
                    </div>
                </div>
            </SettingLayout>
        </div>
        <br />
        <!-- assignment submit modal  -->
        <permission-modal maxWidth="6xl" :show="visible" @close="closeModal">
            <template #title>{{ role }} {{ __('Permissions') }}
            </template>

            <template #content>
                <!-- Content -->
                <div class="flex flex-wrap gap-4 text-center">
                    <template v-if="Object.keys(permissions).length > 0">
                        <div v-for="(permission, index) in permissions" :key="index"
                            class="rounded w-1/6 capitalize font-bold border-green-500 border-2">
                            <div class="text-black text-lg bg-green-500">
                                {{ index }}
                            </div>

                            <ul class="p-3 list-disc list-inside rtl:text-right text-left">
                                <li v-for="(per, innerIndex) in permission" :key="innerIndex">
                                    {{ per.name.split(".").pop() }}
                                </li>
                            </ul>
                        </div>
                    </template>
                    <template v-else>
                        <div class="bg-pink-500 text-white p-1 px-3 rounded font-bold">
                            {{ __('No Permission') }}
                        </div>
                    </template>
                </div>
            </template>

            <template #footer>
                <global-button :loading="false" type="button" @click="closeModal()"
                    class="text-black bg-transparent mr-2 mb-2 border-2 border-gray-200 hover:bg-transparent focus:bg-transparent active:bg-transparent">
                    {{ __('Close') }}
                </global-button>
            </template>
        </permission-modal>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import { PencilSquareIcon, TrashIcon, EyeIcon, EyeSlashIcon, ArrowRightIcon } from '@heroicons/vue/24/outline'
    import ToolTip from "@/Shared/ToolTip.vue";
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import SettingLayout from '@/Layouts/SettingLayout.vue';
    import permissionModal from '@/Shared/Modal.vue';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            AppLayout,
            TrashIcon,
            PencilSquareIcon,
            ToolTip,
            EyeIcon,
            EyeSlashIcon,
            Pagination,
            SettingLayout,
            ArrowRightIcon,
            permissionModal,
            NothingFound
        },
        props: {
            roles: Object,
        },
        data() {
            return {
                visible: false,
                permissions: [],
            };
        },
        methods: {
            permissionShow(permissions, role) {
                this.visible = true;

                const groupBy = (array, key) => {
                    // Return the end result
                    return array.reduce((result, currentValue) => {
                        // If an array already present for key, push it to the array. Else create an array and push the object
                        (result[currentValue[key]] =
                            result[currentValue[key]] || []).push(currentValue);
                        // Return the current iteration `result` value, this will be taken as next iteration `result` value and accumulate
                        return result;
                    }, {}); // empty object is the initial value for result object
                };

                // Group by color as key to the person array
                this.permissions = groupBy(permissions, "group_name");
                this.role = role;
            },
            closeModal() {
                this.visible = false;
            },
            destroy(id) {
                if (confirm("Are you sure ?")) {
                    this.$inertia.delete(this.route("roles.destroy", id));
                } else {
                    return false;
                }
            },
        },
    };
</script>
