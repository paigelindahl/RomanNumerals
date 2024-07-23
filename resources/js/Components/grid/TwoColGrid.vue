<template>
<div class="grid grid-cols-12 w-full gap-5">
    <div class="col-span-4 border border-gray-200 shadow-sm rounded-lg p-5">
        <slot name="input-container"></slot>
    </div>
    <div class="col-span-8 border border-gray-200 shadow-sm rounded-lg">
        <div class="grid grid-cols-12 rounded-lg gap-y-0.5">
            <div class="col-span-12 bg-blue-200 rounded-t-lg p-4">
                <h3 class="text-blue-900 text-lg">Result</h3>
            </div>
            <div class="col-span-3 bg-blue-100 p-4">
                <h4 class="text-gray-600">Roman Numerals:</h4>
            </div>
            <div class="col-span-9 bg-blue-50 p-4 text-gray-600">{{ romanDate }}</div>
            <div class="col-span-3 bg-blue-100 p-4 rounded-bl-lg">
                <h4 class="text-gray-600">Number Date:</h4>
            </div>
            <div class="col-span-9 bg-blue-50 p-4 rounded-br-lg text-gray-600">{{ formattedDate }}</div>
        </div>
    </div>
</div>
</template>

<script setup>
 const props = defineProps({
    formattedDate: String,
    romanDate: String,
 })

</script>
