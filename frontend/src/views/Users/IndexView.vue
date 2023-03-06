<script setup lang="ts">
import { useUserStore } from "@/stores/user";
import { storeToRefs } from "pinia";
import UsersTable from "@/components/Users/UsersTable.vue";
import { TailwindPagination } from 'laravel-vue-pagination';

const store = useUserStore()
const { users, loading, error } = storeToRefs(store)

store.fill()
</script>

<template>
  <main>
    <div class="relative overflow-x-auto max-w-lg mx-auto">
      <p v-if="loading">Loading users...</p>
      <p v-if="error">{{ error.message }}</p>
      <div v-if="users" class="text-center">
        <UsersTable :users="users.data" class="mb-3" />
        <TailwindPagination :data="users" @pagination-change-page="store.fill" />
      </div>
    </div>
  </main>
</template>
