if(result['success']){
    iziToast.success({
        title: 'Success!',
        message: result['success'],
        position: 'topRight'
    });
}else if(result['error']){
    iziToast.error({
        title: 'Oops!',
        message: result['error'],
        position: 'topRight'
    });
}else if(result['warning']){
    iziToast.warning({
        title: 'Warning!',
        message: result['warning'],
        position: 'topRight'
    });
}else if(result['info']){
    iziToast.info({
        title: '',
        message: result['info'],
        position: 'topRight'
    });
}else{
    iziToast.default({
        title: '',
        message: result['default'],
        position: 'topRight'
    });
}