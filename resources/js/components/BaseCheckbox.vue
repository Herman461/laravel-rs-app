<script setup>
import {ref} from "vue";

defineProps(['attribute', 'option'])

const modelValue = ref(false)

</script>

<template>
    <label class="filter__checkbox">
        <input
            :checked="modelValue"
            @change="$emit('update:modelValue', $event.target.checked, attribute, $event.target.name)"
            :name="option.value"
            type="checkbox"
        >
        {{ option.value }}
    </label>
</template>
