<template>
    <div class="users">
        <h1 style="font-size: 25px;">List of Users</h1>
        <p>Manage your users with ease</p>

        <a class="btn btn-primary" :href="createUserLink()"><font-awesome-icon icon="fa-solid fa-plus" style="color: #fbfdfe;" />Create</a>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.name }}</td>
                <td>{{ user.location }}</td>
                <td>
                    <a style="margin-right: 10px;" class="btn btn-sm btn-info-outline" :href="viewUserLink(user.id)"><font-awesome-icon icon="fa-regular fa-eye" /></a>
                    <a style="margin-right: 10px;" class="btn btn-sm btn-primary-outline" :href="editUserLink(user.id)"><font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" /></a>
                    <form @submit.prevent="confirmDelete(user.id)" style="display: inline-block;">
                        <button class="btn btn-sm btn-danger-outline" type="submit" style="margin-right: 5px;"><font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" /></button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>

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
    methods: {
        createUserLink() {
            return `/projects/create`;
        },
        viewUserLink(userId) {
            return `/projects/${userId}`;
        },
        editUserLink(userId) {
            return `/projects/${userId}/edit`;
        },
        confirmDelete(userId) {
            if (confirm('Are you sure?')) {
                this.deleteProject(userId);
            }
        },
        async deleteProject(projectId) {
            try {
                await axios.post(`/projects/${projectId}`,{_method: 'delete'});


                alert('Project successfully deleted!');
                window.location.assign('/projects');
            } catch (error) {
                console.error('Error deleting project:', error);
                alert('An error occurred while deleting the project.');
            }
        },
    },
};
</script>

<style>
.users {
    margin: 20px;
}
</style>
