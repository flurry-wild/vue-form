<template>
    <div class="card bg-green-500 p-5 m-auto">
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex align-content-around align-items-center flex-wrap card-container m-auto">
                <label for="fio" class="m-3 font-semibold">ФИО</label>
                <InputText type="text" v-model="form.fio" id="fio" class="m-3"/>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex align-content-around align-items-center flex-wrap card-container m-auto">
                <label for="calendar" class="m-4 font-semibold">Дата рождения</label>
                <InputMask v-model="form.birthday" mask="99/99/9999" slotChar="mm/dd/yyyy"/>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex align-content-around align-items-center flex-wrap card-container m-auto">
                <label for="calendar" class="m-4 font-semibold">Выберите дату собеседования</label>
                <Calendar id="calendar"></Calendar>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex align-content-around align-items-center flex-wrap card-container m-auto">
                <label for="about" class="m-4 font-semibold">О себе</label>
                <Textarea v-model="form.about" :autoResize="true" rows="5" cols="70" id="about"/>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex flex-column align-content-around align-items-center flex-wrap card-container m-auto">
                <div class="flex flex-row flex-wrap">
                    <label class="m-4 font-semibold">Семейное положение</label>
                    <div class="flex flex-row flex-wrap m-2 align-items-center">
                        <label for="ms1" class="m-1 font-semibold">Женат/Замужем </label>
                        <RadioButton name="marital_status" value="true" v-model="marital_status" id="ms1"/>
                    </div>
                    <div class="flex flex-row flex-wrap m-2 align-items-center">
                        <label for="ms2" class="m-1 font-semibold">Не женат/Не замужем </label>
                        <RadioButton name="marital_status" value="false" v-model="marital_status"  id="ms2"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex align-content-around align-items-center flex-wrap card-container m-auto">
                <Button label="Отправить" @click="checkForm"/>
            </div>
        </div>
        <div class="p-inputgroup mt-5 bg-green-400 p-6 border-round">
            <div class="flex align-content-around align-items-center flex-wrap card-container m-auto">
                <small class="p-error" v-for="(error, index) of v$.$errors" :key="index">
                    <strong>{{ error.$validator }}</strong>
                    <small> on property</small>
                    <strong>{{ error.$property }}</strong>
                    <small> says:</small>
                    <strong>{{ /*messagesOverride[error.$property][error.$validator]*/error.message }}</strong>
                </small>
            </div>
        </div>
    </div>
</template>
<script>
import { required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'

export default {
    name: 'CandidateForm',
    data() {
        return {
            form: {
                fio: '',
                birthday:'01/01/1990',
                about: '',
                marital_status: true
            },
            messagesOverride: {
                fio: {
                    required/*: "You must fill the {attribute} field to continue"*/
                }
            }
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
