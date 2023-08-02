<template>
    <div>
        <div class="dashboard">
            <h1>List of Systems</h1>
            <p>Manage your systems with ease</p>
            <a class="btn btn-primary" :href="`/systems/create`">
          <span>
            <font-awesome-icon :icon="['fas', 'plus']" style="color: #ffffff;" />
          </span>
                <span class="create-text"> Create</span>
            </a>

            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="systems.length === 0">
                    <td colspan="3">No systems</td>
                </tr>
                <tr v-else v-for="system in systems" :key="system.id">
                    <td>{{ system.name }}</td>
                    <td>{{ system.description }}</td>
                    <td class="text-center">
                        <a class="btn" :href="`/systems/show/${system.id}`">
                            <font-awesome-icon :icon="['fas', 'eye']" />
                        </a>
                        <a class="btn" :href="`/systems/${system.id}/edit`">
                            <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
                        </a>
                        <form @submit.prevent="confirmDelete(system.id)" style="display: inline-block;">
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
        systems: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
        };
    },
    methods: {
        confirmDelete(systemId) {
            if (confirm('Are you sure?')) {
                this.deleteSystem(systemId);
            }
        },
        async deleteSystem(systemId) {
            try {
                await axios.post(`/systems/${systemId}`,{_method: 'delete'});
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
