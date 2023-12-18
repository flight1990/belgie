<script setup>

import ModifyModal from "./Components/ModifyModal.vue";
import ImportModal from "./Components/ImportModal.vue";
import DeleteConfirmationModal from "@/Components/DeleteConfirmationModal.vue";

import {router, usePage} from "@inertiajs/vue3";
import {reactive, ref, watch} from "vue";
import {debounce, pickBy} from "lodash";

const props = defineProps({
    towers: Object,
    standards: Object,
    operators: Object,
});

const page = usePage();

const headers = [
    {key: 'standards.name', title: 'Стандарт'},
    {key: 'bsn', title: 'BSN'},
    {key: 'lac', title: 'LAC'},
    {key: 'cell_id', title: 'Cell ID'},
    {key: 'operators.name', title: 'Оператор'},
    {key: 'mnc', title: 'MNC'},
    {key: 'x', title: 'Долгота'},
    {key: 'y', title: 'Широта'},
    {key: 'band', title: 'Band'},
    {key: 'sector', title: 'Sector'},
    {key: 'created_at', title: 'Дата добавления'},
    {key: 'tests_count', title: 'Кол-во тестов'},
    {key: 'actions', title: '', sortable: false},
];

const itemsPerPageOptions = ref([
    {value: 10, title: '10'},
    {value: 25, title: '25'},
    {value: 50, title: '50'},
    {value: 100, title: '100'},
]);

const itemsLength = ref(props.towers?.meta?.total ?? 0);
const items = ref(props.towers?.data ?? []);

const options = reactive({
    page: 1,
    itemsPerPage: 10,
    sortBy: [],
});

const filters = reactive({
    'towers.operator_id': null,
    'towers.standard_id': null,
    'towers.bsn': null,
    'towers.lac': null,
    'towers.cell_id': null,
    'towers.mnc': null,
    'towers.band': null,
    'towers.sector': null,
});

const loading = ref(false);

function updateOptions(params) {

    options.page = params.page;
    options.itemsPerPage = params.itemsPerPage;
    options.sortBy = params.sortBy;

    getItems();
}

watch(filters, () => {
    getItems();
}, {deep: true});

const getItems = debounce(() => {

    const params = {
        ...pickBy(options),
        filters: pickBy(filters),
    }

    router.post('/administration/towers', params, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        only: ['towers'],
        onStart: () => {
            loading.value = true;
        },
        onSuccess: () => {
            items.value = props.towers?.data ?? [];
            itemsLength.value = props.towers.meta?.total ?? 0;
        },
        onFinish: () => {
            loading.value = false;

        }
    })
}, 300);

</script>

<template>
    <h1 class="d-flex align-center justify-space-between">
        <span>Вышки</span>
        <div>
            <import-modal
                v-if="page.props.authUser.permissions.includes('towers.create')"
            />

            <modify-modal
                :operators="operators"
                :standards="standards"
                v-if="page.props.authUser.permissions.includes('towers.create')"
                @save="getItems"
            />
        </div>
    </h1>

    <v-row class="mt-2">
        <v-col cols="12" md="6">
            <v-select
                label="Наименование сети"
                :items="props.operators.data"
                item-title="name"
                item-value="id"
                clearable
                v-model="filters['towers.operator_id']"
            />
        </v-col>
        <v-col cols="12" md="6">
            <v-select
                label="Стандарт"
                :items="props.standards.data"
                item-title="name"
                item-value="id"
                clearable
                v-model="filters['towers.standard_id']"
            />
        </v-col>
    </v-row>
    <v-row>
        <v-col cols="12" md="2">
            <v-text-field
                label="BSN"
                clearable
                v-model="filters['towers.bsn']"
            />
        </v-col>
        <v-col cols="12" md="2">
            <v-text-field
                label="LAC"
                clearable
                v-model="filters['towers.lac']"
            />
        </v-col>
        <v-col cols="12" md="2">
            <v-text-field
                label="Cell ID"
                clearable
                v-model="filters['towers.cell_id']"
            />
        </v-col>
        <v-col cols="12" md="2">
            <v-text-field
                label="MNC"
                clearable
                v-model="filters['towers.mnc']"
            />
        </v-col>
        <v-col cols="12" md="2">
            <v-text-field
                label="Band"
                clearable
                v-model="filters['towers.band']"
            />
        </v-col>
        <v-col cols="12" md="2">
            <v-text-field
                label="Sector"
                clearable
                v-model="filters['towers.sector']"
            />
        </v-col>
    </v-row>

    <v-data-table-server
        :headers="headers"
        :items="items"
        :items-per-page-options="itemsPerPageOptions"
        :items-length="itemsLength"
        :loading="loading"
        loading-text="Загрузка данных с сервера..."
        no-data-text="Нет данных"
        page-text="c {0} по {1} из {2}"
        items-per-page-text="Записей на странице"
        @update:options="updateOptions"
    >
        <template v-slot:item.actions="{ item }">
            <div class="d-flex align-center justify-space-between">
                <modify-modal
                    :operators="operators"
                    :standards="standards"
                    :tower="item"
                    v-if="page.props.authUser.permissions.includes('towers.edit')"
                    @save="getItems"
                />

                <delete-confirmation-modal
                    v-if="page.props.authUser.permissions.includes('towers.destroy')"
                    :url="`/administration/towers/${item.id}`"
                />
            </div>
        </template>

    </v-data-table-server>
</template>
