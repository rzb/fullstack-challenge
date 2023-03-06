<script setup lang="ts">
import Header from "@/components/Header.vue";
</script>

<template>
	<div class="wrapper">
    <Header />
		<RouterView class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-12" />
	</div>
</template>
