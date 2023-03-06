<script setup lang="ts">
import { useRoute } from 'vue-router'
import { useUserStore } from "@/stores/user";
import { storeToRefs } from "pinia";
import UsersWeatherCard from "@/components/Users/UsersWeatherCard.vue";

const route = useRoute()
const store = useUserStore()
const { user, loading, error } = storeToRefs(store)

store.find(Number(route.params.id))

window.Echo.channel('weather').listen('.WeatherReportUpdated', (e) => {
  if (store.user.id !== e.model.user_id) {
    return
  }

  store.user.weather = e.model
});
</script>

<template>
  <main>
    <div class="relative max-w-lg mx-auto">
      <p v-if="loading">Loading user...</p>
      <UsersWeatherCard v-if="user" :user="user" />
    </div>
  </main>
</template>
