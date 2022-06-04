/**
 * @ Created by: VSCode
 * @ Author: @LiviuH - codepen.io
 * @ Create Time: 2021-09-09 16:35:17
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-02 18:21:25
 * @ Description: Happy Coding!
 */

/* * * * * * * * * * * * * * * * *
 * Pagination
 * javascript page navigation
 * * * * * * * * * * * * * * * * */

var Pagination = {

    code: '',

    // --------------------
    // Utility
    // --------------------

    // converting initialize data
    Extend: function(data, callback) {
        data = data || {};
        Pagination.size = data.size || 300;
        Pagination.page = data.page || 1;
        Pagination.step = data.step || 3;
        Pagination.callback = callback;
    },

    // add pages by number (from [s] to [f])
    Add: function(s, f) {
        for (var i = s; i < f; i++) {
            Pagination.code += '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page="' + i + '">' + i + '</a></li>';
        }
    },

    // add last page with separator
    Last: function() {
        Pagination.code += '<li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li><li class="page-item"><a class="page-link" href="javascript:void(0)" data-page="' + (Pagination.size) + '">' + Pagination.size + '</a></li>';
        Pagination.code += '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page="' + (Pagination.page + 1) + '"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>'; // next button
    },

    // add first page with separator
    First: function() {
        Pagination.code += '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page="' + (Pagination.page - 1) + '"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>'; // previous button
        Pagination.code += '<li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li><li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>';
    },



    // --------------------
    // Handlers
    // --------------------

    // change page
    Click: function() {
        Pagination.page = +this.getAttribute('data-page');
        Pagination.Start();
        Pagination.callback('page', Pagination.page);
        return false;
    },

    // previous page
    Prev: function() {
        Pagination.page--;
        if (Pagination.page < 1) {
            Pagination.page = 1;
        }
        Pagination.Start();
    },

    // next page
    Next: function() {
        Pagination.page++;
        if (Pagination.page > Pagination.size) {
            Pagination.page = Pagination.size;
        }
        Pagination.Start();
    },



    // --------------------
    // Script
    // --------------------

    // binding pages
    Bind: function() {
        var a = Pagination.e.getElementsByTagName('a');
        for (var i = 0; i < a.length; i++) {
            if (+a[i].innerHTML === Pagination.page) {
                a[i].classList.add('current');
                a[i].parentElement.classList.add('active');
            }
            a[i].addEventListener('click', Pagination.Click, false);
        }
    },

    // write pagination
    Finish: function() {
        Pagination.e.innerHTML = Pagination.code;
        Pagination.code = '';
        Pagination.Bind();
    },

    // find pagination type
    Start: function() {
        if (Pagination.size < Pagination.step * 2 + 6) {
            Pagination.Add(1, Pagination.size + 1);
        } else if (Pagination.page < Pagination.step * 2 + 1) {
            Pagination.Add(1, Pagination.step * 2 + 4);
            Pagination.Last();
        } else if (Pagination.page > Pagination.size - Pagination.step * 2) {
            Pagination.First();
            Pagination.Add(Pagination.size - Pagination.step * 2 - 2, Pagination.size + 1);
        } else {
            Pagination.First();
            Pagination.Add(Pagination.page - Pagination.step, Pagination.page + Pagination.step + 1);
            Pagination.Last();
        }
        Pagination.Finish();
    },



    // --------------------
    // Initialization
    // --------------------

    // binding buttons
    Buttons: function(e) {
        var nav = e.getElementsByTagName('a');
        nav[0].addEventListener('click', Pagination.Prev, false);
        nav[1].addEventListener('click', Pagination.Next, false);
    },

    // create skeleton
    Create: function(e) {

        var html = [
            // '<li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>', // previous button
            '<ul class="pagination"></ul>', // pagination container
            // '<li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>' // next button
        ];

        e.innerHTML = html.join('');
        Pagination.e = e.getElementsByTagName('ul')[0];
        // Pagination.Buttons(e);
    },

    // init
    Init: function(e, data, callback) {
        Pagination.Extend(data, callback);
        Pagination.Create(e);
        Pagination.Start();
    }
};



/* * * * * * * * * * * * * * * * *
 * Initialization
 * * * * * * * * * * * * * * * * */

// var init = function () {
//     Pagination.Init(document.getElementById('pagination'), {
//         size: 1000, // pages size
//         page: 1,  // selected page
//         step: 3   // pages before and after current
//     });
// };

// document.addEventListener('DOMContentLoaded', init, false);