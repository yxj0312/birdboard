<template>
    <div class="dropdown">
        <!-- trigger -->
        <!-- Each of this will be unique of the dropdown, so we use slot here -->
        <slot name="trigger"></slot>

        <!-- menu links -->
        <div class="dropdown-menu">
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