<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { get_diffTime } from '@/common';
import { ref } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import { onMounted } from 'vue';

const props = defineProps({
    threads_titles: Object, 
    search_word: String
});

const search = ref('');

onMounted(() => {
    search.value = props.search_word
})


const searchThreads = () => {
    router.get(route('threads.index', {search: search.value}))
}

</script>

<template>
    <Head title="まとめ" />

    <AuthenticatedLayout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between">
                            <h1 class="font-black pl-5 text-xm underline">みんなの掲示板まとめ</h1>
                            <Link :href="route('dashboard')" class="text-indigo-500 underline hover:opacity-50">ホームへ戻る</Link>
                        </div>
                        <div class="w-full flex justify-center">
                            <input type="text" name="search" class="" v-model="search">
                            <button class="bg-blue-600 text-white py-2 px-2" @click="searchThreads">検索</button>
                        </div>
                        <section class="text-gray-600 body-font overflow-hidden">
                            <div class="container px-5 py-10 mx-auto">
                                <div class="-my-8 divide-y-2 divide-gray-100 py-3">
                                    <article v-for="threads_title in threads_titles.data" :key="threads_title.id" class="thread_article pl-5 pt-5">
                                        <Link :href="route('threads.show', {thread: threads_title.id})">
                                            <div class="thread_time">{{ get_diffTime(threads_title.created_at) }}</div>
                                            <div class="thread_title pl-4">{{ threads_title.thread_name }}</div>
                                            <div class="thread_viewcount">{{ threads_title.show_count }} views</div>
                                        </Link>
                                    </article>
                                </div>
                            </div>
                            <Pagination class="flex justify-center mt-6" :links="threads_titles.links"></Pagination>
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
    }
</style>

