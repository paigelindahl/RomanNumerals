<template>
    <div class="flex justify-center my-20">
        <TwoColGrid :romanDate="romanDate" :date="formattedDate">
            <template v-slot:input-container>
                <div class="flex flex-col space-y-3">
                    <div>
                        <label class="text-lg text-gray-600">Date</label>
                        <VueDatePicker
                            v-model="date"
                            placeholder=""
                            :enable-time-picker="false"
                            :format="format"
                            auto-apply
                        ></VueDatePicker>
                    </div>
                    <div class="flex justify-end">
                        <button
                            @click="convertRoman"
                            :disabled="!formattedDate"
                            class="w-fit bg-blue-500 hover:bg-blue-600 transition-all duration-500 px-3 py-2 rounded-lg text-white"
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
import { ref } from 'vue';
import axios from 'axios';

const date = ref(null);
const formattedDate = ref(null);
const romanDate = ref(null);

const format = (date) => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();
  formattedDate.value = `${day}-${month}-${year}`;
  return formattedDate.value;
}

// convert from date to roman numerals
const convertRoman = function() {
    axios.post('convert-date', {date: formattedDate.value})
    .then((res) => {
        romanDate.value = res.data.roman_date;
        console.log('success', res);
    }).catch((err) => {
        console.log('err', err);
    })
}
</script>
