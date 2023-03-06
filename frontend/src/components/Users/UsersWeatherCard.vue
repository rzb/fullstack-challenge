<script setup lang="ts">
import { inject } from 'vue'
const dayJS = inject("dayJS")

const props = defineProps({
  user: Object,
})
</script>

<template>
  <div class="flex items-center justify-center">
    <div class="flex flex-col bg-white rounded p-4 w-full max-w-xs">
      <div class="font-bold text-xl">{{ user.name }}</div>
      <div class="text-sm text-gray-500">{{ dayJS(user.weather.measured_at) }}</div>
      <div class="mt-6 text-6xl self-center inline-flex items-center justify-center rounded-lg text-indigo-400 h-24 w-24">
        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
      </div>
      <div class="flex flex-col items-center ml-6 mb-3">
        <div>{{ user.weather.full }}</div>
      </div>
      <div class="font-medium text-center text-6xl mb-3">{{ user.weather.temperature }}° F</div>
      <div class="text-gray-500 text-center">Feels like <span class="font-medium">{{ user.weather.perception }}° F</span></div>
      <div class="flex flex-row justify-between mt-6">
        <div class="flex flex-col items-center">
          <div class="font-medium text-sm">Wind</div>
          <div class="text-sm text-gray-500">{{ user.weather.wind }}mph</div>
        </div>
        <div class="flex flex-col items-center">
          <div class="font-medium text-sm">Humidity</div>
          <div class="text-sm text-gray-500">{{ user.weather.humidity }}%</div>
        </div>
        <div class="flex flex-col items-center">
          <div class="font-medium text-sm">Pressure</div>
          <div class="text-sm text-gray-500">{{ user.weather.pressure }}hPa</div>
        </div>
      </div>
    </div>
  </div>
</template>