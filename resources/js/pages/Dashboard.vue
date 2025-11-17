<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { PlusIcon, } from 'lucide-vue-next'
import { InputGroup, InputGroupAddon, InputGroupButton } from '@/components/ui/input-group/index';
import { store } from '@/routes/notes';
import { LoaderCircle } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const handleTextareaKeydown = (event: KeyboardEvent) => {
    if (event.key === 'Enter' && ! event.shiftKey) {
        event.preventDefault();
        const form = (event.target as HTMLTextAreaElement).closest('form') as HTMLFormElement;
        form?.requestSubmit();
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
            >
                <div class="p-4">
                    <div class="w-96 mx-auto">
                        <Form
                            v-bind="store.form()"
                            v-slot="{ processing }"
                            :reset-on-success="['title', 'description']"
                            class="flex flex-col gap-6"
                        >
                            <InputGroup>
                                <input 
                                    data-slot="input-group-control"
                                    placeholder="Title"
                                    class="flex w-full rounded-md bg-transparent px-3 py-2.5 text-base transition-[color,box-shadow] outline-none md:text-sm"
                                    name="title"
                                />
                                <textarea
                                    data-slot="input-group-control"
                                    class="flex field-sizing-content min-h-8 max-h-52 w-full resize-none rounded-md bg-transparent px-3 py-2.5 text-base transition-[color,box-shadow] outline-none md:text-sm"
                                    placeholder="Create a note..."
                                    name="description"
                                    @keydown="handleTextareaKeydown"
                                />
                                <InputGroupAddon align="block-end">
                                    <InputGroupButton
                                        type="submit"
                                        variant="default"
                                        class="rounded-full ml-auto"
                                        size="icon-xs"
                                        :disabled="processing"
                                    >
                                        <LoaderCircle
                                            v-if="processing"
                                            class="h-4 w-4 animate-spin"
                                        />
                                        <div v-if="! processing">
                                            <PlusIcon class="size-4" />
                                            <span class="sr-only">Send</span>
                                        </div>
                                    </InputGroupButton>
                                </InputGroupAddon>
                            </InputGroup>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
