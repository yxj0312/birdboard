<template>
    <div class="dropdown relative">
        <!-- trigger -->
        <!-- Each of this will be unique of the dropdown, so we use slot here -->
        <!-- We can't add a click on slot, so we add a div -->
        <div class="dropdown-toggle"
            @click.prevent="isOpen = !isOpen"
        >
            <slot name="trigger"></slot>
        </div>
        

        <!-- menu links -->
        <div v-show="isOpen" 
             class="dropdown-menu absolute bg-card py-2 rounded shadow mt-2"
             :class="align === 'left' ? 'pin-l' : 'pin-r'"
             :style="{ width }"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            width: { default: 'auto' },
            align: { default: 'left' }
        },

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