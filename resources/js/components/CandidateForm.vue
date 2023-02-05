<template>
    <div class="card bg-green-500 p-5 m-auto">
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="grid w-full">
                <div class="col-4 md:col-2 flex align-items-center justify-content-center">
                    <label for="fio" class="m-3 font-semibold">ФИО</label>
                </div>
                <div class="col-8 md:col-10">
                    <InputText type="text" v-model="form.fio" id="fio" class="m-3 w-full"/>
                </div>
                <div class="col-12 flex align-items-center justify-content-center">
                    <span v-if="errors.fio" class="p-error">{{ errors.fio[0] }}</span>
                </div>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="grid w-full flex justify-content-center align-items-center">
                <div class="col-12 md:col-4 flex justify-content-center">
                    <label for="calendar" class="m-4 font-semibold">Дата рождения</label>
                </div>
                <div class="col-12 md:col-4">
                    <Calendar v-model="form.birthday" dateFormat="dd-mm-yy" class="w-full"/>
                </div>
                <div class="col-12 flex align-items-center justify-content-center">
                    <span v-if="errors.birthday" class="p-error">{{ errors.birthday[0] }}</span>
                </div>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="grid w-full flex justify-content-center align-items-center">
                <div class="col-12 md:col-4 flex justify-content-center">
                    <label for="calendar" class="m-4 font-semibold">Выберите дату собеседования</label>
                </div>
                <div class="col-12 md:col-4 flex justify-content-center align-items-center">
                    <Calendar v-model="form.interview_date" dateFormat="dd-mm-yy" class="w-full"
                    name="interview_date" :showTime="true"
                    ></Calendar>
                </div>
                <div class="col-12 flex justify-content-center align-items-center">
                    <span v-if="errors.interview_date" class="p-error">{{ errors.interview_date[0] }}</span>
                </div>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="grid w-full flex justify-content-center align-items-center">
                <div class="col-12 md:col-4 flex justify-content-center">
                    <label for="about" class="m-4 font-semibold">О себе</label>
                </div>
                <div class="col-12 md:col-8 flex justify-content-center align-items-center">
                    <Textarea v-model="form.about" :autoResize="true" rows="5" cols="70" id="about" class="w-full"/>
                </div>
                <div class="col-12 md:col-8 flex justify-content-center align-items-center">
                    <span v-if="errors.about" class="p-error">{{ errors.about[0] }}</span>
                </div>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="grid w-full flex justify-content-center align-items-center">
                <div class="col-12 md:col-8 grid">
                    <div class="col-12 md:col-4 flex align-items-center justify-content-center">
                        <label class="font-semibold">Семейное положение</label>
                    </div>
                    <div class="col-12 md:col-8 flex justify-content-center align-items-center">
                        <div class="flex m-2 justify-content-center align-items-center">
                            <label for="ms1" class="m-1 font-semibold">Женат/Замужем </label>
                            <RadioButton name="marital_status" value="true" v-model="form.marital_status" id="ms1"/>
                        </div>
                        <div class="flex m-2 justify-content-center align-items-center">
                            <label for="ms2" class="m-1 font-semibold">Не женат/Не замужем </label>
                            <RadioButton name="marital_status" value="false" v-model="form.marital_status"  id="ms2"/>
                        </div>
                    </div>
                    <div class="col-12 flex justify-content-center align-items-center">
                        <span v-if="errors.marital_status" class="p-error">{{ errors.marital_status[0] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex align-content-around align-items-center flex-wrap card-container m-auto">
                <Button label="Отправить" @click="sendForm"/>
            </div>
        </div>
    </div>
</template>
<script>
import { required } from '@vuelidate/validators';
import { useVuelidate } from '@vuelidate/core';
import axios from 'axios';

export default {
    name: 'CandidateForm',
    data() {
        return {
            form: {
                fio: '',
                birthday:'01-01-1990',
                interview_date: '',
                interview_time: '',
                about: '',
                marital_status: null
            },
            messagesOverride: {
                fio: {
                    required/*: "You must fill the {attribute} field to continue"*/
                }
            },
            errors: []
        }
    },
    setup: () => ({ v$: useVuelidate() }),
    validations: {
        form: {
            fio: { required/*: "The {attribute} field is required xzcxzc"*/},
            birthday: { required },
        }
    },
    methods: {
        checkForm() {
            this.v$.form.$touch();
            if (!this.v$.form.$error) {
                console.log('Валидация прошла успешно')
            }
        },
        sendForm() {
            axios.post('/candidate', this.form)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(this.errors);
                });
        }
    }
}
</script>
<style>
.p-inputtextarea{
    padding: 30px!important;
}

.p-radiobutton .p-radiobutton-box.p-focus .p-radiobutton-icon {
    transform: translateZ(0) scale(0.8)!important;
    visibility: visible!important;
}
</style>
