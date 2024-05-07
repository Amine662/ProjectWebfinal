function debounce(func,delay) {
    let debounceTimer;
    return function() {
        const context=this;
        const args=arguments;
        clearTimeout(debounceTimer);
        debounceTimer=setTimeout(()=>func.apply(context,args),delay);
    }
} 

window.onload=function() {
    var ownerInput = document.querySelector('.owner .input-field input');
    var cvvInput = document.querySelector('.cvv .input-field input');
    var cardNumberInput = document.querySelector('.card-number .input-field input');

    ownerInput.oninput=debounce(function() {
        if (this.value.length<2) {
            alert('Owner name must be at least 2 characters long.');
        }
    }, 1000);

    cvvInput.oninput=debounce(function() {
        if(!/^\d{3}$/.test(this.value)) {
            alert('CVV must be exactly 3 digits.');
        }
    }, 1000);
    cardNumberInput.oninput=debounce(function() {
        if (!/^\d{16}$/.test(this.value)) {
            alert('Card number must be exactly 16 digits.');
        }
    }, 1000);
}
