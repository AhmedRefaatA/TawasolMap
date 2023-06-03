<template>
    <MainLayout>
        <h1>Tracking</h1>
        <GoogleMaps v-model="vehicles"></GoogleMaps>
    </MainLayout>
</template>
<script setup>
import GoogleMaps from '@/Components/GoogleMaps.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios'

const props = defineProps({
    items:Array,
})
const vehicles = ref([])
onMounted(() => {
    props.items.forEach(vehicle => {
        window.Echo.channel('vehicle-' + vehicle.id)
        .listen('UpdateVehicleLocation', (e) => {
            if(e.vehicle_data.messages != undefined){
                vehicles.value[vehicle.id] = e.vehicle_data.messages[0]
                localStorage.setItem(vehicle.id, JSON.stringify(vehicle))
            }
        });
        setInterval(async () => {
            axios.get('/tracking/' + vehicle.id + '?t=' + Math.floor(Date.now() / 1000),{
                headers: {
                    'api-key': import.meta.env.VITE_API_KEY
                }
            })
        }, 2000);
        
    });
});
</script>