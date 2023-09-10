<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({
    errors: Object
})

const form = reactive({
    thread_name: null, 
})

const storeThreads = () => {
    router.post('/threads', form);
}

</script>

<template>
    <Head title="新規スレッド作成" />

    <AuthenticatedLayout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between">
                            <h1 class="font-black pl-5 text-xm underline">新規スレッド作成</h1>
                            <Link :href="route('dashboard')" class="text-indigo-500 underline hover:opacity-50">ホームへ戻る</Link>
                        </div>
                        <section class="text-gray-600 py-10 body-font relative">
                            <div class="container flex flex-wrap mx-auto">
                                <div class="lg:w-1/3 md:w-full mb-12">
                                    <ul>
                                        <li class="lg:w-2/3 leading-relaxed text-red-500 text-xl">※禁止事項</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・個人情報</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・特定の他者を誹謗中傷する内容</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・他者へのなりすましによる投稿</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・著作権に触れる情報</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・わいせつな情報</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・広告や商売に関連する情報</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・真実に反すること</li>
                                        <li class="lg:w-2/3 leading-relaxed text-base pb-1">・重複投稿、スレッド違いの投稿</li>
                                    </ul>
                                </div>
                                <div class="flex lg:w-2/3 md:w-full mx-auto">
                                    <form @submit.prevent="storeThreads()">
                                        <div class="flex flex-wrap -m-2">
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="title" class="leading-7 text-sm text-gray-600">スレッドタイトル</label>
                                                    <input type="text" id="title" name="title" v-model="form.thread_name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    <InputError :message="errors.thread_name" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">スレッド作成</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


