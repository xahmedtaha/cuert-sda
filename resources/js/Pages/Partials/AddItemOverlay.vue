<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="$emit('close')">
            <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                        <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="pointer-events-auto w-screen max-w-md">
                                <form class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                                    <div class="h-0 flex-1 overflow-y-auto">
                                        <div class="bg-indigo-700 px-4 py-6 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle class="text-base font-semibold leading-6 text-white">New Inventory Item</DialogTitle>
                                                <div class="ml-3 flex h-7 items-center">
                                                    <button type="button" class="relative rounded-md bg-indigo-700 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" @click="$emit('close')">
                                                        <span class="absolute -inset-2.5" />
                                                        <span class="sr-only">Close panel</span>
                                                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <p class="text-sm text-indigo-300">Get started by filling in the information below to create your new item.</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-1 flex-col justify-between">
                                            <div class="divide-y divide-gray-200 px-4 sm:px-6">
                                                <div class="space-y-6 pb-5 pt-6">
                                                    <div>
                                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                                        <div class="mt-2">
                                                            <input v-model="form.name" type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
                                                        <div class="mt-2">
                                                            <input v-model="form.quantity" type="number" min="0" name="quantity" id="quantity" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                                        </div>
                                                    </div>
                                                    <fieldset>
                                                        <legend class="text-sm font-medium leading-6 text-gray-900">Type</legend>
                                                        <div class="mt-2 space-y-4">
                                                            <div class="relative flex items-start">
                                                                <div class="absolute flex h-6 items-center">
                                                                    <input v-model="form.type" id="mechanical-part" name="part_type" value="mechanical" aria-describedby="mechanical-part-description" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                                                </div>
                                                                <div class="pl-7 text-sm leading-6">
                                                                    <label for="mechanical-part" class="font-medium text-gray-900">Mechanical Part</label>
                                                                    <p id="mechanical-part-description" class="text-gray-500">Add a mechanical part as the inventory item.</p>
                                                                </div>
                                                            </div>
                                                            <div class="relative flex items-start">
                                                                <div class="absolute flex h-6 items-center">
                                                                    <input v-model="form.type" id="electrical-part" name="part_type" value="electrical" aria-describedby="electrical-part-description" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                                                </div>
                                                                <div class="pl-7 text-sm leading-6">
                                                                    <label for="electrical-part" class="font-medium text-gray-900">Electrical Part</label>
                                                                    <p id="electrical-part-description" class="text-gray-500">Add a electrical part as the inventory item.</p>
                                                                </div>
                                                            </div>
                                                            <div class="relative flex items-start">
                                                                <div class="absolute flex h-6 items-center">
                                                                    <input v-model="form.type" id="raw-material" name="part_type" value="material" aria-describedby="raw-material-description" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                                                </div>
                                                                <div class="pl-7 text-sm leading-6">
                                                                    <label for="raw-material" class="font-medium text-gray-900">Raw Material</label>
                                                                    <p id="raw-material-description" class="text-gray-500">Add raw material as the inventory item.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="pb-6 pt-4">
                                                    <section class="space-y-6" v-show="form.type === 'mechanical'">
                                                        <div>
                                                            <label for="material" class="block text-sm font-medium leading-6 text-gray-900">Material</label>
                                                            <div class="mt-2">
                                                                <input v-model="form.material" type="text" name="material" id="material" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label for="dimensions" class="block text-sm font-medium leading-6 text-gray-900">Dimensions</label>
                                                            <div class="mt-2">
                                                                <input v-model="form.dimensions" type="text" name="dimensions" id="dimensions" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label for="weight" class="block text-sm font-medium leading-6 text-gray-900">Weight</label>
                                                            <div class="mt-2">
                                                                <input v-model="form.weight" type="number" min="0" name="weight" id="weight" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-shrink-0 justify-end px-4 py-4">
                                        <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" @click="$emit('close')">Cancel</button>
                                        <button type="submit" class="ml-4 inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                    </div>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    name: '',
    quantity: 0,
    type: 'mechanical',

    material: '',
    dimensions: '',
    weight: 0,
})

defineProps({open: Boolean})
defineEmits(['close'])
</script>
