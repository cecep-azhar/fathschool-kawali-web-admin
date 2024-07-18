<template>
    <AppLayout :title="__('General Settings | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')" />
            <BreadcrumbLink :title=" __('Website')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Website') }}
                </div>
            </page-header>

            <SettingLayout>
                <!-- Sliders  -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    <div class="lg:col-span-2">
                        <div
                            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{ __('Slider Gallery') }}
                                    </h2>
                                </div>
                                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                    <template v-if="sliders.length > 0">
                                        <div class="grid grid-cols-4 gap-3">
                                            <div v-for="slider in sliders" :key="slider.id"
                                                class="h-full relative bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                <img class="rounded-lg" :src="slider.image" alt="" />
                                                <span :id="'delete'+slider.id"
                                                    class="absolute inline-flex bg-gray-900 opacity-70 rounded-lg p-1 w-8 text-red-500 cursor-pointer top-0 right-0"
                                                    @click.prevent="
                                                        deleteImage(slider.id)
                                                    ">
                                                    <TrashIcon />
                                                </span>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <NothingFound asShow="div" />
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{ update ? __("Update Social Media"): __("Create Slider Gallery") }}
                                    </h2>
                                </div>
                                <!-- Add Slider Gallery -->
                                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                    <form class="mt-2" @submit.prevent="saveSlideImage()" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <global-label for="name" value="Image" :required="true" />
                                            <global-input type="file" id="name" name="name"
                                                class="mt-1 block w-full dark:bg-gray-700" @change="onFileChange" />
                                            <input-error :error="$page.props.errors.image" />
                                        </div>
                                        <global-button :loading="form.processing" type="submit" cssClass="mt-3"
                                            theme="primary">
                                            {{__('Add Image')}}
                                        </global-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- LANDING  -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
    <div class="lg:col-span-2">
        <div
            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                        {{ __('Landing Video') }}
                    </h2>
                </div>
                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <template>
                        <div class="grid grid-cols-4
                         gap-3">

                            <div v-for="landing in landings" :key="landing.id"
                                class="h-full relative bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <global-input class="rounded-lg" :src="landing.title" />
                                <global-input class="rounded-lg" :src="landing.video_link" />
                                <global-input class="rounded-lg" :src="landing.paragraph" />
                                <span :id="'delete'+landing.id"
                                    class="absolute inline-flex bg-gray-900 opacity-70 rounded-lg p-1 w-8 text-red-500 cursor-pointer top-0 right-0"
                                    @click.prevent="deleteContent(landing.id)">
                                    <TrashIcon />
                                </span>
                            </div>
                        </div>
                    </template>
                    <template>
                        <NothingFound asShow="div" />
                    </template>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div
            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
            <div class="py-6 px-4 sm:p6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                        {{ update ? __("Update Social Media"): __("Create Landing Video") }}
                    </h2>
                </div>
                <!-- Add landing video -->
                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <form class="mt-2" @submit.prevent="saveLandingContent()">
                        <div class="mb-3">
                            <global-label for="title" value="Title" :required="true" />
                            <global-input type="text" id="title" name="title" v-model="form.title"
                                class="mt-1 block w-full dark:bg-gray-700" />
                            <input-error :error="$page.props.errors.title" />
                        </div>
                        <div class="mb-3">
                            <global-label for="description" value="Description" :required="true" />
                            <textarea id="description" name="description" v-model="form.description"
                                class="mt-1 block w-full dark:bg-gray-700"></textarea>
                            <input-error :error="$page.props.errors.description" />
                        </div>
                        <div class="mb-3">
                            <global-label for="youtubeLink" value="YouTube Link" :required="true" />
                            <global-input type="text" id="youtubeLink" name="youtubeLink" v-model="form.youtubeLink"
                                class="mt-1 block w-full dark:bg-gray-700" />
                            <input-error :error="$page.props.errors.youtubeLink" />
                        </div>
                        <global-button :loading="form.processing" type="submit" cssClass="mt-3" theme="primary">
                            {{__('Add Content')}}
                        </global-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- Social Media  -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    <div class="lg:col-span-2">
                        <div
                            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{__('Social Media Setting')}}
                                    </h2>
                                </div>
                                <div >
                                    <table-content @edit="edit" :socialLinks="socialLinks" />
                                    <div class="flex justify-center">
                                        <pagination class="mt-6" :links="socialLinks.links" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{ update ? __("Update Social Media"): __("Create Social Media") }}
                                    </h2>
                                </div>
                                <!-- Social Media Settings -->
                                <div
                                    class="w-full bg-white rounded-lg dark:bg-gray-800 text-sm rtl:text-right text-left text-gray-500 dark:text-gray-400">
                                    <create-form v-if="!update" />
                                    <update-form :socialLink="socialLink" v-if="update" />
                                </div>
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
    import SettingLayout from "@/Layouts/SettingLayout.vue";
    import TableContent from "@/Shared/Admin/Setting/SocialLink/Table.vue";
    import CreateForm from "@/Shared/Admin/Setting/SocialLink/CreateForm.vue";
    import UpdateForm from "@/Shared/Admin/Setting/SocialLink/UpdateForm.vue";
    import ToolTip from "@/Shared/ToolTip.vue";
    import { TrashIcon } from "@heroicons/vue/24/outline";;
    import { useForm } from "@inertiajs/inertia-vue3";
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        props: {
            sliders: {
                type: Object,
                required: true,
            },
            setting: {
                type: Object,
                required: true,
            },
            socialLinks: Array,
        },
        data() {
            return {
                form: useForm({
                    image: "",
                }),

                update: false,
                socialLink: "",
            };
        },
        data() {
        return {
            form: useForm({
                video_link: "",
                title: "",
                paragraph: ""
            }),
            update: false,
            socialLink: "",
        };
    },
        components: {
            AppLayout,
            SettingLayout,
            ToolTip,
            TrashIcon,
            TableContent,
            CreateForm,
            UpdateForm,
            NothingFound
        },
        methods: {
            onFileChange(e) {
                const file = e.target.files[0];
                this.form.image = file;
                this.previewImage = URL.createObjectURL(file);
            },
            deleteImage(id) {
                if (confirm("Are you sure ?")) {
                    this.$inertia.delete(
                        this.route("settings.website.slider.delete", id)
                    );
                }
            },
            saveSlideImage() {
                this.form.post(this.route("settings.website.slider.store"), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.image = "";
                    },
                });
            },
            saveSocialMedia() {
                this.socialForm.put(
                    this.route("settings.website.social.update"),
                    {
                        preserveScroll: true,
                    }
                );
            },
            edit(socialLink) {
                this.update = true;
                this.socialLink = socialLink;
            },
            deleteContent(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(
                    this.route("settings.website.landing.delete", id)
                );
            }
        },
        saveLandingContent() {
            this.form.post(this.route("settings.website.landing.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.title = "";
                    this.form.description = "";
                    this.form.youtubeLink = "";
                },
            });
        },
        },
    };
</script>
