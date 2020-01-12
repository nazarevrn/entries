<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading text-center">Редактировать запись</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ФИО</label>
                            <input type="text" v-model="staff.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Код</label>
                            <input type="text" v-model="staff.code" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Телефон</label>
                            <input type="text" v-model="staff.phone" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group text-center">
                            <button class="btn btn-success">Редактировать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.staffId = id;
            axios.get('/api/v1/staff/' + id)
                .then(function (resp) {
                    app.staff = resp.data;
                })
                .catch(function () {
                    alert("Не могу найти пользоватлея с указанным id");
                    console.log(id);
                });
        },
        data: function () {
            return {
                staffId: null,
                staff: {
                    name: '',
                    code: '',
                    phone: '',
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newStaff = app.staff;
                axios.patch('/api/v1/staff/' + app.staffId, newStaff)
                    .then(function (resp) {
                        app.$router.push({name: 'staffIndex'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Ошибка редактирования пользователя");
                    });
            }
        }
    }
</script>