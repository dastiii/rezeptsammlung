<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <div class="pt-6">
            <div class="max-w-7xl mx-auto sm:px-8 lg:px-10">
                <Breadcrumbs :pages="pages" />
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
    components: {
        Breadcrumbs,
        BreezeAuthenticatedLayout,
        Head,
    },

    setup() {
        return {
            pages: [
                // { name: 'Projects', href: '#', current: false },
                // { name: 'Project Nero', href: '#', current: true },
            ]
        }
    }
}
</script>
