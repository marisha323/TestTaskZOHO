<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">FORM</div>
                    <div class="m-2">
                        <div id="app">
                            <form @submit.prevent="submitForm">
                                <div class="form-group">
                                    <label for="agreementName">Назва угоди:</label>
                                    <input type="text" id="agreementName" class="form-control" name="agreementName" v-model="form.agreementName" required>
                                </div>
                                <div>

                                <label for="agreementStage">Етап угоди:</label>
                                    <select id="agreementStage" name="agreementStage" v-model="form.agreementStage" required class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>

                                </div>

                                <button type="submit" class="btn btn-info alert-primary m-sm-2">Відправити</button>
                            </form>

                        </div>
                    </div>

                    <div class="card-body">
                        Дякую, що скористались нашою послугою!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                agreementName: '',
                agreementStage: ''
            }
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/deal', this.form);
                console.log('Server response:', response.data);
                // Додайте логіку обробки відповіді від сервера за необхідності
            } catch (error) {
                console.error('Error submitting form:', error);
                // Обробте помилки, якщо такі є
            }
        },
    }
}
</script>
