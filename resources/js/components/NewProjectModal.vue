<template>
    <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New</h1>

        <div class="flex">
            <div class="flex-1 mr-4">
                <div class="mb-4">
                    <label for="title" class="text-sm md-2">Title</label>
                    <input type="text" id="title" class="border border-muted-light p-2 text-xs block w-full rounded">
                </div>

                <div class="mb-4">
                    <label for="description" class="text-sm md-2">Description</label>
                    <textarea id="description" class="border border-muted-light p-2 text-xs block w-full rounded" rows="7"></textarea>
                </div>
            </div>

            <div class="flex-1 ml-4">
                <div class="mb-4">
                    <label class="text-sm md-2">Need Some Tasks?</label>
                    <input type="text" class="border border-muted-light p-2 text-xs block w-full rounded" placeholder="Task 1">
                </div>

                <button class="inline-flex items-center text-xs" @click="addTask">
                    <span class="mr-2">
                        icon
                    </span>

                    <span>Add New Task Field</span> 
                </button>
            </div>
        </div>

        <footer class="flex justify-end">
            <button class="button is-outlined mr-4" @click.prevent="$modal.hide('new-project')">Cancel</button>
            <button class="button">Create Project</button>
        </footer>
    </modal>
</template>

<script>
    export default {
        props: [],

        components: {},

        data() {
            return {
                tasks: [
                    { value:''}
                ]
            }
        },

        computed: {
            
        },

        methods: {
            addTask() {

            }
        }
    }
</script>