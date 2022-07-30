<template>

    <Head>
        <title>Forgot Password</title>
    </Head>
    <div class="col-md-10">
        <div class="fade-in">
            <div class="text-center mb-4">
                <a href="" class="text-dark text-decoration-none">
                    <h3 class="mt-2 font-weight-bold">CRUD LARAVEL</h3>
                </a>
            </div>
            <div class="card-group">
                <div class="card border-top-purple border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-start">
                            <h5>REGISTER</h5>
                        </div>
                        <hr>
                        <div v-if="session.status" class="alert alert-success mt-2">
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Full Name</label>
                                        <input class="form-control" v-model="form.name"
                                            :class="{ 'is-invalid': errors.name }" type="text" placeholder="Full Name">
                                    </div>
                                    <div v-if="errors.name" class="alert alert-danger">
                                        {{ errors.name }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Email Address</label>
                                        <input class="form-control" v-model="form.email"
                                            :class="{ 'is-invalid': errors.email }" type="email"
                                            placeholder="Email Address">
                                    </div>
                                    <div v-if="errors.email" class="alert alert-danger">
                                        {{ errors.email }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Gender</label>
                                        <!-- <input class="form-control" v-model="form.gender"
                                                    :class="{ 'is-invalid': errors.gender }" type="text" placeholder="gender"> -->
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" v-model="form.gender"
                                                value="male" id="check-gender-male" checked>
                                            <label class="form-check-label" for="check-gender-male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" v-model="form.gender"
                                                value="female" id="check-gender-female">
                                            <label class="form-check-label" for="check-gender-female">Female</label>
                                        </div>
                                    </div>
                                    <div v-if="errors.gender" class="alert alert-danger">
                                        {{ errors.gender }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Address</label>
                                        <textarea class="form-control" :class="{ 'is-invalid': errors.address }"
                                            v-model="form.address"></textarea>
                                    </div>
                                    <div v-if="errors.address" class="alert alert-danger">
                                        {{ errors.address }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Password</label>
                                        <input class="form-control" v-model="form.password"
                                            :class="{ 'is-invalid': errors.password }" type="password"
                                            placeholder="Password">
                                    </div>
                                    <div v-if="errors.password" class="alert alert-danger">
                                        {{ errors.password }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Password Confirmation</label>
                                        <input class="form-control" v-model="form.password_confirmation" type="password"
                                            placeholder="Password Confirmation">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="fw-bold">Roles</label>
                                        <br>
                                        <div class="form-check form-check-inline" v-for="(role, index) in roles"
                                            :key="index">
                                            <input class="form-check-input" type="checkbox" v-model="form.roles"
                                                :value="role.name" :id="`check-${role.id}`">
                                            <label class="form-check-label" :for="`check-${role.id}`">{{
                                                    role.name
                                            }}</label>
                                        </div>
                                    </div>
                                    <div v-if="errors.roles" class="alert alert-danger">
                                        {{ errors.roles }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary shadow-sm rounded-sm" type="submit">SAVE</button>
                                    <button class="btn btn-warning shadow-sm rounded-sm ms-3"
                                        type="reset">RESET</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAuth from '../../Layouts/Auth.vue'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
    layout: LayoutAuth,
    components: {
        Head,
        Link
    },
    props: {
        errors: Object,
        session: Object,
    },
    setup() {
        const form = reactive({
            name: '',
            email: '',
            gender: 'male',
            address: '',
            password: '',
            password_confirmation: '',
        })

        const submit = () => {
            Inertia.post('/register', {
                name: form.name,
                email: form.email,
                gender: form.gender,
                address: form.address,
                password: form.password,
                password_confirmation: form.password_confirmation
            })
        }

        return {
            form,
            submit
        }
    }
}
</script>
