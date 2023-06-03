<template>
    <div id="map" style="height: 80vh"></div>
    <Modal :show="showVehicle" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ vehicleNm }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
              Timestamp : {{ selectedVehicle.t }}
            </p>
            <p class="mt-1 text-sm text-gray-600">
              speed : {{ selectedVehicle.pos.s }}
            </p>
            <p class="mt-1 text-sm text-gray-600">
              Satellites count : {{ selectedVehicle.pos.sc }}
            </p>
            <p class="mt-1 text-sm text-gray-600">
              Altitude : {{ selectedVehicle.pos.z }}
            </p>
            <p class="mt-1 text-sm text-gray-600">
              Course : {{ selectedVehicle.pos.c }}
            </p>
            <div class="mt-6 flex justify-end">
                <button @click="closeModal"> Cancel </button>
            </div>
        </div>
    </Modal>
</template>
  
  <script setup>
import { onMounted, watch, ref } from 'vue';
import { Loader } from "@googlemaps/js-api-loader";
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    modelValue: {
      required: true,
      type: Array
    },
})

const showVehicle = ref(false)
const vehicles = props.modelValue
const vehicleNm = ref('')
const selectedVehicle = ref()
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
      vehicles.forEach((location, vehicleId) => {
        const position = new google.maps.LatLng(location.pos.y, location.pos.x);
        const marker = new google.maps.Marker({
          map: map.value,
          position: position,
          icon: '/storage/map_marker.png',
          label: JSON.parse(localStorage.getItem(vehicleId)).nm
        });
        markers.value.push(marker);
        map.value.setCenter(position);
        marker.addListener('click', () => {
          vehicleNm.value = JSON.parse(localStorage.getItem(vehicleId)).nm
          selectedVehicle.value = location
          showVehicle.value = true
        });
      });
    });
  }
  
  )
  
  
});

const closeModal = () => {
    showVehicle.value = false;
};
</script>