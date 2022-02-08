<template>
    <Head title="Rezepte" />

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
                        <h2 class="text-2xl font-bold">Rezepte</h2>

                        <ul role="list" class="pt-6 grid grid-cols-1 gap-6 sm:grid-cols-1 lg:grid-cols-2">
                            <li v-for="recipe in recipes" class="col-span-1 rounded-lg shadow-sm border border-gray-100">
                                <div class="py-3">
                                    <h3 class="text-xl px-4 font-semibold">{{ recipe.title }}</h3>
                                    <h4 class="text-lg px-4 text-gray-600 font-extralight -mt-1">{{ recipe.subtitle }}</h4>
                                    <img
                                        class="mt-2 object-cover w-full h-56"
                                        :src="recipe.photo_url"
                                        alt=""
                                    />

                                    <ul class="bg-gray-200 grid grid-cols-1 py-px gap-px sm:grid-cols-3 md:grid-cols-3">
                                        <li class="px-2 text-center bg-gray-50 py-2">
                                            <ClockIcon class="h-5 mx-auto text-gray-500" />
                                            <p class="text-sm sr-only">Kochzeit</p>
                                            <h5 class="font-medium">
                                                {{ recipe.cooking_time }} Minuten
                                            </h5>
                                        </li>
                                        <li class="px-2 text-center bg-gray-50 py-2">
                                            <UsersIcon class="h-5 mx-auto text-gray-500" />
                                            <p class="text-sm sr-only">Portionen</p>
                                            <h5 class="font-medium">
                                                {{ recipe.servings }} Portionen
                                            </h5>
                                        </li>
                                        <li class="px-2 text-center bg-gray-50 py-2">
                                            <FireIcon class="h-5 mx-auto text-gray-500" />
                                            <p class="text-sm sr-only">Kalorien</p>
                                            <h5 class="font-medium">
                                                {{ recipe.total_kcal }} kcal
                                            </h5>
                                        </li>
                                    </ul>

                                    <div class="mx-2 mt-3 flex items-stretch space-x-2">
                                        <Link :href="route('recipes.show', { recipe: recipe.id })" class="block flex-1 text-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                            Rezept ansehen
                                        </Link>
                                        <button type="button" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-brand-700 bg-brand-100 hover:bg-brand-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                            <ShoppingCartIcon class="h-6" />
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Breadcrumbs from "@/Components/Breadcrumbs";
import { ClockIcon, ShoppingCartIcon, UsersIcon, FireIcon } from "@heroicons/vue/outline";

export default {
    props: {
        recipes: {
            required: true,
            type: Array,
        }
    },

    components: {
        Breadcrumbs,
        BreezeAuthenticatedLayout,
        Head,
        ClockIcon,
        ShoppingCartIcon,
        UsersIcon,
        FireIcon,
        Link,
    },

    setup() {
        return {
            pages: [
                { name: 'Rezepte', href: window.route('recipes.index'), current: true },
                // { name: 'Project Nero', href: '#', current: true },
            ]
        }
    }
}
</script>
