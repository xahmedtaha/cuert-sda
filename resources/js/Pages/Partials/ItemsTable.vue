<template>
    <div>
        <teleport to="body">
            <AddItemOverlay :open="addItemOverlayOpen" @close="addItemOverlayOpen = false" />
        </teleport>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-b">
            <div class="sm:flex sm:items-center pb-4">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Inventory Items</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the items you added.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button @click="addItemOverlayOpen = true" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add item</button>
                </div>
            </div>
        </div>
        <div class="mt-8 flow-root overflow-hidden">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <table class="w-full text-left" v-if="items?.length">
                    <thead class="bg-white">
                    <tr>
                        <th scope="col" class="relative isolate py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                            ID
                            <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-b-gray-200" />
                            <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-b-gray-200" />
                        </th>
                        <th scope="col" class="relative isolate py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                            Name
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Quantity</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">Type</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                        <th scope="col" class="relative py-3.5 pl-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td class="relative py-4 pr-3 text-sm font-medium text-gray-900">
                            {{ item.id }}
                            <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100" />
                            <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100" />
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ item.name }}</td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">{{ item.quantity }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ item.part_type }}</td>
                        <td class="relative py-4 pl-3 text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900"
                            >Edit<span class="sr-only">, {{ item.name }}</span></a
                            >
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
import { PlusIcon } from '@heroicons/vue/20/solid'
import AddItemOverlay from "@/Pages/Partials/AddItemOverlay.vue";
import {ref} from "vue";
defineProps({ items: Array })

const addItemOverlayOpen = ref(false)
</script>
