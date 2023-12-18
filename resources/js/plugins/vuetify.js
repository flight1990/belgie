import {createVuetify} from "vuetify";

import {
    VDataTable,
    VDataTableServer,
} from "vuetify/labs/VDataTable";

import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css';

const vuetify = createVuetify({
    components: {
        VDataTable,
        VDataTableServer,
    },
    ssr: true,
    icons: {
        defaultSet: 'mdi',
    },
    defaults: {
        VTextField: {
            variant: 'underlined',
            density: 'compact',
            color: 'success',
        },
        VSelect: {
            variant: 'underlined',
            density: 'compact',
            color: 'success',
        },
        VDataTable: {
            class: 'text-caption',
            density: 'compact',
        },
        VDataTableServer: {
            class: 'text-caption',
            density: 'compact',
        },
        VCheckbox: {
            density: 'compact',
            hideDetails: true,
            color: 'success',
        },
        VCombobox: {
            variant: 'underlined',
            density: 'compact',
            color: 'success',
            chips: true,
            closableChips: true,
        },
        VBtn: {
            variant: 'tonal',
            color: 'grey-darken-1',
            size: 'small',
            class: 'ma-1',
        },
        VCard: {
            variant: 'flat',
        },
        VCardTitle: {
            class: 'text-h5',
        },
        VList: {
            color: 'success',
            class: 'pa-2'
        },
        VListItem: {
            color: 'success',
            class: 'text-subtitle-1',
        },
        VChip: {
            class: 'ma-2',
            size: 'small',
        },
        VSwitch: {
            color: 'success',
        },
        VLabel: {
            class: 'text-caption',
        }
    }
})

export default vuetify;
