<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import ItemsTable from "@/Pages/Partials/ItemsTable.vue";
import Notification from "@/Components/Notification.vue";
import {computed, ref, watch} from "vue";

defineProps({items: Array, isAdmin: Boolean})

const page = usePage()
const flashMessage = computed(() => page.props.flash.message)
const showNotification = ref(!!flashMessage)
watch(page, (message) => showNotification.value = !!message)
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6">
                    <ItemsTable :items="items" />
                </div>
            </div>
        </div>

        <teleport to="body">
            <Notification v-if="flashMessage" :show="showNotification" :message="flashMessage" @close="showNotification = false" />
        </teleport>
    </AuthenticatedLayout>
</template>
