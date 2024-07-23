<template>
    <div class="tabs">
        <ul class="tab-list flex w-full relative list-none">
            <li
                v-for="(tab, index) in tabs"
                :key="index"
                :class="['tab-item w-full flex justify-center py-3 flex-1 text-center', { active: activeTab === index }]"
            >
                <button class="tab-trigger" @click="setActiveTab(index)">
                {{ tab }}
                </button>
            </li>
            <div class="tab-underline" :style="{ transform: `translateX(${activeTab * 100}%)` }"></div>
        </ul>
        <div class="tab-content">
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

<style>
.tab-list {
    border-bottom: 2px solid #e5e7eb;
}

.tab-item {
  flex: 1;
  text-align: center;
  transition: opacity 0.3s;
  opacity: 0.5;
}

.tab-item.active {
  opacity: 1;
}

.tab-trigger {
  display: block;
  padding: 10px;
  border: none;
  background: none;
  cursor: pointer;
}

.tab-content {
  padding: 15px 0;
}

.tab-underline {
  position: absolute;
  bottom: -2px;
  left: 0;
  height: 2px;
  width: 50%;
  background-color: #3b82f6;
  transition: transform 0.3s;
}

</style>
