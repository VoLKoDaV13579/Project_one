<template>
    <div class="float-end">
        <button type="button" class="btn btn-success" @click="changeModalStatus('create')">Создать</button>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Почта</th>
                <th scope="col">Пароль</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(user, key) of users" :key="key">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.password }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary" @click="changeModalStatus('edit', user)"><i
                                class="fas fa-edit"></i></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary"
                            @click="changeModalStatus('delete', user)"><i class="fas fa-trash-alt"></i></button>
                    </div>

                </td>
            </tr>
        </tbody>
    </table>
    <div v-if="isCreateModal">
        <transition name="modal">
            <div class="modal fade show" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:block">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Создание записи</h5>
                            <button type="button" class="btn btn-primary btn-sm" style="background-color: #455a64;"
                                data-dismiss="modal" aria-label="Close" @click="changeModalStatus('create')">
                                Закрыть
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Имя</label>
                                <input type="text" class="form-control" id="name" v-model="newObject.name"
                                    placeholder="Имя....">
                                <div class="form-text">Имя</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Почта</label>
                                <input type="text" class="form-control" id="email" v-model="newObject.email"
                                    placeholder="Почта....">
                                <div class="form-text">Формат электронной почты "example@example.com"</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Пароль</label>
                                <input type="password" class="form-control" id="password" v-model="newObject.password"
                                    placeholder="Пароль....">
                                <div class="form-text">Пароль должен содержать хотя бы одну цифру, одну строчную букву,
                                    один символ из списка "!@#$%^&*", и быть не короче 8 и не длиннее 25 символов</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"
                                @click="changeModalStatus('create')">Отмена</button>
                            <button type="button" class="btn btn-success" @click="save('create')">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <div v-if="isEditModal">
        <transition name="modal">
            <div class="modal fade show" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:block">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Изменение записи</h5>
                            <button type="button" class="btn btn-primary btn-sm" style="background-color: #455a64;"
                                data-dismiss="modal" aria-label="Close" @click="changeModalStatus('edit')">
                                Закрыть
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Имя</label>
                                <input type="text" class="form-control" id="name" v-model="updateObject.name"
                                    placeholder="Имя....">
                                <div class="form-text">Имя</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Почта</label>
                                <input type="text" class="form-control" id="email" v-model="updateObject.email"
                                    placeholder="Почта....">
                                <div class="form-text">Формат электронной почты "example@example.com"</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Пароль</label>
                                <input type="password" class="form-control" id="password"
                                    v-model="updateObject.password" placeholder="Пароль....">
                                <div class="form-text">Пароль должен содержать хотя бы одну цифру, одну строчную букву,
                                    один символ из списка "!@#$%^&*", и быть не короче 8 и не длиннее 25 символов</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"
                                @click="changeModalStatus('edit')">Отмена</button>
                            <button type="button" class="btn btn-success" @click="save('edit')">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <div v-if="isDeleteModal">
        <transition name="modal">
            <div class="modal fade show" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:block">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Удаление записи</h5>
                            <button type="button" class="btn btn-primary btn-sm" style="background-color: #455a64;"
                                data-dismiss="modal" aria-label="Close" @click="changeModalStatus('delete')">
                                Отменить
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="title">Подтвердите удаление</label>
                                <div class="form-text">Вы действительно хотите удалить запись?</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"
                                @click="changeModalStatus('delete')">Отмена</button>
                            <button type="button" class="btn btn-success" @click="save('delete')">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>

</template>

<script>
import nav from './Navigation.vue'
    export default {
        data() {
            return {
                users: [],
                isCreateModal: false,
                isEditModal: false,
                isDeleteModal: false,
                newObject: {
                    name: '',
                    email: '',
                    password: '',
                },
                updateObject: {},
                deleteObjectId: {
                    id: 0,
                },
            }
        },
        mounted() {
            let vue = this;
            axios.get('/api/getUser')
                .then(function (response) {
                    vue.users = response.data.users;
                });
        },

        methods: {
            changeModalStatus: function (modal, object = null) {
                if (modal == 'create') {
                    this.isCreateModal = !this.isCreateModal;
                } else if (modal == 'edit') {
                    this.updateObject = object;
                    this.isEditModal = !this.isEditModal;
                } else if (modal == 'delete') {
                    this.deleteObjectId.id = object.id;
                    this.isDeleteModal = !this.isDeleteModal;
                } else if (modal == 'deleteReturn') {
                    this.isDeleteModal = !this.isDeleteModal;
                }
            },

            save: function (modal) {
                let vue = this;
                if (modal == 'create') {
                    axios.post('/api/createUser', vue.newObject)
                        .then(function (response) {
                            vue.users = response.data.users;
                            vue.changeModalStatus('create');
                        });
                } else if (modal == 'edit') {
                    axios.post('/api/updateUser', vue.updateObject)
                        .then(function (response) {
                            vue.users = response.data.users;
                            vue.changeModalStatus('edit');
                        });
                } else if (modal == 'delete') {
                    axios.post('/api/deleteUser', vue.deleteObjectId)
                        .then(function (response) {
                            vue.users = response.data.users;
                            vue.changeModalStatus('deleteReturn');
                        });

                }
            }
        }
    }

</script>
