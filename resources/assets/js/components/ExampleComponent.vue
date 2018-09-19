<template>
    <input :value="dataValue" name="new-date" type="text" class="form-control pull-right" id="datepickerr">
</template>

<script>
    export default {
        props:['data-value'],
        mounted() {

        }
    }
</script>
