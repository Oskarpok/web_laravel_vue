<script setup>
  import Footer from "./components/layouts_elements/footer.vue";
  import Header from "./components/layouts_elements/header.vue";
  import Nav from "./components/layouts_elements/nav.vue";
</script>

<template>
  <div class="flex">
    <Nav />
    <div class="flex flex-col flex-1">
      <Header />
      <main class="flex-1 mx-4">
        <!-- ruuter for spa -->
      </main>
    </div>
	</div>
  <Footer />
</template>
