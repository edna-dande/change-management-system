<template>
    <div class="container crequest">
        <h1>List of Requests</h1>
        <p>Manage your requests</p>

        <a href="/change_requests/create" class="btn btn-primary">
      <span>
        <font-awesome-icon icon="fa-solid fa-plus" style="color: #ffffff;" />
      </span>
            <span class="create-text"> Create </span>
        </a>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Request Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="changeRequests.length === 0">
                <td colspan="4">No requests</td>
            </tr>
            <tr v-else v-for="changeRequest in changeRequests" :key="changeRequest.id">
                <td>{{ changeRequest.title }}</td>
                <td :class="getStatusClass(changeRequest.status_id)">
                    {{ changeRequest.status ? changeRequest.status.name : 'N/A' }}
                </td>
                <td>{{ changeRequest.created_at }}</td>
                <td>
                    <a :href="`/change_requests/show/${changeRequest.id}`" class="btn">
                        <font-awesome-icon icon="fa-solid fa-eye" />
                    </a>
                    <template v-if="canEdit(changeRequest)">
                        <a :href="`/change_requests/edit/${changeRequest.id}`" class="btn">
                            <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
                        </a>
                        <form @submit.prevent="deleteChangeRequest(changeRequest.id)" style="display: inline">
                            <button class="btn btn-danger-outline" type="submit" @click="confirmDelete(changeRequest.id)">
                                <font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" />
                            </button>
                        </form>
                    </template>
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
        changeRequests: {
            type: Array,
            required: true,
        },
        currentUserId: {
            type: Number,
            required: true,
        },
    },
    methods: {
        getStatusClass(statusId) {
            if ([1, 2, 3].includes(statusId)) return 'btn btn-pending';
            if (statusId === 7) return 'btn btn-progress';
            if (statusId === 6) return 'btn btn-approved';
            if (statusId === 5) return 'btn btn-rejected';
            return 'btn btn-complete';
        },
        canEdit(changeRequest) {
            return changeRequest.user_id === this.currentUserId;
        },
        async deleteChangeRequest(changeRequestId) {
            try {
                await axios.delete(`/change_requests/${changeRequestId}`);
                alert('Change request successfully deleted!');
                this.changeRequests = this.changeRequests.filter(
                    (request) => request.id !== changeRequestId
                );
            } catch (error) {
                console.error('Error deleting change request:', error);
                alert('An error occurred while deleting the change request.');
            }
        },
    confirmDelete(changeRequestId) {
        if (confirm('Are you sure you want to delete this change request?')) {
            this.deleteChangeRequest(changeRequestId);
        }
    },
    },
};
</script>

<style>
</style>
