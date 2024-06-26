<template>
    <a-modal width="500px" v-model:visible="visible" :wrap-style="{ overflow: 'auto' }" @ok="handleOk">
        <!-- Content -->
        <div class="w-full dark:bg-gray-800 dark:border-gray-700 rounded-lg">
            <div class="mb-1">
                <global-label for="comment" value="Comment" :required="false" />
                <editor :placeholder="__('Description')" v-model="form.comment"
                    api-key="kjn96qwsicri2i9dtz5ilb5saih3za74f54lkjx2uw7xe1vm" :init="{
                    menubar: false,
                    plugins: 'lists link image emoticons',
                    toolbar: 'styleselect | bold italic forecolor backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons'
                    }" />
                <input-error :error="$page.props.errors.comment" />
            </div>
        </div>
        <template #title>
            <div ref="editmodal" class="width-100">
                {{ __('Edit Comment') }}
            </div>
        </template>
        <template #footer>
            <global-button :loading="loading" type="button" @click="submit()"
                class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 mr-2 mb-2 dark:focus:ring-blue-300">
                {{ __('Edit') }}
            </global-button>
        </template>
    </a-modal>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import Editor from '@tinymce/tinymce-vue'

export default {
    props: {
        comment: Object,
        reply: Boolean
    },
    components: {
        Editor
    },
    data() {
        return {
            visible: false,
            form: useForm({
                comment: this.comment.comment,
                _method: "PUT",
            }),
        };
    },
    watch: {
        comment: {
            deep: true,
            handler(val, oldVal) {
                this.form.comment = val.comment;
            },
        },
    },
    methods: {
        showModal() {
            this.visible = true;
        },
        handleOk(e) {
            this.visible = false;
        },
        submit() {
            if (this.reply) {
                this.form.post(this.route("reply.update", this.comment.id), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.visible = false;
                    },
                });
            } else {
                this.form.post(this.route("comment.update", this.comment.id), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.visible = false;
                    },
                });
            }
        },
    },
};
</script>
<style>
.tox-notification {
    visibility: hidden !important;
}

.tox-statusbar__branding {
    visibility: hidden !important;
}
</style>
