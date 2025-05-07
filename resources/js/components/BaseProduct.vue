<script setup>
defineProps({product: Object})
</script>

<template>
    <article class="catalog__product product">
        <div class="product__body">
            <div class="product__preview"></div>
            <div class="product__title">{{product.name}}</div>
            <div class="product__price">{{product.price}}</div>
            <div class="product__quantity">Quantity: {{product.quantity}}</div>
            <div v-if="product.attribute_options.length > 0" class="product__attributes">
                <div class="product__subtitle">Attributes:</div>
                <ul>
                    <li class="product__attribute" :key="attribute.attribute.id" v-for="attribute in product.attribute_options">
                        <span><b>{{attribute.attribute.name}}</b><br>{{attribute.option.value}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </article>
</template>
