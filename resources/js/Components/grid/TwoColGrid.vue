<template>
<div class="grid grid-cols-12 w-full gap-5">
    <div class="col-span-4 border border-gray-200 bg-white shadow-md rounded-lg p-5">
        <slot name="input-container"></slot>
    </div>
    <div class="col-span-8 border border-gray-200 shadow-md rounded-lg">
        <div class="grid grid-cols-12 rounded-lg gap-y-0.5 h-full">
            <div class="col-span-12 bg-blue-200 rounded-t-lg p-4">
                <h3 class="text-gray-700 text-lg">Result</h3>
            </div>
            <div class="col-span-3 bg-blue-100 p-4">
                <h4 class="text-gray-600">Roman Numerals:</h4>
            </div>
            <div class="col-span-9 bg-blue-50 p-4 text-gray-600"><span v-show="show">{{ romanDate }}</span></div>
            <div class="col-span-3 bg-blue-100 p-4 rounded-bl-lg">
                <h4 class="text-gray-600">Number Date:</h4>
            </div>
            <div class="col-span-9 bg-blue-50 p-4 rounded-br-lg text-gray-600"><span v-show="show">{{ date }}</span></div>
        </div>
    </div>
</div>
</template>

<script setup>
 const props = defineProps({
    date: String,
    romanDate: String,
    show: Boolean,
 })

</script>
