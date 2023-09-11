<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { getDate_change_format } from '@/common';
import Pagination from '@/Components/Pagination.vue';
import InputError from '@/Components/InputError.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { onMounted } from 'vue';

const props = defineProps({
    errors: Object, 
    thread_id: Number, 
    thread_title: String, 
    thread_comments: Object
});  

const form = reactive({
    thread_id: props.thread_id, 
    comment: null
});


const storeComment = () => {
    router.post('/comments', form)
}



</script>

<template>
    <Head title="スレッド画面" />

    <AuthenticatedLayout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <FlashMessage />
                        <div class="flex justify-end pb-5">
                            <Link :href="route('dashboard')" class="text-indigo-500 underline hover:opacity-50">ホームへ戻る</Link>
                        </div>
                        <h1 class="font-black pl-5 text-xl text-red-500">{{ thread_title }}</h1>
                        <section class="text-gray-600 body-font overflow-hidden">
                            <div class="container px-5 py-10 mx-auto">
                                <div class="-my-8 divide-y-2 divide-gray-100 py-3">
                                    <div v-for="thread_comment in thread_comments.data" :key="thread_comment.id" class="thread_comment pl-5 pt-5">
                                        <div class="flex">
                                            <span class="font-black">{{ (thread_comment.row_num + (50 * (thread_comments.current_page - 1))) }} : </span>
                                            <span class="ml-3 text-green-500">{{ thread_comment.user_name }}</span>
                                            <span class="ml-3">{{ getDate_change_format(thread_comment.created_at) }}</span>
                                            <span class="ml-3">ID : {{ thread_comment.hash_id }}</span>
                                        </div>
                                        <div class="ml-7 my-2">
                                            {{ thread_comment.comment }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <Pagination class="my-6 flex justify-center" :links="thread_comments.links"></Pagination>
                        </section>
                        <hr class="w-full my-2 border-0 h-0.5 bg-gray-400">
                        <div v-show="thread_comments.current_page === thread_comments.last_page" class="p-2 w-full">
                            <form @submit.prevent="storeComment()">
                                <div class="relative">
                                    <label for="comment" class="leading-7 text-sm text-gray-600" >コメント</label>
                                    <textarea id="comment" name="comment" v-model="form.comment" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                    <InputError :message="errors.comment" />
                                </div>
                                <div class="p-2 w-full">
                                    <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">コメント投稿</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
    .thread_comment{
        font-size: 17px;
    }
</style>
