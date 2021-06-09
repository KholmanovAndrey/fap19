"use strict";

const addCart = document.querySelector('.add-to-cart');
if (addCart) {
    addCart.addEventListener('click', function(e) {
        e.preventDefault();

        const id = this.dataset.id;
        const qty = $('#qty').val();
        const elem = this;

        $.ajax({
            url: '/cart/add',
            data: {id: id, qty: qty},
            type: 'GET',
            success: function(res) {
                if (!res) {
                    alert('Ошибка');
                }

                deleteCart('.cartItems');
                createCart(res, '.cartBox', 'cartItems');
            },
            error: function() {
                alert('Error!');
            }
        });
    });
}

const cartClear = document.querySelector('.cartClear');
if (cartClear) {
    cartClear.addEventListener('click', function (e) {
        e.preventDefault();

        clearCart();
    });
}

const cartOneClear = document.querySelector('.cartOneClear');
if (cartOneClear) {
    cartOneClear.addEventListener('click', function (e) {
        e.preventDefault();

        clearCart();
    });
}

$('.cartOne').on('click', '.cart__elem_del', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function(res) {
            if (!res) {
                alert('Ошибка');
            }

            deleteCart('.cartItems');
            createCart(res, '.cartBox', 'cartItems');
        },
        error: function() {
            alert('Error!');
        }
    });
});

$('.cart').on('click', '.cart__elem_del', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function(res) {
            if (!res) {
                alert('Ошибка');
            }

            deleteCart('.cartItems');
            createCart(res, '.cartBox', 'cartItems');
        },
        error: function() {
            alert('Error!');
        }
    });
});

/**
 * Создание и вывод сообщение о несоответсвий условию валидации
 * @param {object} element - объект проверки
 * @param {string} text - строка для вывода сообщения
 */
function createCart(text, selectorContainer, classCart) {
    const parentElement = document.querySelector(selectorContainer);
    const messageDiv = document.createElement('div');
    messageDiv.innerHTML = text;
    messageDiv.classList.add(classCart);
    parentElement.appendChild(messageDiv);
}

/**
 * Удаление сообщения
 * @param {object} element - объект проверки
 */
function deleteCart(classCart) {
    const invalid = document.querySelector(classCart);
    if (invalid) {
        invalid.remove();
    }
}

function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function(res) {
            if (!res) {
                alert('Ошибка');
            }

            deleteCart('.cartItems');
            createCart(res, '.cartBox', 'cartItems');
        },
        error: function() {
            alert('Error!');
        }
    });
}
