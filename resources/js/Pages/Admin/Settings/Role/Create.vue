<template>
    <AppLayout :title="__('Role Create')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')"/>
            <BreadcrumbLink :title=" __('Roles')"/>
            <BreadcrumbLink :title=" __('Role Create')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Role Create') }}
                <template #content>
                    <global-button preserve-scroll :url="route('roles.index')" type="link" theme="primary">
                       {{ __('All Roles') }}
                    </global-button>
                </template>
            </page-header>
            <SettingLayout>
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div class="grid grid-cols-12 divide-y-0 divide-x  dark:divide-gray-600 gap-8">
                            <div class="col-span-12">
                                <form @submit.prevent="submit" class="rounded-b-lg -mt-2 dark:bg-gray-800">
                                    <div class="w-full sm:p-4 md:p-0 md:mt-2 dark:bg-gray-700 ">
                                        <div class="lg:flex items-center justify-center w-full">
                                            <div
                                                class="focus:outline-none lg:w-4/12 mt-4 px-6 rounded-lg">
                                                <div class="flex justify-between justify-items-center">
                                                    <global-label for="name" value="Name" :required="true" />
                                                    <p
                                                        class="mb-2 focus:outline-none text-xl font-medium leading-5 text-gray-800 dark:text-white">
                                                        <x-item :item="root" @change="onChange"></x-item>
                                                    </p>
                                                </div>
                                                <global-input type="text" v-model="form.name" id="name" name="name"
                                                    class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Enter Role Name')" :error="$page.props.errors.name" />
                                                <input-error :error="$page.props.errors.name" />
                                            </div>
                                        </div>
                                        <div class="lg:flex items-center justify-center w-full mt-1">
                                            <div
                                                class="focus:outline-none lg:w-4/12 bg-white dark:bg-gray-700 px-6 rounded-lg">
                                                <div class="flex justify-between justify-items-center">
                                                    <global-label for="description" value="Description" :required="false" />
                                                </div>
                                                <global-textarea type="text" v-model="form.description" id="description" name="description"
                                                    class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Enter Role Description')" :error="$page.props.errors.description" />
                                                <input-error :error="$page.props.errors.description" />
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="w-full p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <template v-if="root">
                                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-5"
                                                v-for="group in root.children" :key="group">
                                                <x-item :item="group" @change="onChange"></x-item>
                                                <div v-for="item in group.children" :key="item" class="ml-6 p-1">
                                                    <x-item :item="item" @childData="getValue"
                                                        @change="onChange"></x-item>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <input-error :error="$page.props.errors.role_permissions" />
                                    <div class="focus:outline-none w-full mt-2">
                                        <div class="lg:flex justify-center w-full px-4">
                                            <global-button :loading="loading" type="submit" cssClass="w-full mb-4"
                                                theme="primary">
                                                {{ __('Create') }}
                                            </global-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import XItem from "./Input.vue";
import SettingLayout from '@/Layouts/SettingLayout.vue';

export default {
    components: {
        AppLayout,
        XItem,
        SettingLayout
    },
    props: {
        permissions: Array,
        errors: Object,
    },
    data() {
        return {
            loading: false,
            root: null,
            groups: [],
            form: {
                role_permissions: [],
                name: "",
                description: ""
            },
        };
    },
    methods: {
        onChange(node, checked) {
            node.checked = checked;
            this.updateChildren(node, checked);
            this.updateTree();

            if (node.children) {
                // check item children availabe . if item has children then it is all button or group button
                node.children.forEach((element) => {
                    if (element.children) {
                        // it is all button
                        element.children.forEach((element) => {
                            if (checked) {
                                // this code for add permission
                                var check = this.form.role_permissions.includes(
                                    element.name
                                );
                                if (!check) {
                                    this.form.role_permissions.push(
                                        element.name
                                    );
                                }
                            } else {
                                // this code for remove permission
                                var pers = this.form.role_permissions;
                                pers.forEach(function (value, key) {
                                    if (element.name == value) {
                                        pers.splice(key, 1);
                                    }
                                });
                                this.form.role_permissions = pers;
                            }
                        });
                    } else {
                        // it is group button
                        if (checked) {
                            // this code for add permission
                            var check = this.form.role_permissions.includes(
                                element.name
                            );
                            if (!check) {
                                this.form.role_permissions.push(element.name);
                            }
                        } else {
                            // this code for remove permission
                            var pers = this.form.role_permissions;
                            pers.forEach(function (value, key) {
                                if (element.name == value) {
                                    pers.splice(key, 1);
                                }
                            });
                            this.form.role_permissions = pers;
                        }
                    }
                });
            }
        },
        updateChildren(node, checked) {
            if (!node.children) return;
            node.children.forEach((child) => {
                child.checked = checked;
                this.updateChildren(child, checked);
            });
        },
        updateTree() {
            (function update(node) {
                if (!node.children) return;
                node.children.forEach(update);
                node.checked = node.children.every((child) => child.checked);
            })(this.root);
        },
        // get single value
        getValue(item, checked) {
            if (checked) {
                var check = this.form.role_permissions.includes(item.name);
                if (!check) {
                    this.form.role_permissions.push(item.name);
                }
            } else {
                var pers = this.form.role_permissions;
                pers.forEach(function (value, key) {
                    if (item.name == value) {
                        pers.splice(key, 1);
                    }
                });
                this.form.role_permissions = pers;
            }
        },
        submit() {
            this.loading = true;

            this.$inertia.post(route("roles.store"), this.form, {
                preserveScroll: true,
                onSuccess: () => { },
                onFinish: visit => { this.loading = false },
            });
        },
    },
    created() {
        for (const [key, value] of Object.entries(this.permissions)) {
            this.groups.push({
                id: 2,
                name: key,
                items: value,
            });
        }
        // data format create for group
        this.root = {
            name: "Select All",
            checked: false,
            children: this.groups.map((group) => ({
                name: group.name,
                checked: false,
                children: group.items.map((item) => ({
                    item,
                    id: item.id,
                    name: item.name,
                    checked: false,
                })),
            })),
        };
    },
};
</script>
