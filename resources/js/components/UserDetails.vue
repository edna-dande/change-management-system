<template>
    <div class="container dashboard">
        <h1>User Details</h1>
        <p>Name: {{ user.name }}</p>
        <p>Email: {{ user.email }}</p>
        <p>Role: <span v-for="role in user.roles" :key="role.id">{{ role.name }}</span></p>

        <a class="btn btn-primary-outline" :href="`/admin/users/edit/${user.id}`">
            <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
        </a>

        <form @submit.prevent="confirmDelete(user.id)">
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
        user: {
            type: Object,
            required: true,
        },
    },
    methods: {
        confirmDelete(userId) {
            if (confirm('Are you sure?')) {
                this.deleteUser(userId);
            }
        },
        async deleteUser(userId) {
            try {
                await axios.post(`/admin/users/${userId}`, { _method: 'delete' });
                alert('User successfully deleted!');
                window.location.assign('/dashboard');
            } catch (error) {
                console.error('Error deleting user:', error);
                alert('An error occurred while deleting the user.');
            }
        },
    },
};
</script>

<style>
</style>
