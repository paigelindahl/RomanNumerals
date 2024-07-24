<template>
    <div class="max-w-7xl mx-auto px-4 md:px-6 my-10">
        <h1 class="sr-only">Roman Numeral Date Converter</h1>
        <TabComponent :tabs="['Date to Roman', 'Roman to Date']">
            <template #tab-0>
                <DateConverter></DateConverter>
            </template>
            <template #tab-1>
                <NumeralConverter></NumeralConverter>
            </template>
        </TabComponent>
    </div>
</template>

<script setup>
import TabComponent from "@/Components/tabs/TabComponent.vue";
import DateConverter from "@/Components/roman-converters/DateConverter.vue";
import NumeralConverter from "@/Components/roman-converters/NumeralConverter.vue";

</script>
