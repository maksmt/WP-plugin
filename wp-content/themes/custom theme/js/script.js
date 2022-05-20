// $(".like__text").click(function () {
//     document.querySelector('.like__text ').classList.toggle('hide');
//     document.querySelector('.liked__text ').classList.toggle('show');
// });
// if (className('hide')) {
//     $(".liked__text").click(function () {
//         document.querySelectorAll('.liked__text ').classList.remove('hide');
//         document.querySelectorAll('.like__text ').classList.toggle('show');
//     });


// }



jQuery(function ($) {

    // определяем в переменные кнопку, текущую страницу и максимальное кол-во страниц
    var button = $('#loadmore a'),
        paged = button.data('paged'),
        maxPages = button.data('max_pages');

    button.click(function (event) {

        event.preventDefault(); // предотвращаем клик по ссылке

        var request = new XMLHttpRequest();
        $.ajax({
            beforeSend: function (request) {
                button.text('Loading...');
                request.setRequestHeader('X-WP-Nonce', more.nonce);
            },
            type: 'POST',
            url: more.root_url + '/wp-json/wp/v2/old_events/', // получаем из wp_localize_script()
            data: {
                paged: paged, // номер текущей страниц
                action: 'loadmore' // экшен для wp_ajax_ и wp_ajax_nopriv_
            },

            success: function (data) {

                paged++; // инкремент номера страницы
                button.parent().before(data);
                button.text('Load more');
                // если последняя страница, то удаляем кнопку
                if (paged == maxPages) {
                    button.remove();
                }

            }

        });

    });
});