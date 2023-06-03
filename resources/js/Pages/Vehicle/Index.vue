<template>
    <MainLayout>
        <h1>Tracking</h1>
        <GoogleMaps></GoogleMaps>
    </MainLayout>
</template>
<script setup>
import GoogleMaps from '@/Components/GoogleMaps.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted, ref } from 'vue';

const props = defineProps({
    items:Array,
})

onMounted(() => {
    props.items.forEach(vehicle => {
        window.Echo.channel('vehicle-' + vehicle)
        .listen('UpdateVehicleLocation', (e) => {
            console.log(e)
        });
    });
});
</script>