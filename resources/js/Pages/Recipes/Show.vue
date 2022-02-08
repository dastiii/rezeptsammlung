<template>
    <Head :title="fullName" />

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
                        <h2 class="text-3xl font-bold">{{ recipe.title }}</h2>
                        <h3 class="text-3xl font-thin">{{ recipe.subtitle }}</h3>

                        <img :src="recipe.photo_url" class="h-64 object-cover w-full rounded-lg my-4" alt="">

                        <div class="grid gap-4 grid-cols-1 lg:grid-cols-3">
                            <div class="lg:col-span-1 bg-gray-50 px-3 py-4 rounded-lg">
                                <h4 class="text-2xl font-bold text-gray-800">Zutaten</h4>

                                <ul role="list" class="divide-y divide-gray-200">
                                    <li v-for="ingredient in recipe.ingredients" :key="ingredient.id" class="py-4 flex">
                                        <img class="h-10 w-10 rounded-full" :src="ingredient.photo_url" alt="" />
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ ingredient.name }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ `${ingredient.pivot.amount} ${ingredient.pivot.unit}` }}
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="lg:col-span-2">
                                <h4 class="text-2xl font-bold text-gray-800">Zubereitung</h4>

                                <div class="my-6 space-y-8">
                                    <div v-for="step in recipe.steps" :key="step.id">
                                        <div class="flex space-x-4 items-center">
                                            <div class="rounded-full h-10 w-10 bg-brand-400 text-brand-50 font-black flex items-center justify-around">
                                                {{ step.sort_order}}
                                            </div>
                                            <h5 class="text-xl font-medium">{{ step.title }}</h5>
                                        </div>

                                        <div class="my-2 md:ml-4 flex flex-col md:flex-row items-start md:space-x-4">
                                            <div class="w-full md:w-1/4">
                                                <img class="h-32 w-full object-cover rounded-lg" :src="step.photo_url" alt="">
                                            </div>
                                            <div class="my-2 lg:my-0 md:flex-1">
                                                <p class="prose" v-html="step.text"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="similar_recipes" class="p-6 bg-white border-b border-gray-200">
                        <h4 class="text-2xl font-bold text-gray-800">Rezepte mit übereinstimmenden Zutaten</h4>

                        <ul class="pt-4 grid gap-8 grid-cols-1 lg:grid-cols-2">
                            <li v-for="similarRecipe in similar_recipes" :key="similarRecipe.recipe.id">
                                <div class="flex items-center justify-between">
                                   <div>
                                       <h5 class="text-lg font-medium">{{ similarRecipe.recipe.title }}</h5>
                                       <h6 class="text-sm font-light">{{ similarRecipe.recipe.subtitle }}</h6>
                                   </div>

                                    <div class="flex items-center space-x-1">
                                        <Link :href="route('recipes.show', { recipe: similarRecipe.recipe.id })" class="block px-4 py-2 border border-transparent text-base font-medium rounded-md text-brand-700 bg-brand-100 hover:bg-brand-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                            <EyeIcon class="h-6" />
                                        </Link>
                                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-brand-700 bg-brand-100 hover:bg-brand-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                            <ShoppingCartIcon class="h-6" />
                                        </button>
                                    </div>
                                </div>

                                <img class="mt-2 h-32 object-cover w-full rounded-lg" :src="similarRecipe.recipe.photo_url" alt="">

                                <h6 class="py-2 px-2">
                                    {{ similarRecipe.recipe.ingredients_in_common_count }} gleiche Zutaten gefunden:
                                </h6>
                                <div class="grid gap-1 grid-cols-3">
                                    <div
                                        v-for="ingredient in similarRecipe.ingredients_in_common"
                                        class="flex items-center space-x-2 px-2.5 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-800"
                                    >
                                        <img :src="ingredient.photo_url" class="h-6 w-6 rounded-full" alt="">
                                        <span>{{ ingredient.name }}</span>
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
import { ClockIcon, ShoppingCartIcon, UsersIcon, FireIcon, EyeIcon } from "@heroicons/vue/outline";
import {computed} from "vue";

export default {
    props: {
        recipe: {
            required: true,
            type: Object,
        },

        similar_recipes: {
            type: Array,
        },
    },

    components: {
        Breadcrumbs,
        BreezeAuthenticatedLayout,
        Head,
        ClockIcon,
        ShoppingCartIcon,
        UsersIcon,
        FireIcon,
        EyeIcon,
        Link
    },

    setup(props) {
        const fullName = computed(() => `${props.recipe.title} ${props.recipe.subtitle}`);

        return {
            pages: [
                { name: 'Rezepte', href: window.route('recipes.index'), current: false },
                { name: fullName.value, href: '#', current: true },
            ],
            fullName,
        }
    }
}
</script>
