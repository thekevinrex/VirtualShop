export function validateFieldData (val, validateOptions) {

    var response = {
        error : false,
        errorType : new Array(),
    }
    
    if (typeof val != 'string'){
        response.error = true;
        return response;
    }

    validateOptions.forEach ((validateOption) => {

        if (validateOption == 'String') {
            if (!/^\w*$/.test (val) ){
                response.error = true;
                response.errorType.push ('String');
            }
        }

        if (validateOption == 'Number') {
            if (!/^[0-9]*$/.test (val) ){
                response.error = true;
                response.errorType.push ('Number');
            }
        }

        if (validateOption == 'Vocal') {
            if (!/^[a-z]*$/.test (val) ){
                response.error = true;
                response.errorType.push ('Vocal');
            }
        }
        
        if (validateOption == 'Required') {
            if (val == ''){
                response.error = true;
                response.errorType.push ('Required');
            }
        }

        if (validateOption == 'Email') {
            if ( !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test (val)){
                response.error = true;
                response.errorType.push ('Email');
            }
        }

        if (validateOption == 'Password') {
            
            if (val.length < 8 || val.length > 20){
                response.error = true;
                response.errorType.push ('Password-length');
            }

            if (!/(?=.*[0-9])/.test (val)){
                response.error = true;
                response.errorType.push ('Password-numbers');
            }

            if (!/(?=.*[.!@#$%^&*])/.test (val)){
                response.error = true;
                response.errorType.push ('Password-symbols');
            }

            if (!/(?=.*[a-z])(?=.*[A-Z])/.test (val)){
                response.error = true;
                response.errorType.push ('Password-mixed');
            }
        }
    })

    return response;
}