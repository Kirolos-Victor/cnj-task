<template>
    <div class="container">
        <form enctype="multipart/form-data">
            <div>
                <input type="file" @change="processFile($event)">
            </div>
            <div class="mt-3">
                <input type="checkbox" v-model="saveToDatabase"> Save to Database

            </div>
            <div class="mt-3">
                <button class="btn btn-primary" @click.prevent="uploadData">Submit</button>
            </div>
        </form>


        <div class="form mt-5 row">
            <div class="d-inline-flex col-12">
                <h4 class="fw-bold">Avg price: &nbsp;</h4>{{ averagePrice }}

            </div>
            <div class="d-inline-flex col-12">
                <h4 class="fw-bold">Total houses sold: &nbsp;</h4>{{ totalHousesSold }}

            </div>
            <div class="d-inline-flex col-12">
                <h4 class="fw-bold">No of crimes in 2011: &nbsp;</h4>{{ numberOfCrimes }}

            </div>
            <div class="col-12 mt-3">
                <h4 class="fw-bold">Avg price per year in London area:</h4>
                <div v-for="(value,key,index) in averagePricePerYear">
                    <strong>{{ key }}: </strong>{{ value }}
                </div>

            </div>

        </div>


    </div>

</template>

<script>
export default {
    name: "UploadComponent",
    data() {
        return {
            file: '',
            saveToDatabase: false,
            averagePrice: '',
            totalHousesSold: '',
            numberOfCrimes: '',
            averagePricePerYear: [],
            timeout: false,

        }
    },
    methods: {
        processFile(e) {
            this.file = e.target.files[0];
        },
        uploadData() {
            if (this.timeout) {
                alert('please wait...')
            } else {
                this.timeout = true;

                let form = new FormData();
                form.append('file', this.file);
                form.append('save_to_database', this.saveToDatabase)
                axios.post('/upload-data', form).then((data) => {
                    this.averagePrice = data.data.average_price;
                    this.totalHousesSold = data.data.total_houses_sold;
                    this.numberOfCrimes = data.data.number_of_crimes;
                    this.averagePricePerYear = data.data.average_price_per_year
                    this.timeout = false;

                }).catch(() => {
                    alert('error');
                    this.timeout = false;


                })
            }

        }
    }
}
</script>

<style scoped>

</style>
