<template>
    <div class="container dashboard">
        <h1>Role Details</h1>
        <p>Name: {{ role.name }}</p>

        <a class="btn btn-primary-outline" :href="`/roles/edit/${role.id}`">
            <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
        </a>

        <form @submit.prevent="confirmDelete(role.id)">
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
        role: {
            type: Object,
            required: true,
        },
    },
    methods: {
        confirmDelete(roleId) {
            if (confirm('Are you sure?')) {
                this.deleteRole(roleId);
            }
        },
        async deleteRole(roleId) {
            try {
                await axios.post(`/roles/${roleId}`, { _method: 'delete' });
                alert('Role successfully deleted!');
                window.location.assign('/dashboard');
            } catch (error) {
                console.error('Error deleting role:', error);
                alert('An error occurred while deleting the role.');
            }
        },
    },
};
</script>

<style>
</style>
