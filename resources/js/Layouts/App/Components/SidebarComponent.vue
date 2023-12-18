<script setup>
    import {usePage} from "@inertiajs/vue3";
    import {ref} from "vue";

    const page = usePage();
    const open = ref(page.props.menu.data.filter((item) => item.isActive).map((item) => item.nickname));
</script>

<template>
    <v-list open-strategy="single" dense v-model:opened="open">
        <template v-for="item in $page.props.menu.data">
            <template v-if="item.children.length && item.disableActivationByURL">
                <v-list-group no-action :active="item.isActive" :value="item.nickname">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            :title="item.name"
                            :active="item.isActive"
                        ></v-list-item>
                    </template>

                    <inertia-link
                        v-for="item in item.children"
                        :key="item.id"
                        :href="item.url" as="v-btn"
                    >
                        <v-list-item :value="item.id" :active="item.isActive">
                            {{ item.name }}
                        </v-list-item>
                    </inertia-link>
                </v-list-group>
            </template>

            <template v-if="!item.children.length && !item.disableActivationByURL">
                <inertia-link
                    :key="item.id"
                    :href="item.url"
                    as="v-btn"
                >
                    <v-list-item
                        :value="item.id"
                        :active="item.isActive"
                    >
                        {{ item.name }}
                    </v-list-item>
                </inertia-link>
            </template>
        </template>
    </v-list>
</template>
