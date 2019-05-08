<template>
    <div class="dropdown">
        <!-- trigger -->
        <!-- Each of this will be unique of the dropdown, so we use slot here -->
        <!-- We can't add a click on slot, so we add a div -->
        <div @click="isOpen = !isOpen">
            <slot name="trigger"></slot>
        </div>
        

        <!-- menu links -->
        <div v-show="isOpen" 
             class="dropdown-menu"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: [],

        components: {},

        data() {
            return {
                isOpen: false           
            }
        },

        computed: {
            
        },

        methods: {
            
        }
    }
</script>