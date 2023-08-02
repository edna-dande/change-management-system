<template>
    <div>
        <div class="dashboard">
            <h1>List of Users</h1>
            <p>Manage your users with ease</p>
            <a class="btn btn-primary" :href="`/users`">
          <span>
            <font-awesome-icon :icon="['fas', 'plus']" style="color: #ffffff;" />
          </span>
                <span class="create-text"> Create</span>
            </a>

            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="users.length === 0">
                    <td colspan="4">No users</td>
                </tr>
                <tr v-else v-for="user in users" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <span v-for="role in user.roles" :key="role.id" class="badge text-bg-dark">{{ role.name }}</span>
                    </td>
                    <td class="text-center">
                        <a class="btn" :href="`/users/show/${user.id}`">
                            <font-awesome-icon :icon="['fas', 'eye']" />
                        </a>
                        <a class="btn" :href="`/users/${user.id}/edit`">
                            <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
                        </a>
                        <form @submit.prevent="confirmDelete(user.id)" style="display: inline-block;">
                            <button class="btn" type="submit"><font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" /></button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        users: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
        };
    },
    methods: {
        confirmDelete(userId) {
            if (confirm('Are you sure?')) {
                this.deleteUser(userId);
            }
        },
        async deleteUser(userId) {
            try {
                await axios.post(`/users/${userId}`,{_method: 'delete'});


                alert('User successfully deleted!');
                window.location.assign('/dashboard');
            } catch (error) {
                console.error('Error deleting project:', error);
                alert('An error occurred while deleting the user.');
            }
        },
    },
};
</script>

<style>
</style>
