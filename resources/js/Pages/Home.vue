<template>
    <div style="height: 100vh; width: 100vw;">
        <l-map
            v-model="zoom"
            v-model:zoom="zoom"
            :center="[-7.250445, 112.768845]"
            @move="log('move')"
        >
            <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            ></l-tile-layer>
            <l-control-layers />
            <l-geo-json v-for="(json, idx) in geojson.features" :key="idx" :geojson="json" :options="styleGeoJSON(json)"></l-geo-json>
        </l-map>
    </div>
</template>

<script>
import {
    LMap,
    LTileLayer,
    LControlLayers,
    LGeoJson,
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";
import { ref } from 'vue';
import jawaTimur from "../../data/IDN_adm_2_kabkota.json"

export default {
    props: ['disasters'],
    components: {
        LMap,
        LTileLayer,
        LControlLayers,
        LGeoJson,
    },
    data() {
        return {
            zoom: ref(10),
            iconWidth: 25,
            iconHeight: 40,
            geojson: null,
        };
    },
    created() {
        this.geojson = jawaTimur;
    },
    computed: {
        iconUrl() {
            return `https://placekitten.com/${this.iconWidth}/${this.iconHeight}`;
        },
        iconSize() {
            return [this.iconWidth, this.iconHeight];
        },
    },
    methods: {
        log(a) {
            console.log(a);
        },
        changeIcon() {
            this.iconWidth += 2;
            if (this.iconWidth > this.iconHeight) {
                this.iconWidth = Math.floor(this.iconHeight / 2);
            }
        },
        syncDatabase(geo, type_id, year) {
            return this.disasters.filter(
                disaster => disaster.region_id === geo.properties.ID_2
                    && disaster.type_id === type_id
                    && disaster.year === year
            );
        },
        getColor(d) {
            return d > 35 ? '#800026' :
                d > 30  ? '#BD0026' :
                    d > 25  ? '#E31A1C' :
                        d > 20  ? '#FC4E2A' :
                            d > 15   ? '#FD8D3C' :
                                d > 10   ? '#FEB24C' :
                                    d > 5   ? '#FED976' :
                                        '#FFEDA0';
        },
        styleGeoJSON(feature) {
            const disaster = this.syncDatabase(feature, 1, 2021)
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

