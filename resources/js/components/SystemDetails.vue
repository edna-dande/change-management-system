<template>
    <div class="container dashboard">
        <h1>System Details</h1>
        <p>Name: {{ system.name }}</p>
        <p>Description: {{ system.description }}</p>

        <a class="btn btn-primary-outline" :href="`/systems/edit/${system.id}`">
            <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
        </a>

        <form @submit.prevent="confirmDelete(system.id)">
            <button type="submit" class="btn btn-danger-outline">
                <font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" />
            </button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        system: {
            type: Object,
            required: true,
        },
    },
    methods: {
        confirmDelete(systemId) {
            if (confirm('Are you sure?')) {
                this.deleteSystem(systemId);
            }
        },
        async deleteSystem(systemId) {
            try {
                await axios.post(`/systems/${systemId}`, { _method: 'delete' });
                alert('System successfully deleted!');
                window.location.assign('/dashboard');
            } catch (error) {
                console.error('Error deleting system:', error);
                alert('An error occurred while deleting the system.');
            }
        },
    },
};
</script>

<style>
</style>
