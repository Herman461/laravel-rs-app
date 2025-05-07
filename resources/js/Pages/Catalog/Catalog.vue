<script setup>
import BaseCheckbox from "@/components/BaseCheckbox.vue";
import BaseProduct from "@/components/BaseProduct.vue";

import {ref} from "vue";
import axios from "axios";


const props = defineProps({attributes: Object, products: Object})

const selectedAttributes = ref({})
const currentPage = ref(1);
const isLoading = ref(false);
const baseProducts = ref(props.products.data)
const lastPage = ref(props.products.lastPage)
console.log(baseProducts)
const updateProducts = async (page = null) => {
    const basePage = page ? page : currentPage.value

    isLoading.value = true
    currentPage.value = basePage

    const formData = new FormData()

    Object.entries(selectedAttributes.value).forEach(([key, values]) => {
        if (values?.length > 0) {
            values.forEach(value => {
                formData.append(`attributes[${key}][]`, value)
            })
        }
    })

    try {
        const response = await axios.post('/api/catalog/feed',  formData, {
            params: {page: basePage},
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        if (response.status === 200) {
            baseProducts.value = response.data.products.data
            lastPage.value = response.data.products.last_page
        }
    } catch (e) {
        console.error(e)
    } finally {
        isLoading.value = false
    }

}

const onCheckboxChange = (isChecked, name, value) => {

    const attributes = {...selectedAttributes.value}

    if (!attributes[name]) {
        attributes[name] = []
    }

    if (isChecked && attributes[name]) {
        attributes[name].push(value)
    }
    if (!isChecked) {
        attributes[name] = attributes[name].filter(item => item !== value)
    }

    selectedAttributes.value = attributes

    updateProducts(1)
}

</script>

<template>
    <div class="catalog">
        <div class="catalog__container container">
            <h1 class="catalog__title">Catalog</h1>
            <div class="catalog__body">
                <form class="catalog__filter filter">
                    <div :key="attribute.id" v-for="attribute in attributes" class="filter__attribute attribute">
                        <div class="attribute__name">{{ attribute.name }}</div>
                        <div class="attribute__option" :key="option.id" v-for="option in attribute.options">
                            <BaseCheckbox :option="option" :attribute="attribute.name" @update:modelValue="onCheckboxChange" />
                        </div>
                    </div>
                </form>
                <div class="catalog__content">
                    <div class="catalog__products">
                        <BaseProduct
                            v-for="product in baseProducts"
                            :key="product.id"
                            :product="product"
                        />
                    </div>
                    <div class="catalog__pagination pagination">
                        <div v-if="currentPage !== 1" @click="updateProducts(currentPage - 1)" class="pagination__button">Prev</div>
                        <div v-if="currentPage < lastPage" @click="updateProducts(currentPage + 1)" class="pagination__button">Next</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style lang="scss">
@use "~/style.scss";
</style>
