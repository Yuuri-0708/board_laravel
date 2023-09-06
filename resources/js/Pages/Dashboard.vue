<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { get_diffTime } from '@/common';

const props = defineProps({
    threads_titles_new: Object, 
    threads_titles_popular: Object,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="font-black pl-5 text-xm underline">ホーム画面</h1>
                        
                        <section class="text-gray-600 body-font overflow-hidden">
                            <div class="container px-5 py-10 mx-auto">
                                <h2 class="sec-title">最新の記事</h2>
                                <div class="-my-8 divide-y-2 divide-gray-100 py-3">
                                    <article v-for="threads_title in threads_titles_new" :key="threads_title.id" class="thread_article pl-5 pt-5">
                                        <a href="#">
                                            <div class="thread_time">{{ get_diffTime(threads_title.updated_at) }}</div>
                                            <div class="thread_title pl-4">{{ threads_title.thread_name }}</div>
                                        </a>
                                    </article>
                                </div>
                            </div>
                        </section>
                        <section class="text-gray-600 body-font overflow-hidden">
                            <div class="container px-5 py-10 mx-auto">
                                <h2 class="sec-title">人気トップ</h2>
                                <div class="-my-8 divide-y-2 divide-gray-100 py-3">
                                    <article v-for="threads_title in threads_titles_popular" :key="threads_title.id" class="thread_article pl-5 pt-5">
                                        <a href="#">
                                            <div class="thread_time">{{ get_diffTime(threads_title.updated_at) }}</div>
                                            <div class="thread_title pl-4">{{ threads_title.thread_name }}</div>
                                        </a>
                                    </article>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="text-center">
                        <Link class="text-indigo-500 inline-flex items-center mt-4" :href="route('threads.index')">記事をもっと見る
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </Link>
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
    .thread_time{

    }
</style>
