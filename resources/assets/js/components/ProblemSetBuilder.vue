<template>
    <div>
        <multiselect v-model="value" :options="options"></multiselect>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        name: "problem-set-builder",
        components: { Multiselect },
        props: ['value', 'options'],
        data() {
            return {

            }
        }
    }
</script>

<style scoped>

</style>