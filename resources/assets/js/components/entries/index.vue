<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'staffCreate'}" class="btn btn-success">Создать нового пользователя</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Список посещений</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Время</th>
                        <th>Направление</th>
                        <!-- <th width="100">&nbsp;</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, id) in entries" v-bind:key="id">
                        <td>{{ item[0].staff.name }}</td>
                        <td>{{ item[0].timestamp }}</td>
                        <td>{{ item[0].pass_direction | direction_filter }}</td>
                        <!-- <td>
                            <router-link :to="{name: 'editStaff', params: {id: item.id}}" class="btn btn-xs btn-default">
                                Редактировать
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(item.id)">
                                Удалить
                            </a>
                        </td> -->
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                entries: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/entries')
                .then(function (resp) {
                    app.entries = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load entries");
                });
        },
        methods: {
            deleteEntry(id) {
                if (confirm("Вы действительно хотите удалить?")) {
                    var app = this;
                    axios.delete('/api/v1/staff/' + id)
                        .then(function (resp) {
                            app.$router.push({path: '/'});
                        })
                        .catch(function (resp) {
                            alert("Удаление невозможно...");
                        });
                    console.log(id);
                }
            }
        },

        filters: {
            direction_filter (value) {
                if (value === 0) {
                    return 'Вход';
                } else {
                    return 'Выход';
                }
                //return value.toFixed(2)
            }
        }

    }
    


</script>