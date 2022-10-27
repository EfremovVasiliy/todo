'use strict';

import {jquery} from 'jquery';

const btns = document.querySelectorAll('.delete-btn');

function deleteTask() {
    jQuery(document).ready(function($) {
        btns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();

                const taskId = e.target.getAttribute('data-task-id');

                $.ajax({
                    url: '/delete',
                    type: 'DELETE',
                    data: taskId,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(msg) {
                        console.log(msg);
                    }
                });
            });
        });
    });

}
deleteTask();