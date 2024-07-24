<template>
    <div class="flex justify-center my-10">
        <TwoColGrid :romanDate="romanDate" :date="formattedDate" :show="show">
            <template v-slot:input-container>
                <div class="flex flex-col space-y-3">
                    <div class="flex-col">
                        <div>
                            <label class="text-lg text-gray-600">Date</label>
                            <VueDatePicker
                                v-model="date"
                                placeholder=""
                                :enable-time-picker="false"
                                :format="format"
                                :clearable="false"
                                auto-apply
                            ></VueDatePicker>
                        </div>
                        <div class="min-h-14">
                            <small v-show="validator" class="text-red-500">{{ validator }}</small>
                        </div>
                        <div class="flex justify-end">
                            <button @click="clear" class="text-sm text-gray-600 mt-1 hover:text-gray-800">Clear</button>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button
                            @click="convertRoman"
                            :disabled="!formattedDate"
                            class="w-fit bg-blue-500 hover:bg-blue-600 disabled:hover:bg-blue-500 transition-all duration-500 px-4 py-3 rounded-lg text-white"
                        >Convert</button>
                    </div>
                </div>
            </template>
        </TwoColGrid>
    </div>
</template>

<script setup>
import TwoColGrid from "@/Components/grid/TwoColGrid.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref, watch } from 'vue';
import axios from 'axios';

const date = ref(null);
const formattedDate = ref(null);
const romanDate = ref(null);
const show = ref(false);
const validator = ref(null);

const format = (date) => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();
  formattedDate.value = `${day}-${month}-${year}`;
  return formattedDate.value;
}

const clear = function() {
    date.value = null;
    formattedDate.value = null;
    romanDate.value = null;
    show.value = false;
}

watch(date, (newValue, oldValue) => {
    show.value = false;
})

// convert from date to roman numerals
const convertRoman = function() {
    axios.post('convert-date', {date: formattedDate.value})
    .then((res) => {
        romanDate.value = res.data.roman_date;
        show.value = true;
        console.log('success', res);
    }).catch((err) => {
        console.log('err', err);
        validator.value = err.response.data.error;
    })
}
</script>
