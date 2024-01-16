<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">FORM</div>
                    <div id="app">
                        <div class="m-3">
                            <form @submit.prevent="submitForm">
                                <div class="form-group">
                                    <label for="agreementName">Account Name</label>
                                    <input type="text" class="form-control" id="accountName" v-model="form.accountName" required>
                                </div>


                                <div>
                                    <label for="agreementStage">Website</label>
                                    <input type="text" name="website" class="form-control" id="website" v-model="form.website" required>
                                </div>
                                <div>
                                    <label for="agreementStage">Phone</label>
                                    <input type="text" name="phone" v-model="form.phone" class="form-control" id="phone" required>
                                </div>

                                <button id="buttonCreateDeal" type="submit" class="btn btn-info alert-primary m-sm-2">Відправити</button>
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
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                accountName: '',
                website: '',
                phone: '',
            },
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/suppliers', this.form);
                console.log('Server response:', response.data);
                // Додайте логіку обробки відповіді від сервера за необхідності
            } catch (error) {
                console.error('Error submitting form:', error);
                // Обробте помилки, якщо такі є
            }
        },
    },
};
</script>
