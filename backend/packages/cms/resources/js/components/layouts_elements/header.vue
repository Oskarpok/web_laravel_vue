<script setup>
  
</script>
<template>
  <header class="w-full bg-[cms-background-color] p-4 shadow flex items-center 
    justify-between text-gray-200">

    <div class="flex items-center gap-3">
      <i class="fa-solid fa-layer-group text-white text-2xl"></i>
      <h1 class="text-xl font-semibold">UAR CMS</h1>
    </div>

    <div class="flex items-center gap-6">

      <button title="Powiadomienia" class="relative hover:text-white">
        <i class="fa-regular fa-bell text-xl"></i>
        <span class="absolute -top-1 -right-1 bg-red-600 text-xs rounded-full px-1">3</span>
      </button>

      <button title="Ustawienia konta" class="hover:text-white">
        <i class="fa-solid fa-gear text-xl"></i>
      </button>

      <button title="Czat wewnętrzny" class="hover:text-white">
        <i class="fa-solid fa-comments text-xl"></i>
      </button>

      <div class="relative inline-block text-left">

        <button id="userMenuButton" class="w-8 h-8 rounded-full overflow-hidden 
          border border-gray-500 focus:outline-none">
          <img src="https://i.pravatar.cc/40" alt="Avatar" 
            class="w-full h-full object-cover">
        </button>

        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 border 
          border-gray-500 cms-primary-color rounded-md shadow-lg z-50">
          <a href="/profile" class="block px-4 py-2 text-sm text-white 
            hover:text-green-400">
            Ustawienia profilu
          </a>
          <a href="/account/edit" class="block px-4 py-2 text-sm text-white 
            hover:text-green-400">
            Zmień dane
          </a>
        </div>
      </div>
    </div>
  </header>
</template>
