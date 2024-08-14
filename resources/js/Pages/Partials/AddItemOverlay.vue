<template>
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="$emit('close')">
            <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                        <TransitionChild @after-enter="autofocus" as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="pointer-events-auto w-screen max-w-md">
                                <form @submit.prevent="submit" class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                                    <div class="h-0 flex-1 overflow-y-auto">
                                        <div class="bg-primary-700 px-4 py-6 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle class="text-base font-semibold leading-6 text-white">New Inventory Item</DialogTitle>
                                                <div class="ml-3 flex h-7 items-center">
                                                    <button :disabled="form.processing" type="button" class="relative rounded-md bg-primary-700 text-primary-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" @click="$emit('close')">
                                                        <span class="absolute -inset-2.5" />
                                                        <span class="sr-only">Close panel</span>
                                                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <p class="text-sm text-primary-300">Get started by filling in the information below to create your new item.</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-1 flex-col justify-between">
                                            <div class="divide-y divide-gray-200 px-4 sm:px-6">
                                                <div class="space-y-6 pb-5 pt-6">
                                                    <div>
                                                        <InputLabel for="name" value="Name" />

                                                        <TextInput
                                                            :disabled="form.processing"
                                                            id="name"
                                                            type="text"
                                                            class="mt-1 block w-full"
                                                            v-model="form.name"
                                                            required
                                                            ref="nameInput"
                                                        />

                                                        <InputError class="mt-2" :message="form.errors.name" />
                                                    </div>
                                                    <div>
                                                        <InputLabel for="quantity" value="Quantity" />

                                                        <TextInput
                                                            :disabled="form.processing"
                                                            id="quantity"
                                                            type="number"
                                                            min="0"
                                                            class="mt-1 block w-full"
                                                            v-model="form.quantity"
                                                            required
                                                        />

                                                        <InputError class="mt-2" :message="form.errors.quantity" />
                                                    </div>
                                                    <fieldset :disabled="itemId" :class="{'opacity-75': itemId}">
                                                        <legend class="text-sm font-medium leading-6 text-gray-900">Type</legend>
                                                        <div class="mt-2 space-y-4">
                                                            <div class="relative flex items-start">
                                                                <div class="absolute flex h-6 items-center">
                                                                    <input v-model="form.part_type" id="mechanical-part" name="part_type" value="mechanical" aria-describedby="mechanical-part-description" type="radio" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-600" />
                                                                </div>
                                                                <div class="pl-7 text-sm leading-6">
                                                                    <label for="mechanical-part" class="font-medium text-gray-900">Mechanical Part</label>
                                                                    <p id="mechanical-part-description" class="text-gray-500">Add a mechanical part as the inventory item.</p>
                                                                </div>
                                                            </div>
                                                            <div class="relative flex items-start">
                                                                <div class="absolute flex h-6 items-center">
                                                                    <input v-model="form.part_type" id="electrical-part" name="part_type" value="electrical" aria-describedby="electrical-part-description" type="radio" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-600" />
                                                                </div>
                                                                <div class="pl-7 text-sm leading-6">
                                                                    <label for="electrical-part" class="font-medium text-gray-900">Electrical Part</label>
                                                                    <p id="electrical-part-description" class="text-gray-500">Add a electrical part as the inventory item.</p>
                                                                </div>
                                                            </div>
                                                            <div class="relative flex items-start">
                                                                <div class="absolute flex h-6 items-center">
                                                                    <input v-model="form.part_type" id="raw-material" name="part_type" value="material" aria-describedby="raw-material-description" type="radio" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-600" />
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
                                                    <section class="space-y-6" v-show="form.part_type === 'mechanical'">
                                                        <div>
                                                            <InputLabel for="material" value="Material" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="material"
                                                                type="text"
                                                                class="mt-1 block w-full"
                                                                v-model="form.material"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.material" />
                                                        </div>
                                                        <div>
                                                            <InputLabel for="dimensions" value="Dimensions" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="dimensions"
                                                                type="text"
                                                                class="mt-1 block w-full"
                                                                v-model="form.dimensions"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.dimensions" />
                                                        </div>
                                                        <div>
                                                            <InputLabel for="weight" value="Weight" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="dimensions"
                                                                type="number"
                                                                min="0"
                                                                class="mt-1 block w-full"
                                                                v-model="form.weight"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.weight" />
                                                        </div>
                                                    </section>
                                                    <section class="space-y-6" v-show="form.part_type === 'electrical'">
                                                        <div>
                                                            <InputLabel for="voltage" value="Voltage" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="voltage"
                                                                type="number"
                                                                min="0"
                                                                class="mt-1 block w-full"
                                                                v-model="form.voltage"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.voltage" />
                                                        </div>
                                                        <div>
                                                            <InputLabel for="current" value="Current" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="current"
                                                                type="number"
                                                                min="0"
                                                                class="mt-1 block w-full"
                                                                v-model="form.current"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.current" />
                                                        </div>
                                                        <div>
                                                            <InputLabel for="powerRating" value="Power Rating" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="powerRating"
                                                                type="number"
                                                                min="0"
                                                                class="mt-1 block w-full"
                                                                v-model="form.power_rating"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.power_rating" />
                                                        </div>
                                                    </section>
                                                    <section class="space-y-6" v-show="form.part_type === 'material'">
                                                        <div>
                                                            <InputLabel for="type" value="Type" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="type"
                                                                type="text"
                                                                class="mt-1 block w-full"
                                                                v-model="form.type"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.type" />
                                                        </div>
                                                        <div>
                                                            <InputLabel for="purity" value="Purity" />

                                                            <TextInput
                                                                :disabled="form.processing"
                                                                id="purity"
                                                                type="number"
                                                                min="0"
                                                                class="mt-1 block w-full"
                                                                v-model="form.purity"
                                                            />

                                                            <InputError class="mt-2" :message="form.errors.purity" />
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-shrink-0 justify-end px-4 py-4 gap-x-4">
                                        <SecondaryButton :disabled="form.processing" type="button" @click="$emit('close')">Cancel</SecondaryButton>
                                        <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
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
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const itemId = ref(null)

const form = useForm({
    name: '',
    quantity: 0,
    part_type: 'mechanical',

    material: '',
    dimensions: '',
    weight: 0,

    type: '',
    purity: 0,

    voltage: 0,
    current: 0,
    power_rating: 0,

    _method: 'POST'
})

const nameInput = ref(null)
function autofocus() {
    nameInput.value.focus()
}

function submit() {
    if(itemId.value) {
        form._method = 'PUT'
        form.post(route('inventoryItems.update', {inventoryItem: itemId.value}), {
            onSuccess: () => {
                form.reset()
                emit('close')
            },
        })
    } else {
        form._method = 'POST'
        form.post(route('inventoryItems.store'), {
            onSuccess: () => {
                form.reset()
                emit('close')
            },
        })
    }
}

const props = defineProps({open: Boolean})
const emit = defineEmits(['close'])

defineExpose({
    editItem(item) {
        itemId.value = item.id
        Object.assign(form, item)
    },
    createItem() {
        itemId.value = null
        form.reset()
    }
})
</script>
