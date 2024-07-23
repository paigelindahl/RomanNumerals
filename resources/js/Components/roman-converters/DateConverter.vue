<template>
    <div class="max-w-96">
        <VueDatePicker
            v-model="date" placeholder="Select Day"
            model-type="dd.mm.yyyy"
            :enable-time-picker="false"
            auto-apply
        ></VueDatePicker>
    </div>
</template>

<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue';

const date = ref();
</script>
