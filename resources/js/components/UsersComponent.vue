<template>
    <div class="container">
        <transition name="fade">
            <div class="alert alert-success" role="alert" v-if="showMessage">
                {{ successMessage }}
            </div>
        </transition>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <button type="button" class="btn btn-primary btn-sm btn-add" @click="createUser()">Add User</button>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, i) in users">
                            <td>{{ user.first_name }} {{ user.last_name }}</td>
                            <td>{{ user.address }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.contact_phone_no }}</td>
                            <td>
                                <button
                                    class="btn btn-outline-secondary btn-sm"
                                    @click="viewData(user.id, i)"> View
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- template for the modal component -->
                    <transition name="modal" >
                        <div class="modal-mask" v-if="showModal">
                        <div class="modal-wrapper">
                            <div class="modal-container">
                                <div class="modal-header">
                                    <h3>User Details</h3>
                                    <button type="button" class="btn btn-outline-dark btn-sm" @click="closeModal()">x</button>
                                </div

                                <div class="modal-body">
                                    <slot name="body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name">Firstname</label>
                                                    <input type="text" v-model="form.first_name" class="form-control" :class="{ 'is-invalid' : allError.first_name }" placeholder="Firstname" :disabled="this.isDisabled">
                                                    <div class="invalid-feedback" v-if="allError.first_name">{{ allError.first_name[0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name">Lastname</label>
                                                    <input type="text" v-model="form.last_name" class="form-control" :class="{ 'is-invalid' : allError.last_name }" placeholder="Lastname" :disabled="this.isDisabled" >
                                                    <div class="invalid-feedback" v-if="allError.last_name">{{ allError.last_name[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" v-model="form.email" class="form-control" :class="{ 'is-invalid' : allError.email }" placeholder="Email" :disabled="this.isDisabled" :readonly="this.isReadOnly">
                                                    <div class="invalid-feedback" v-if="allError.email">{{ allError.email[0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_phone_no">Contact Number</label>
                                                    <input type="text" v-model="form.contact_phone_no" class="form-control" :class="{ 'is-invalid' : allError.contact_phone_no }" placeholder="Contact No." :disabled="this.isDisabled">
                                                    <div class="invalid-feedback" v-if="allError.contact_phone_no">{{ allError.contact_phone_no[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" v-model="form.address" class="form-control" :class="{ 'is-invalid' : allError.address }" placeholder="Address" :disabled="this.isDisabled">
                                                    <div class="invalid-feedback" v-if="allError.address">{{ allError.address[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="post_code">Postal Code</label>
                                                    <input type="text" v-model="form.post_code" class="form-control" :class="{ 'is-invalid' : allError.post_code }" placeholder="Postal Code" :disabled="this.isDisabled">
                                                    <div class="invalid-feedback" v-if="allError.post_code">{{ allError.post_code[0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="user_name">Username</label>
                                                    <input type="text" v-model="form.user_name" class="form-control" :class="{ 'is-invalid' : allError.user_name }" placeholder="Username" :disabled="this.isDisabled" :readonly="this.isReadOnly">
                                                    <div class="invalid-feedback" v-if="allError.user_name">{{ allError.user_name[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </slot>
                                    <div class="modal-footer">
                                    <slot name="footer">
                                        <button type="button" class="btn btn-outline-dark btn-sm" @click="storeUser()" v-show="showSaveBtn" >Save</button>
                                        <button type="button" class="btn btn-outline-dark btn-sm" @click="editUser()" v-show="showEditBtn" >Edit</button>
                                        <button type="button" class="btn btn-outline-dark btn-sm" @click="updateUser()" v-show="showUpdateBtn" >Update</button>
                                        <button type="button" class="btn btn-outline-dark btn-sm" @click="delUser()" v-show="showDelBtn">Delete</button>
                                    </slot>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </transition>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    props: ["users"],
    data() {
        return {
            showModal: false,
            isDisabled: true,
            isReadOnly: false,
            showEditBtn: true,
            showUpdateBtn: false,
            showDelBtn: false,
            showSaveBtn: false,
            accessToken: '',
            allError: '',
            showMessage: false,
            successMessage: '',
            form: {
                first_name: '',
                last_name: '',
                email: '',
                contact_phone_no: '',
                address: '',
                post_code: '',
                user_name: '',
                user_id: '',
            },
            currentDataIndex: ''
        };
    },
    methods:  {
        viewData(userId, i) {
            // Find Current User
            let user = this.filterUser(userId);

            // Set User Details Field
            this.setUserFields(user[0])

            this.showModal = true;
            this.showEditBtn = true;
            this.showUpdateBtn = false;
            this.showDelBtn = true;

            this.currentDataIndex = i;
        },
        filterUser(userId) {
            return this.users.filter((user) => {
                return userId == user.id
            });
        },
        setUserFields(user) {
            this.form.first_name = user.first_name;
            this.form.last_name = user.last_name;
            this.form.address = user.address;
            this.form.email = user.email;
            this.form.contact_phone_no = user.contact_phone_no;
            this.form.post_code = user.post_code;
            this.form.user_name = user.user_name;
            this.form.user_id = user.id;
        },
        createUser() {
            this.showModal = true;
            this.isDisabled = false;
            this.showSaveBtn = true;
            this.showEditBtn = false;
            this.showDelBtn = false;
            this.isReadOnly = false;
        },
        storeUser() {
            axios.post('/api/users',
                this.form,
                {
                    headers: {
                        Accept: 'application/json',
                        Authorization: "Bearer " + this.accessToken,
                }
            }).then((response) => {
                this.users.push(response.data.data)
                this.clearForm(response);

            })
            .catch((error) => {
                this.allError = error.response.data.data;
            });
        },
        editUser() {
            this.showEditBtn = false;
            this.showUpdateBtn = true;
            this.isReadOnly = true;
            this.isDisabled = false;
            this.showDelBtn = true;
        },
        updateUser() {

            const options = {
            method: 'PUT',
            headers: {
                Accept: 'application/json',
                Authorization: "Bearer " + this.accessToken,
            },
            data: this.form,
            url: '/api/users/' + this.form.user_id,
            }

           axios(options).then((response) => {
                this.users[this.currentDataIndex] = response.data.data;
                this.clearForm(response);

            })
            .catch((error) => {
                this.allError = error.response.data.data;
            });

        },
        delUser() {
            axios.delete('/api/users/' + this.form.user_id,
                { data: { id: this.form.user_id },
                headers: {  Accept: 'application/json', Authorization: "Bearer " + this.accessToken }
            }).then((response) => {
                this.clearForm(response);
            });

            this.users.splice(this.currentDataIndex, 1);


        },
        closeModal() {
            this.showModal = false;
            this.showSaveBtn = false;
            this.isDisabled = true;

            this.form.first_name = '';
            this.form.last_name = '';
            this.form.address = '';
            this.form.email = '';
            this.form.contact_phone_no = '';
            this.form.post_code = '';
            this.form.user_name = '';
        },
        getAccessToken() {
            axios.post('/oauth/token', {
                grant_type:'client_credentials',
                client_id: process.env.MIX_CLIENT_ID,
                client_secret: process.env.MIX_CLIENT_SECRET
            })
            .then((response) => {
                this.accessToken = response.data.access_token;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        clearForm(response) {

            this.form.first_name = '';
            this.form.last_name = '';
            this.form.address = '';
            this.form.email = '';
            this.form.contact_phone_no = '';
            this.form.post_code = '';
            this.form.user_name = '';

            this.showModal = false;
            this.showMessage = true,
            this.successMessage = response.data.message
            setTimeout(() => {
                this.showMessage = false
            }, 5000);
            this.isDisabled = true;
            this.showSaveBtn = false;
            this.showEditBtn = true;
            this.isReadOnly = true;
        }
    },
    mounted() {
        if (!this.accessToken) this.getAccessToken();
    },
};



</script>

<style scoped>
    .btn-add {
        float: right;
        margin-bottom: 10px;
    }
</style>
