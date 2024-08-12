<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="p-4 bg-white min-h-screen flex flex-col items-stretch sm:items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div>
            <ApplicationLogo class="h-14 sm:h-20 w-auto mx-auto" />
        </div>
        <h1 class="text-2xl sm:text-4xl font-bold text-center mt-8">Inventory Management System</h1>
        <div class="flex flex-col sm:flex-row gap-4 mt-8 text-center">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md bg-primary-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md bg-primary-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-md bg-primary-50 px-3.5 py-2.5 text-sm font-semibold text-primary-600 shadow-sm hover:bg-primary-100"
                >
                    Register
                </Link>
            </template>
        </div>
    </div>
</template>
