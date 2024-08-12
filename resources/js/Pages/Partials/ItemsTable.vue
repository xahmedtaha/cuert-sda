<template>
    <div>
        <teleport to="body">
            <AddItemOverlay v-if="$page.props.isAdmin" :open="addItemOverlayOpen" @close="addItemOverlayOpen = false" />
        </teleport>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-b">
            <div class="sm:flex sm:items-center pb-4">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Inventory Items</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the items added to the system.</p>
                </div>
                <div v-if="$page.props.isAdmin" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button @click="addItemOverlayOpen = true" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add item</button>
                </div>
            </div>
        </div>
        <div class="flow-root overflow-hidden">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <table class="w-full text-left" v-if="items?.length">
                    <thead class="bg-white">
                    <tr>
                        <th scope="col" class="hidden sm:table-cell relative isolate py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                            ID
                            <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-b-gray-200" />
                            <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-b-gray-200" />
                        </th>
                        <th scope="col" class="relative isolate py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                            Name
                        </th>
                        <th scope="col" class="hidden sm:table-cell px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                        <th scope="col" class="hidden sm:table-cell px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                        <th v-if="$page.props.isAdmin" scope="col" class="relative py-3.5 pl-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td class="hidden sm:table-cell relative py-4 pr-3 text-sm font-medium text-gray-900">
                            {{ item.id }}
                            <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100" />
                            <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100" />
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ item.name }}</td>
                        <td class="hidden sm:table-cell px-3 py-4 text-sm text-gray-500">{{ item.quantity }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ item.part_type }}</td>
                        <td class="hidden sm:table-cell px-3 py-4 text-sm text-gray-500">
                            <p v-for="(value, key) in item.description">
                                <span class="font-semibold">{{key}}</span>: <span>{{value}}</span>
                            </p>
                        </td>
                        <td v-if="$page.props.isAdmin" class="relative py-4 pl-3 text-right text-sm font-medium md:table-cell">
                            <div class="inline-flex gap-x-3">
                                <button class="text-indigo-600 hover:text-indigo-900">
                                    <PencilSquareIcon class="size-5" />
                                    <span class="sr-only">Edit, {{ item.name }}</span>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <TrashIcon class="size-5" />
                                    <span class="sr-only">Delete, {{ item.name }}</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center" v-else>
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No inventory items</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new item.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/20/solid'
import AddItemOverlay from "@/Pages/Partials/AddItemOverlay.vue";
import {ref} from "vue";

defineProps({ items: Array, canWrite: Boolean })

const addItemOverlayOpen = ref(false)
</script>
