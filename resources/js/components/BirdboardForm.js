import Axios from "axios";

class BirdboardForm {
    constructor(data) {        
        this.originalData = JSON.parse(JSON.stringify(data)); 

        Object.assign(this, data);

        this.erros = {};
    }

    data() {
        let data =  {};

        for (let attribute in this.originalData) {
            data[attribute] = this[attribute];
        }

        return data;
    }

    submit(endpoint) {
        axios.post(endpoint, this.data());
    }
}

export default BirdboardForm;