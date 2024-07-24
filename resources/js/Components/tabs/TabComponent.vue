<template>
    <div class="tabs">
        <ul class="flex w-full relative list-none">
            <li
                v-for="(tab, index) in tabs"
                :key="index"
                :class="['tab-item flex-1 text-center opacity-50 transition-opacity duration-300 w-full flex justify-center py-3 flex-1 text-center', { active: activeTab === index }]"
            >
                <button class="block p-2 text-xl font-medium text-gray-700" @click="setActiveTab(index)">
                {{ tab }}
                </button>
            </li>
            <div class="absolute -bottom-0.5 left-0 h-0.5 w-1/2 transition-transform duration-300 bg-blue-300" :style="{ transform: `translateX(${activeTab * 100}%)` }"></div>
        </ul>
        <div class="py-3">
            <slot :name="`tab-${activeTab}`"></slot>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  tabs: {
    type: Array,
    required: true,
  },
});

const activeTab = ref(0);

const setActiveTab = (index) => {
  activeTab.value = index;
};
</script>

<style scoped>
.tab-item.active {
  opacity: 1;
}
</style>
