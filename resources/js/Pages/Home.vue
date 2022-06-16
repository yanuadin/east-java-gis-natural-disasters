<template>
    <!-- Start Filter -->
    <div class="filter-position sm:flex">
        <Listbox as="div" v-model="form.type" class="sm:flex-auto sm:mr-3 sm:w-60">
            <div class="mt-1 relative">
                <ListboxButton class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <span class="block truncate">{{ form.type.name }}</span>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </span>
                </ListboxButton>

                <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                        <ListboxOption as="template" v-for="type in types" :key="type.id" :value="type" v-slot="{ active, selected }">
                            <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                                    {{ type.name }}
                                </span>

                                <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>

        <Listbox as="div" v-model="form.year" class="sm:flex-auto sm:w-60">
            <div class="mt-1 relative">
                <ListboxButton class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <span class="block truncate">{{ form.year.value }}</span>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </span>
                </ListboxButton>

                <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                        <ListboxOption as="template" v-for="(year, idx) in years" :key="idx" :value="year" v-slot="{ active, selected }">
                            <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                                    {{ year.value }}
                                </span>

                                <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>
    </div>
    <!-- End Filter -->

    <!-- Start Maps -->
    <div style="height: 100vh; width: 100vw;">
        <l-map
            id="leaflet-map"
            ref="jatimMaps"
            v-model="zoom"
            v-model:zoom="zoom"
            :center="[-7.250445, 112.768845]"
        >
            <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            ></l-tile-layer>
            <l-control-layers />
            <l-geo-json ref="gjs" v-for="(json, idx) in geojson.features" :key="idx" :geojson="json" :options="styleGeoJSON(json)">
                <l-tooltip>
                    <p><strong>{{ json.properties.NAME_2 }}</strong></p>
                    <template v-for="(data, idx) in tooltipData(json)" :key="idx">
                        <p><strong>{{ data.year }} : </strong>{{ data.amount }}</p>
                    </template>
                </l-tooltip>
            </l-geo-json>
        </l-map>
    </div>
    <!-- End Maps -->
</template>

<script>
import {
    LMap,
    LTileLayer,
    LControlLayers,
    LGeoJson,
    LTooltip
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import { ref } from 'vue';
import jawaTimur from "../../data/IDN_adm_2_kabkota.json"
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
import {Inertia} from "@inertiajs/inertia";

export default {
    props: ['disasters', 'types', 'selected_type', 'selected_year'],
    components: {
        LMap,
        LTileLayer,
        LControlLayers,
        LGeoJson,
        LTooltip,
        Listbox,
        ListboxButton,
        ListboxLabel,
        ListboxOption,
        ListboxOptions,
        CheckIcon,
        SelectorIcon
    },
    watch: {
        form: {
            handler(newValue, oldValue) {
                this.$inertia.visit(route('home.index'), {
                    method: 'get',
                    data: {
                        selected_type_id: this.form.type.id,
                        selected_year_id: this.form.year.id,
                    }
                })
            },
            deep: true
        }
    },
    data() {
        return {
            zoom: ref(9),
            iconWidth: 25,
            iconHeight: 40,
            geojson: null,
            form: {
                type: this.selected_type,
                year: JSON.parse(this.selected_year),
            },
            years: [
                { id: 1, value: 2019 },
                { id: 2, value: 2020 },
                { id: 3, value: 2021 },
            ],
        };
    },
    created() {
        this.geojson = jawaTimur;
    },
    methods: {
        tooltipData(geo){
            return this.disasters.filter(
                disaster => disaster.region_id === geo.properties.ID_2
                    && disaster.type_id === this.form.type.id
            );
        },
        syncDatabase(geo, type_id, year) {
            return this.disasters.filter(
                disaster => disaster.region_id === geo.properties.ID_2
                    && disaster.type_id === type_id
                    && disaster.year === year
            );
        },
        getColor(d) {
            return d > 25 ? '#8b0000' :
                d > 15  ? '#ff0000' :
                    d > 10  ? '#ffa500' :
                        d > 5  ? '#ffff00' :
                            '#ffde80';
        },
        styleGeoJSON(feature) {
            const disaster = this.syncDatabase(feature, this.form.type.id, this.form.year.value)
            return {
                fillColor: this.getColor(disaster[0].amount),
                weight: 2,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7
            };
        }
    },
};
</script>

