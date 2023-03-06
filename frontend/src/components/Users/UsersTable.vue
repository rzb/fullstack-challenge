<script setup lang="ts">
import UsersTableRow from "@/components/Users/UsersTableRow.vue";

const props = defineProps({
  users: [Object],
})
</script>

<template>
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="hidden text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">
          Name
        </th>
        <th scope="col" class="px-6 py-3">
          Weather
        </th>
        <th scope="col" class="px-6 py-3">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <UsersTableRow v-for="user in users" :key="user.id" :user="user" />
    </tbody>
  </table>
</template>