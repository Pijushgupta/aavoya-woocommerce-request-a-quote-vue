<template>

    <div class="bg-white border border-t-0 rounded-b-lg min-h-4">
      <div class="container mx-auto md:w-7/12 py-2 px-2 flex flex-col justify-between items-center">
        <Gcaptcha/>
				<BlockList/>
      </div>
    </div>

</template>

<script setup>
import Gcaptcha from './Settings/Gcaptcha';
import BlockList from './Settings/BlockList';
</script>
