'use strict';

document.querySelector('.btn-menu').addEventListener('click', e => {
    let parent = e.target.parentElement;
    if (e.targetName !== 'BUTTON') {
        parent = e.target.parentElement.parentElement;
    }
    parent.querySelector('.menu').classList.toggle('visible');
});

const cart = document.querySelector('.cart');
if (cart) {
    document.querySelector('.btn-cart').addEventListener('click', e => {
        let parent = e.target.parentElement;
        if (e.targetName !== 'BUTTON') {
            parent = e.target.parentElement.parentElement;
        }
        parent.querySelector('.header__cart').classList.toggle('visible');
        const account = document.querySelector('.header__account');
        if (account) {
            account.classList.remove('visible');
        }
    });
}

const account = document.querySelector('.btn-account');
if (account) {
    account.addEventListener('click', e => {
        let parent = e.target.parentElement;
        if (e.targetName !== 'BUTTON') {
            parent = e.target.parentElement.parentElement;
        }
        parent.querySelector('.header__account').classList.toggle('visible');
        parent.querySelector('.header__cart').classList.remove('visible');
    });
}

const manufacturer = document.querySelector('#manufacturer')
if (manufacturer) {
    manufacturer.addEventListener('change', e => {
        if (+e.target.value !== 0) {
            document.querySelector('#model').classList.remove('novisible');
            document.querySelector('#model').classList.add('visible');
        } else {
            document.querySelector('#model').classList.remove('visible');
            document.querySelector('#model').classList.add('novisible');
        }
    });
}
