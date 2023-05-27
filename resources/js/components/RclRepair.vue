<template>
    <div class="float-end">
        <button type="button" class="btn btn-success" @click="changeModalStatus('create')">Создать</button>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Номер банкомата</th>
                <th scope="col">Номер проблемы</th>
                <th scope="col">Номер решения</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(repairItem, key) of repairList" :key="key">
                <th scope="row">{{ repairItem.id }}</th>
                <td>{{ repairItem.title }}</td>
                <td>{{ repairItem.description }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary" @click="changeModalStatus('edit', repairItem)"><i
                                class="fas fa-edit"></i></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary"
                            @click="changeModalStatus('delete', repairItem)"><i class="fas fa-trash-alt"></i></button>
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
                                <label class="form-label" for="recycler_id">Тема</label>
                                <input type="text" class="form-control" id="recycler_id" v-model="newObject.title"
                                    placeholder="Тема....">
                                <div class="form-text">Тема</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Описание</label>
                                <input type="text" class="form-control" id="description" v-model="newObject.description"
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
</template>

<script>
    export default {
        data() {
            return {
                repairList: [],
                isCreateModal: false,
                newObject: {
                    recycler_id: '',
                    theme_id: '',
                    solution_id: '',
                },

            }
        },
        mounted() {
            let vue = this;
            axios.get('/api/getRepair')
                .then(function (response) {
                    vue.repairList = response.data.repairList;
                });
        },

        methods: {
            changeModalStatus: function (modal, object = null) {
                if (modal == 'create') {
                    this.isCreateModal = !this.isCreateModal;
                } 
            },

            save: function (modal) {
                let vue = this;
                if (modal == 'create') {
                    axios.post('/api/createRepair', vue.newObject)
                        .then(function (response) {
                            vue.repairList = response.data.repairList;
                            vue.changeModalStatus('create');
                        });
                } 
            }
        }
    }

</script>
