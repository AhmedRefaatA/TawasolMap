<template>
    <div id="map" style="height: 80vh"></div>
</template>
  
  <script setup>
import { onMounted, watch, ref } from 'vue';
import { Loader } from "@googlemaps/js-api-loader";

const props = defineProps({
    modelValue: {
      required: true,
      type: Array
    },
})
const vehicles = props.modelValue

const map = ref(null);
const markers = ref([]);

onMounted(() => {
  const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
  });

    loader.load().then(() => {
    map.value = new google.maps.Map(document.getElementById('map'), {
      center: { lat: 0, lng: 0 },
      zoom: 12,
    });
    watch(vehicles, ()=>{
      vehicles.forEach(location => {
        const position = new google.maps.LatLng(location.pos.y, location.pos.x);
        const marker = new google.maps.Marker({
          map: map.value,
          position: position,
          icon: '/storage/map_marker.png',
        });
        marker.set('vehicleId', 10);
        markers.value.push(marker);
        map.value.setCenter(position);
        marker.addListener('click', () => {
          // Handle the click event here
          console.log('Marker clicked', location);
        });
      });
    });
  }
  
  )
  

  

  
});
</script>