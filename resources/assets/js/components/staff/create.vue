<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading text-center">Создать новую запись</div>
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
                            <button class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
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
                let app = this;
                let newStaff = app.staff;
                axios.post('/api/v1/staff', newStaff)
                    .then(function (resp) {
                        let message = '';
                        if (resp.data.name && resp.data.name.includes("The name field is required.") === true) {
                            messsage = "Не заполнено поле 'ФИО'!";
                        }

                        if (resp.data.code) {

                            if (resp.data.code.includes("The code has already been taken.") === true ) {
                                message = "Введенный код не уникален!";
                            }

                            if (resp.data.code.includes("The code field is required.") === true) {
                                message = "Поле 'Код' не заполнено!";
                            }

                        }

                        if (resp.data.phone) {

                            if (resp.data.phone.includes("The phone has already been taken.") === true ) {
                                message = "Введенный телефон не уникален!";
                            }

                            if (resp.data.phone.includes("The phone field is required.") === true) {
                                message = "Поле 'Телефон' не заполнено!";
                            }

                        }

                        if (message !== '') {
                            alert(message);
                        } else {
                            app.$router.push({name: 'staffIndex'});
                        }

                    })
                    .catch(function (resp) {
                        console.log(resp);

                        alert("Ошибка при создании записи");
                    });
            }
        }
    }
</script>