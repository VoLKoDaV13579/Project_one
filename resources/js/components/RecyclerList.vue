<template>
    <div class="float-end">
        <button type="button" class="btn btn-success" @click="changeModalStatus('create')">Создать</button>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Статус</th>
                <th scope="col">Внутренний ID</th>
                <th scope="col">Адресс</th>
                <th scope="col">Серийный номер</th>
                <th scope="col">Смена состояния</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(recycler, key) of listOfRecycler" :key="key">
                <th scope="row">{{ recycler.id }}</th>
                <td v-if="recycler.status" align="center"><i class="far fa-check-circle" style="color: #00f03c;"></i>
                </td>
                <td v-else align="center"><i class="far fa-times-circle" style="color: #e10909;"></i></td>
                <td>{{ recycler.system_id }}</td>
                <td>{{ recycler.address }}</td>
                <td>{{ recycler.serial_number }}</td>
                <td> <input type="checkbox" true-value="1" false-value="0" v-model="recycler.status"
                        v-bind:id="recycler.id" @change="submit(recycler)"></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary"
                            @click="changeModalStatus('edit', recycler)"><i class="fas fa-edit"></i></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary"
                            @click="changeModalStatus('delete', recycler)"><i class="fas fa-trash-alt"></i></button>
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="status"
                                    v-model="newObject.status" true-value="1" false-value="0">
                                <label class="form-check-label" for="status">
                                    Статус работы
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="system_id">Внутренний ID</label>
                                <input type="text" class="form-control" id="system_id" v-model="newObject.system_id"
                                    placeholder="RCL29348">
                                <div class="form-text">Формат ID - RCL29348</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Адресс</label>
                                <input type="text" class="form-control" id="address" v-model="newObject.address"
                                    placeholder="Введите адресс....">
                                <div class="form-text">Введите адресс</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="serial_number">Серийный номер</label>
                                <input type="text" class="form-control" id="serial_number"
                                    v-model="newObject.serial_number" placeholder="S123456789">
                                <div class="form-text">Формат серийного номера - S123456789</div>
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
                                <label class="form-label" for="address">Адресс</label>
                                <input type="text" class="form-control" id="address" v-model="updateObject.address"
                                    placeholder="Адресс....">
                                <div class="form-text">Адресс</div>
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
    import axios from 'axios';

    export default {
        data() {
            return {
                listOfRecycler: [],
                isCreateModal: false,
                isEditModal: false,
                isDeleteModal: false,
                newObject: {
                    status: 0,
                    system_id: '',
                    address: '',
                    serial_number: '',
                },
                updateObject: {},
                deleteObjectId: {
                    id: 0,
                },
            }
        },
        mounted() {
            let vue = this;
            axios.get('/api/get')
                .then(function (response) {
                    vue.listOfRecycler = response.data.listOfRecycler;
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
                    axios.post('/api/create', vue.newObject)
                        .then(function (response) {
                            vue.listOfRecycler = response.data.listOfRecycler;
                            vue.changeModalStatus('create');
                        });
                } else if (modal == 'edit') {
                    axios.post('/api/update', vue.updateObject)
                        .then(function (response) {
                            vue.listOfRecycler = response.data.listOfRecycler;
                            vue.changeModalStatus('edit');
                        });
                } else if (modal == 'delete') {
                    axios.post('/api/delete', vue.deleteObjectId)
                        .then(function (response) {
                            vue.listOfRecycler = response.data.listOfRecycler;
                            vue.changeModalStatus('deleteReturn');
                        });

                }
            },

            submit: function(object = null) {
                let vue = this;
                vue.updateObject = object;
                axios.post('api/submit', vue.updateObject)
                    .then(function (response) {
                        vue.listOfRecycler = response.data.listOfRecycler;
                    })

            }
        }
    }

</script>
