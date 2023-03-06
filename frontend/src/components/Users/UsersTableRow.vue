<script setup lang="ts">
const props = defineProps({
  user: Object,
})
</script>

<template>
  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
      <div>
        <div class="text-base font-semibold">{{ user.name }}</div>
        <div class="font-normal text-gray-500">{{ user.email }}</div>
      </div>
    </th>
    <td class="px-6 py-4">
      {{ user.weather.short }} {{ user.weather.temperature }}
    </td>
    <td class="px-6 py-4">
      <RouterLink :to="{name: 'user-show', params: {id: user.id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        Details
      </RouterLink>
    </td>
  </tr>
</template>