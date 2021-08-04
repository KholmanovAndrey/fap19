'use strict';

const delivery = document.querySelector('#delivery');
const payment = document.querySelector('#payment');
const transport = document.querySelector('#transport');
payment.classList.add('paymentHide');
transport.classList.add('paymentHide');
payment.querySelector('.payment-radio-1').classList.add('paymentHide');

delivery.addEventListener('click', e => {
    if (e.target.tagName === 'INPUT') {
        payment.classList.remove('paymentHide');
        if (+e.target.value === 1) {
            payment.querySelector('.payment-radio-1').classList.remove('paymentHide');
            transport.classList.add('paymentHide');
        } else {
            payment.querySelector('.payment-radio-1').classList.add('paymentHide');
            transport.classList.remove('paymentHide');
        }
    }
});

delivery.querySelector('.help-block').addEventListener('click', e => {
    console.log(e.target);
});
