<template>
    <div class="float-end">
        <button type="button" class="btn btn-success" @click="changeModalStatus('create')">Создать</button>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID проблемы</th>
                <th scope="col">Решение</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(solution, key) of listOfSolution" :key="key">
                <th scope="row">{{ solution.id }}</th>
                <td>{{ solution.theme }}</td>
                <td>{{ solution.title }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary" @click="changeModalStatus('edit', solution)"><i
                                class="fas fa-edit"></i></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary"
                            @click="changeModalStatus('delete', solution)"><i class="fas fa-trash-alt"></i></button>
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
                                <label class="form-label" for="title">Тема</label>
                                <input type="text" class="form-control" id="title" v-model="newObject.theme"
                                    placeholder="Тема....">
                                <div class="form-text">Тема</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Описание</label>
                                <input type="text" class="form-control" id="title" v-model="newObject.title"
                                    placeholder="Описание....">
                                <div class="form-text">Описание</div>
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
                                <label class="form-label" for="title">Тема</label>
                                <input type="text" class="form-control" id="theme" v-model="updateObject.theme"
                                    placeholder="Тема....">
                                <div class="form-text">Тема</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Тема</label>
                                <input type="text" class="form-control" id="title" v-model="updateObject.title"
                                    placeholder="Тема....">
                                <div class="form-text">Тема</div>
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
    export default {
        data() {
            return {
                listOfSolution: [],
                isCreateModal: false,
                isEditModal: false,
                isDeleteModal: false,
                newObject: {
                    theme: '',
                    title: '',
                },
                updateObject: {},
                deleteObjectId: {
                    id: 0,
                },
            }
        },
        mounted() {
            let vue = this;
            axios.get('/api/getSolution')
                .then(function (response) {
                    vue.listOfSolution = response.data.listOfSolution;
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
                    axios.post('/api/createSolution', vue.newObject)
                        .then(function (response) {
                            vue.listOfSolution = response.data.listOfSolution;
                            vue.changeModalStatus('create');
                        });
                } else if (modal == 'edit') {
                    axios.post('/api/updateSolution', vue.updateObject)
                        .then(function (response) {
                            vue.listOfSolution = response.data.listOfSolution;
                            vue.changeModalStatus('edit');
                        });
                } else if (modal == 'delete') {
                    axios.post('/api/deleteSolution', vue.deleteObjectId)
                        .then(function (response) {
                            vue.listOfSolution = response.data.listOfSolution;
                            vue.changeModalStatus('deleteReturn');
                        });

                }
            }
        }
    }

</script>
