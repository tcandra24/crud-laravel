<template>

    <Head>
        <title>Users</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-users"></i> USERS</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">

                                        <Link href="/apps/users/create" v-if="hasAnyPermission(['users.create'])"
                                            class="btn btn-primary input-group-text"> <i
                                            class="fa fa-plus-circle me-2"></i> NEW</Link>

                                        <input type="text" class="form-control" v-model="search"
                                            placeholder="search by user name...">

                                        <button class="btn btn-primary input-group-text" type="submit"> <i
                                                class="fa fa-search me-2"></i> SEARCH</button>

                                    </div>
                                </form>
                                <hr>
                                <div class="export text-end mb-3">
                                    <a href="/apps/users/export" target="_blank"
                                        class="btn btn-success btn-md border-0 shadow me-3"><i
                                            class="fa fa-file-excel"></i> EXCEL</a>
                                    <a href="/apps/users/pdf" target="_blank"
                                        class="btn btn-danger btn-md border-0 shadow"><i class="fa fa-file-pdf"></i>
                                        PDF</a>
                                </div>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Roles</th>
                                            <th scope="col" style="width:20%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(user, index) in users.data" :key="index">
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td>{{ user.gender }}</td>
                                            <td>{{ user.address }}</td>
                                            <td>
                                                <span v-for="(role, index) in user.roles" :key="index"
                                                    class="badge badge-primary shadow border-0 ms-2 mb-2">
                                                    {{ role.name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <Link :href="`/apps/users/${user.id}/edit`"
                                                    v-if="hasAnyPermission(['users.edit'])"
                                                    class="btn btn-success btn-sm me-2"><i
                                                    class="fa fa-pencil-alt me-1"></i> EDIT</Link>
                                                <button @click.prevent="destroy(user.id)"
                                                    v-if="hasAnyPermission(['users.delete'])"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                    DELETE</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="users.links" align="end" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import LayoutApp from '../../../Layouts/App.vue'
import Pagination from '../../../Components/Pagination.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import Swal from 'sweetalert2';

export default {
    layout: LayoutApp,
    components: {
        Head,
        Link,
        Pagination
    },
    props: {
        users: Object
    },
    setup() {
        const search = ref('' || (new URL(document.location)).searchParams.get('q'))

        const handleSearch = () => {
            Inertia.get('/apps/users', {
                q: search.value
            })
        }

        const destroy = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        Inertia.delete(`/apps/users/${id}`)

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'User deleted successfully.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                })
        }

        return {
            search,
            handleSearch,
            destroy
        }
    }
}

</script>

