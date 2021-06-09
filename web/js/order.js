'use strict';

const details = document.querySelectorAll('.details-button');
if (details) {
    for (let i = 0; i < details.length; i++) {
        details[i].addEventListener('click', e => {
            console.log(e.target.dataset.id);
            const id = e.target.dataset.id;
            $.ajax({
                url: '/cart/details',
                data: {id: id},
                type: 'GET',
                success: data => {
                    if (!data) {
                        alert('Ошибка');
                    }
                    document.body.insertAdjacentHTML('afterbegin', data);

                    const detailsFrom = document.querySelector('#details-form');
                    if (detailsFrom) {
                        const detailsClose = document.querySelector('#details-close');
                        detailsClose.addEventListener('click', e => {
                            detailsFrom.remove();
                        })
                    }
                },
                error: function() {
                    alert('Error!');
                }
            });
        });
    }
}

// function render(data){
//     return `
//         <div class="details" id="details-form">
//             <div class="container">
//                 <div class="details__box">
//                     <div class="details__close btn btn-dark" id="details-close">x</div>
//                 </div>
//             </div>
//         </div>
//         `
// }