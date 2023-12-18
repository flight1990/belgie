<script setup>
import AuthUserComponent from "@/Layouts/App/Components/AuthUserComponent.vue";
import SidebarComponent from "@/Layouts/App/Components/SidebarComponent.vue";
import CrumbsComponent from "@/Layouts/App/Components/CrumbsComponent.vue";
import FlashMessagesComponent from "./Components/FlashMessagesComponent.vue";
import {ref} from "vue";

const drawer = ref(null);

</script>

<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" color="grey-lighten-5" :width="300">

            <AuthUserComponent/>
            <SidebarComponent/>

        </v-navigation-drawer>

        <v-app-bar elevation="0">
            <v-btn icon fab @click="drawer = !drawer">
                <v-icon v-if="drawer">mdi-backburger</v-icon>
                <v-icon v-else>mdi-forwardburger</v-icon>
                <v-tooltip
                    activator="parent"
                    location="bottom"
                    :text="drawer ? 'Закрыть меню' : 'Открыть меню'"
                />
            </v-btn>
            <v-toolbar-title>{{ $page.props.appName }}</v-toolbar-title>
        </v-app-bar>

        <v-main>
            <v-container fluid>

                <FlashMessagesComponent/>
                <CrumbsComponent/>
                <slot></slot>

            </v-container>
        </v-main>
    </v-app>
</template>
