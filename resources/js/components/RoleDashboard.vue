<template>
    <div>
        <div class="dashboard">
            <h1>List of Roles</h1>
            <p>Manage your roles with ease</p>
            <a class="btn btn-primary" :href="`/roles/create`">
        <span>
          <font-awesome-icon :icon="['fas', 'plus']" style="color: #ffffff;" />
        </span>
                <span class="create-text"> Create</span>
            </a>

            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="roles.length === 0">
                    <td colspan="2">No Roles</td>
                </tr>
                <tr v-else v-for="role in roles" :key="role.id">
                    <td>{{ role.name }}</td>
                    <td class="text-center">
                        <a class="btn" :href="`/roles/show/${role.id}`">
                            <font-awesome-icon :icon="['fas', 'eye']" />
                        </a>
                        <a class="btn" :href="`/roles/${role.id}/edit`">
                            <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
                        </a>
                        <button class="btn" @click="confirmDelete(role.id)">
                            <font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" />
                        </button>
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
        roles: {
            type: Array,
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
                window.location.assign('/dashboard'); // Replace with the desired URL after deletion
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
