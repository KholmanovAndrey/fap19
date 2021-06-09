"use strict";

const search = document.querySelector('#search');

if (search) {
    const manufacturer = document.querySelector('#manufacturer');
    manufacturer.addEventListener('change', function() {
        const id = this.value;
        $.ajax({
            url: '/category/select',
            data: {id: id},
            type: 'GET',
            success: data => {
                const model = document.querySelector('#model');
                model.textContent = '';
                model.insertAdjacentHTML('beforeend', '<option value="0">Выбрать</option>');
                model.insertAdjacentHTML('beforeend', data);
            },
            error: function() {
                alert('Error!');
            }
        });
    });
}
