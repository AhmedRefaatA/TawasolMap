<template>
    <div id="map" style="height: 80vh"></div>
  </template>
  
  <script setup>
import { onMounted } from 'vue';
import { Loader } from "@googlemaps/js-api-loader";

onMounted(() => {
  const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
  });

  const locations = [
    { lat: 24.7764483, lng: 46.6397916 },
    { lat: 24.77689, lng: 46.6396099 },
    { lat: 24.7828083, lng: 46.63773 },
  ];

  

  loader.load().then(() => {
    const map = new google.maps.Map(document.getElementById('map'), {
      center: { lat: 24.7764483, lng: 46.6397916 },
      zoom: 12,
    });
    const customMarkerIcon = {
      url: '/storage/map_marker.png',
      size: new google.maps.Size(64, 64), // The size of the image file
      origin: new google.maps.Point(0, 0), // The origin point of the image
      anchor: new google.maps.Point(16, 32), // The anchor point to position the image
    };
    // Create markers for each location
    locations.forEach(location => {
      new google.maps.Marker({
        position: location,
        map: map,
        icon: customMarkerIcon,
      });
    });
  });
});
</script>