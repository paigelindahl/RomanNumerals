<template>
     <div class="flex justify-center my-20">
        <TwoColGrid :romanDate="romanDate" :date="date">
            <template v-slot:input-container>
                <div class="flex flex-col space-y-3">
                    <div class="flex flex-col">
                        <label class="text-lg text-gray-600">Roman Numeral</label>
                        <input v-model="romanDate" type="text" placeholder="XXII-VII-MMXXIII" class="p-1.5 border border-gray-200 rounded-md"/>
                    </div>
                    <div class="flex justify-end">
                        <button
                            @click="convertToDate"
                            :disabled="!romanDate"
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
import { ref } from 'vue';
import axios from 'axios';

const romanDate = ref(null);
const date = ref(null);

// convert from roman numerals to date
const convertToDate = function() {
    axios.post('convert-numerals', {roman_date: romanDate.value})
    .then((res) => {
        date.value = res.data.date;
        console.log('success', res);
    }).catch((err) => {
        console.log('err', err);
    })
}

</script>
