<template>
  <div  class="mx-auto md:w-7/12 px-4 py-4">
    <div class="flex flex-row justify-between items-center py-6 px-4 mb-3.5 bg-gray-50 rounded-lg">
      <label class="font-medium" >Enable/Disable</label>

      <input  type="checkbox" />
    </div>

    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Sent to Email. </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">From name. </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">From Email </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Reply to Email. </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Subject </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">

      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Message</label>
        <button  class=" "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg></button>

      </div>
      
    </div>
  </div>
  <div class=" bg-gray-50">
    <div class=" mx-auto md:w-7/12 flex flex-row justify-end px-4 py-2">
      <button class="px-6 py-2 rounded-full border bg-white" @click="">Save</button>
    </div>
  </div>
</template>