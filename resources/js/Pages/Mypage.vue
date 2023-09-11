<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { get_diffTime, getDate_change_format } from '@/common';
import Pagination from '@/Components/Pagination.vue';
import { onBeforeMount } from 'vue';

const props = defineProps({
    user_info: Object, 
    threads_titles: Object
})

const updateStatus = (id) => {
    router.put(route('threads.update', {thread: id})); 
}


</script>

<template>
    <Head title="マイページ" />

    <AuthenticatedLayout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="font-black pl-5 text-xm underline">マイページ</h1>

                        <section class="py-3">
                            <h2 class="w-full font-black text-lg text-red-500">アカウント情報</h2>
                            <hr class="w-full border-0 h-0.5 bg-gray-500">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                    <div id="name" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ user_info.name }}</div>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="price" class="leading-7 text-sm text-gray-600">ID</label>
                                    <div id="price" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ user_info.hash_id }}</div>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="price" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                    <div id="price" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ user_info.email }}</div>
                                </div>
                            </div>
                            <Link :href="route('profile.edit')" class="text-indigo-500 inline-flex items-center mt-4">アカウント情報編集はこちら
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </Link>
                        </section>
                        <section class="py-3">
                            <h2 class="w-full font-black text-lg text-red-500">スレッド情報</h2>
                            <hr class="w-full border-0 h-0.5 bg-gray-500">
                            <div class="text-gray-600 body-font overflow-hidden">
                                <div class="container px-5 py-10">
                                    <div class="-my-8 divide-y-2 divide-gray-100 py-3">
                                        <article v-for="threads_title in threads_titles.data" :key="threads_title.id" class="thread_article">
                                            <Link :href="route('threads.show', {thread: threads_title.id})">
                                                <div class="thread_time">
                                                    <span>{{ get_diffTime(threads_title.created_at) }}</span>
                                                    <span class="pl-5">({{ getDate_change_format(threads_title.created_at) }})</span>
                                                </div>
                                                <div class="thread_title pl-4">{{ threads_title.thread_name }}</div>
                                            </Link>
                                            <div class="flex justify-end">
                                                <input type="checkbox" id="open" v-if="threads_title.status == true" checked class="thread_status" @click="updateStatus(threads_title.id)">
                                                <input type="checkbox" id="close" v-if="threads_title.status == false" class="thread_status" @click="updateStatus(threads_title.id)">
                                                <label for="open" v-if="threads_title.status == true">公開中</label>
                                                <label for="close" v-if="threads_title.status == false">非公開</label>
                                                <div class="thread_viewcount">{{ threads_title.show_count }} views</div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <Pagination class="flex justify-center mt-6" :links="threads_titles.links"></Pagination>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
    .sec-title{
        display: block;
        color: rgb(250, 114, 114);
        font-weight: bold;
        border-bottom: 1px solid red;
        padding-bottom: 0.2em;
        margin-bottom: 0.4em;
    }

    .thread_article{
        display: block;
    }
    .thread_article a:hover{
        opacity: 0.7;
        background-color: rgb(230, 230, 230);
    }
    .thread_viewcount{
        text-align: end;
        padding-left: 25px;
    }
</style>
