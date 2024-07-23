<template>
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <TabComponent :tabs="['Date to Roman', 'Roman to Date']">
            <template #tab-0>
            <div>
                <DateConverter></DateConverter>
            </div>
            </template>
            <template #tab-1>
            <div>
                <h2>Tab 2 Content</h2>
                <p>This is the content for Tab 2.</p>
            </div>
            </template>
        </TabComponent>
    </div>
</template>

<script setup>
import TabComponent from "@/Components/tabs/TabComponent.vue";
import DateConverter from "@/Components/roman-converters/DateConverter.vue";


</script>
