"use strict";

class BasketList {
    constructor(){
        this.init();
    }
    init(){
        this._getBasket();
        const addToBasket = document.querySelector('.product-view');
        if (addToBasket) {
            addToBasket.addEventListener('click', e => {
                if (e.target.classList.contains('add-to-cart')) {
                    e.preventDefault();
                    this._addToBasket(e.target);
                }
            });
        }
        const deleteBasketCart = document.querySelector('.cart');
        if (deleteBasketCart) {
            deleteBasketCart.addEventListener('click', e => {
                if (e.target.classList.contains('btn-del')) {
                    e.preventDefault();
                    this._deleteFromBasket(e.target);
                }
            });
        }
        const deleteBasketCartOne = document.querySelector('.cart-ones');
        if (deleteBasketCartOne) {
            deleteBasketCartOne.addEventListener('click', e => {
                if (e.target.classList.contains('btn-del')) {
                    e.preventDefault();
                    this._deleteFromBasket(e.target, 'index');
                }
            });
        }
    }
    _getBasket(){
        fetch(`/cart/get`)
            .then(result => result.text())
            .then(data => {
                this.render(data);
            })
            .catch(error => {
                console.log(error)
            });
    }
    _addToBasket(item){
        const id = item.dataset.id;
        const qty = $('#qty').val();
        $.ajax({
            url: '/cart/add',
            data: {id: id, qty: qty},
            type: 'GET',
            success: data => {
                if (!data) {
                    alert('Ошибка');
                }
                this.render(data);
            },
            error: function() {
                alert('Error!');
            }
        });
    }
    _deleteFromBasket(item, page = 'ajax'){
        const id = item.dataset.id;
        $.ajax({
            url: '/cart/delete',
            data: {id: id, page: page},
            type: 'GET',
            success: data => {
                if (!data) {
                    alert('Ошибка');
                }
                this.render(data, page);
            },
            error: function() {
                alert('Error!');
            }
        });
    }
    render(data, page = 'ajax'){
        if (page === 'ajax') {
            const cart = document.querySelector('.cart');
            if (cart) {
                cart.innerText = '';
                cart.insertAdjacentHTML('beforeend', data);
            }
        }
        if (page === 'index') {
            const cart = document.querySelector('.cart-ones');
            if (cart) {
                cart.innerText = '';
                cart.insertAdjacentHTML('beforeend', data);
            }
        }


    }
}

let basket = new BasketList();