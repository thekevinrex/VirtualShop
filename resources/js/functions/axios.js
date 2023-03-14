export function prepateAxiosErrorToDisplay(error) {
    
    console.log(error.message);

    if (error.response.data) {
        if (error.response.data.error) {
            return error.response.data.error;
        }
        if (error.response.data.message) {
            return error.response.data.message;
        }
        if (error.response.data.errors && typeof error.response.data.errors == 'object') {
            let message = [];

            Object.keys(error.response.data.errors).forEach(function (e) {
                message = [
                    ...message,
                    error.response.data.errors[e].flat(),
                ];
            });

            return message;
        }
    }

    return error.message;
}