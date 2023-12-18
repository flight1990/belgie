<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    roles: Object,
    userRoles: Array,
});

const form = useForm({
    name: props.user?.name ?? '',
    email: props.user?.email ?? '',
    password: '',
    password_confirmation: '',
    roles: props.userRoles ?? [],
});

function save() {
    props.user ? form.patch(`/users/${props.user.id}`) : form.post('/users');
}

</script>

<template>
    <h1>{{ user ? 'Редактирование' : 'Создание' }}</h1>

    <form class="my-5">
        <v-text-field
            label="Ф.И.О"
            v-model="form.name"
            :error-messages="form.errors.name"
        />

        <v-text-field
            label="Email"
            v-model="form.email"
            :error-messages="form.errors.email"
        />

        <v-text-field
            type="password"
            label="Пароль"
            v-model="form.password"
            :error-messages="form.errors.password"
        />

        <v-text-field
            type="password"
            label="Подтверждение пароля"
            v-model="form.password_confirmation"
            :error-messages="form.errors.password_confirmation"
        />

        <div v-if="roles.data?.length">
            <v-combobox
                label="Роли"
                :return-object="false"
                :items="roles.data"
                item-value="id"
                item-title="name"
                multiple
                v-model="form.roles"
            />
        </div>
    </form>

    <div class="d-flex align-center justify-center justify-md-end">
        <v-btn color="success" @click.prevent="save">Сохранить</v-btn>
    </div>
</template>

