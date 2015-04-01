var _accountEmail;

$(".backService-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.service-id').html());
    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'service');
});

$(".backProjects-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.projects-id').html());

    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'projects');
});

$(".backVisitor-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.visitor-id').html());

    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'visitor');
});

$(".backInteractive-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.interactive-id').html());

    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'interactive');
});

$(".backSlider-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.slider-id').html());

    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'slider');
});

$(".backCatalog-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.catalog-id').html());
    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'store/catalog');
});

$(".backHRDepartments-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.catalog-id').html());
    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'hr/departments');
});

$(".backCatalogItem-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.catalog-item-id').html());
    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _back_ajax(data, '_hide', action, this, 'store/catalog/product');
});

function _back_ajax(data, item, action, self, controller) {
    var url = '/back/' + controller + '/' + item.split('_').pop();
    var result = $.ajax({
        type: 'post',
        url: url,
        data: data,
        async: false,
        success: function(data) {
            if (data.response == true) {
                return data;
            } else {
                return false;
            }
        },
        error: function() {
        }
    }).responseText;
    result = JSON.parse(result);
    console.log(url);
    console.log(data);
    console.log(result);
    if (result.message == true) {
        action == 1 ? $(self).html(translate.yes) : $(self).html(translate.no);
        $(self).attr(item, action);
    }
}

$("[name='my-checkbox']").bootstrapSwitch();

//







































$(document)
    .on('click', '#posted', function() {
        $('#dateOfPostDiv').toggle();
    })
;

$("#news-filter").change(function () {
    var end = this.value;

    if (end != 0)
    {
        window.location.href = '/backend/news/' + end;
    }
    else
    {
        window.location.href = '/backend/news';
    }
});
/*
End of news
 */

/*
 Library
 */

$(document)

    /*
    Open work
     */
    .on('click', '.work-item', function() {
        $('#_work-content').val($.trim($(this).find('._content').html()));
        tempObj = $(this);
        tempValue = tempObj.attr('index');

        return false;
    })

    /*
    Make work
     */
    .on('click', '#make-work', function() {
        var result = server_request('lib', 'makeWork', {
            'id': tempValue
        }, 1);

        if (result) {
            $('#showWork').modal('toggle');
            tempObj.remove();
        }
        else
        {
            alert('Виникла помилка системи');
        }
    })
;

$(".lib-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.lib-id').html());
    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _lib_ajax(data, '_hide', action, this);
});

function _lib_ajax(data, item, action, self) {
    var url = '';

    _page = page;
    page = parseInt(page) - 1;
    _sorting = sorting;
    sorting = parseInt(sorting) - 1;
    var count = 0;
    if (page) {
        count = 5;
    } else if (sorting) {
        count = 3;
    }
    for (i=0;i<count;i++) {
        url += '../';
    }
    url += 'lib/' + item.split('_').pop();
    var result = $.ajax({
        type: 'post',
        url: url,
        data: data,
        async: false,
        success: function(data) {
            if (data.response == true) {
                return data;
            } else {
                return false;
            }
        },
        error: function() {
        }
    }).responseText;
    result = JSON.parse(result);
    if (result.message == true) {
        action == 1 ? $(self).html(translate.yes) : $(self).html(translate.no);
        $(self).attr(item, action);
    }
    page = _page;
    sorting = _sorting;
}
/*
 End of library
 */

/*
Docs
 */
$(".doc-hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.doc-id').html());
    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _docs_ajax(data, '_hide', action, this);
});

function _docs_ajax(data, item, action, self) {
    var url = '';

    _page = page;
    page = parseInt(page) - 1;
    _sorting = sorting;
    sorting = parseInt(sorting) - 1;
    var count = 0;
    if (page) {
        count = 5;
    } else if (sorting) {
        count = 3;
    }
    for (i=0;i<count;i++) {
        url += '../';
    }
    url += 'docs/' + item.split('_').pop();
    var result = $.ajax({
        type: 'post',
        url: url,
        data: data,
        async: false,
        success: function(data) {
            if (data.response == true) {
                return data;
            } else {
                return false;
            }
        },
        error: function() {
        }
    }).responseText;
    result = JSON.parse(result);
    if (result.message == true) {
        action == 1 ? $(self).html(translate.yes) : $(self).html(translate.no);
        $(self).attr(item, action);
    }
    page = _page;
    sorting = _sorting;
}
/*
End of docs
 */

/*
Server request function realise AJAX
 */
function server_request(controller, action, data, debug) {
    var result = $.ajax({
        type: 'post',
        url: controller + '/' + action,
        data: data,
        async: false,
        success: function(data) {
            if (data.response == true) {
                return data;
            } else {
                return false;
            }
        },
        error: function() {
        }
    }).responseText;
    if (debug) {
        console.log('URL: ' + controller + '/' + action);
        console.log('DATA: ');
        console.log(data);
        console.log('Result: ');
        console.log(result);
    }
    return JSON.parse(result);
}



/*
Legal advice
 */
jQuery(document)

    /*
    Remove lawyer
     */
    .on('click', '#_edit-delete-lawyer', function() {
        var result = server_request('legal', 'removeLawyer', {
            'id': tempValue
        });

        if (result) {
            $('#editLawyer').modal('toggle');
            tempObj.parent().remove();
        }
        else
        {
            alert('Виникла помилка системи');
        }
    })

    /*
     Reject question
     */
    .on('click', '#remove-question', function() {

        var result = server_request('legal', 'removeQuestion', {
            'id': tempValue
        });

        if (result) {
            $('#openQuestion').modal('toggle');
            $('#removeQuestion').modal('toggle');
            tempObj.remove();
        }
        else
        {
            alert('Виникла помилка системи');
        }
    })

    /*
     Reject question
     */
    .on('click', '#reject-question', function() {

        var result = server_request('legal', 'rejectQuestion', {
            'id': tempValue
        });

        if (result) {
            $('#openQuestion').modal('toggle');
            tempObj.remove();
        }
//        else
//        {
//            alert('Виникла помилка системи');
//        }
    })

    /*
    Show on front
     */
    .on('click', '#show-question', function() {
        var answer = jQuery.trim($('#q-answer').val());
        if (!answer)
        {
            $('#q-message').show();
        }
        else
        {
            $('#q-message').hide();
            var result = server_request('legal', 'showQuestion', {
                'id': tempValue,
                'hide': 0,
                'confirmed': 1,
                'answer': answer,
                'accountEmail': _accountEmail
            });
        }

        if (result) {
            $('#openQuestion').modal('toggle');
            tempObj.remove();
        }
//        else
//        {
//            alert('Виникла помилка системи');
//        }
    })

    /*
    Open question
     */
    .on('click', '.question-item', function() {
        $('#q-answer').val('');

        $('.q-title').html(
            $(this).find('._q-title').html()
        );

        $('.q-content').html(
            $(this).find('._q-content').html()
        );

        $('.q-firstName').html(
            $(this).find('._q-firstName').html()
        );

        $('.q-created').html(
            $(this).find('._q-created').html()
        );

        _accountEmail = $(this).find('._q-accountEmail').html();

        tempValue = jQuery(this).attr('index');
        tempObj = jQuery(this);
    })

    /*
    Save city
     */
    .on('click', '#save-city', function() {
        var title = jQuery.trim($('#city-title').val());

        if (title != '') {
            var data = {
                _title: title
            };
            var result = server_request('legal', 'add', data);

            $('.city-block').prepend(
                '<div class="panel panel-default">' +
                    '<div class="panel-heading">' +
                        '<h4 class="panel-title">' +
                            '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' + result.message + '" index="' + result.message + '" class="">' +
                                title +
                            '</a>' +
                        '</h4>' +
                    '</div>' +
                    '<div id="collapse-' + result.message + '" class="panel-collapse in" style="height: auto;">' +
                        '<div class="panel-body city-control" index="' + result.message + '">' +
//                            '<button data-toggle="modal" data-target="#addLawyer" id="add-lawyer" name="add-lawyer" class="btn btn-primary" style="padding: 0 20px">' +
//                                'Додати юриста' +
//                            '</button>' +
                            '<button data-toggle="modal" data-target="#removeCity" id="remove-city" name="remove-city" class="btn btn-danger pull-right" style="padding: 0 20px">' +
                                'Видалити' +
                            '</button>' +
                        '</div>' +
                        '<div class="panel-body">' +
                            '<ul class="list-unstyled list-spaces lawyers-list">' +
                            '</ul>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );

            $('#addCity').modal('toggle');

            $('#city-title').val('');
        }
    })

    /*
    Delete city  form
     */
    .on('click', '#remove-city', function() {
        tempValue = parseInt($(this).closest('.city-control').attr('index'));
        tempObj = $(this);
    })

    /*
    Real delete city and lawyers method
     */
    .on('click', '#_delete-city', function() {
        var data = { id: tempValue };
        tempValue = null;
        var result = server_request('legal', 'delete', data);
        if (result) {
            tempObj.closest('.panel-default').remove();
            tempObj = null;
        }
        $('#removeCity').modal('toggle');
    })

    /*
    Add lawyer form
     */
    .on('click', '#add-lawyer', function() {
        tempValue = parseInt($(this).closest('.city-control').attr('index'));
        tempObj = $(this);
        $('.city-block').find('.current-edit').removeClass('current-edit');
        tempObj.parent().parent().parent().addClass('current-edit');
    })

    /*
    Add lawyer
     */
    .on('click', '#_save-lawyer', function() {

        var firstName = jQuery.trim(jQuery('#lawyer-firstName').val());
        var secondName = jQuery.trim(jQuery('#lawyer-secondName').val());
        var lastName = jQuery.trim(jQuery('#lawyer-lastName').val());
        var info = jQuery.trim(jQuery('#lawyer-info').val());

        if (firstName == '' ||
            secondName == '' ||
            lastName == '' ||
            info == '') {
            $('#lawyer-sys-message').toggle();
        } else {
            $('#lawyer-sys-message').hide();
            var data = {
                'idCity': tempValue,
                'firstName': firstName,
                'secondName': secondName,
                'lastName': lastName,
                'info': info
            };
            var result = server_request('legal', 'addLawyer', data);
            if (result) {
                $('.current-edit').find('.lawyers-list').prepend(
                    '<li index="' + result.message + '">' +
                        '<a data-toggle="modal" data-target="#editLawyer" class="edit-lawyer" name="edit-city" href="#">' +
                            '<span class="_lastName">' + lastName + ' </span>' +
                            '<span class="_firstName">' + firstName + ' </span>' +
                            '<span class="_secondName">' + secondName + '</span>' +
                        '</a>' +
                        '<br>' +
                        '<span class="small text-muted _lawyerInfo">' + info + '</span>' +
                    '</li>'
                );
                $('#addLawyer').modal('toggle');

                $('#lawyer-firstName').val('');
                $('#lawyer-secondName').val('');
                $('#lawyer-lastName').val('');
                $('#lawyer-info').val('');
            } else {
                alert('Виникла помилка сервера');
            }
        }
    })

    /*
    Edit lawyer
     */
    .on('click', '.edit-lawyer', function() {
        $('#edit-lawyer-firstName').val($.trim($(this).find('._firstName').html()));
        $('#edit-lawyer-lastName').val($.trim($(this).find('._lastName').html()));
        $('#edit-lawyer-secondName').val($.trim($(this).find('._secondName').html()));
        $('#edit-lawyer-info').html($.trim($(this).parent().find('._lawyerInfo').html()));
        tempObj = $(this);
        tempValue = tempObj.parent().attr('index');

        return false;
    })

    /*
     Edit lawyer
     */
    .on('click', '#_edit-save-lawyer', function() {

        var firstName = jQuery.trim(jQuery('#edit-lawyer-firstName').val());
        var secondName = jQuery.trim(jQuery('#edit-lawyer-secondName').val());
        var lastName = jQuery.trim(jQuery('#edit-lawyer-lastName').val());
        var info = jQuery.trim(jQuery('#edit-lawyer-info').val());

        if (firstName == '' ||
            secondName == '' ||
            lastName == '' ||
            info == '') {
            $('#lawyer-sys-message').toggle();
        } else {
            $('#lawyer-sys-message').hide();
            var data = {
                'id': tempValue,
                'firstName': firstName,
                'secondName': secondName,
                'lastName': lastName,
                'info': info
            };
            var result = server_request('legal', 'editLawyer', data);
            if (result) {
                $(tempObj).find('._firstName').html(firstName + ' ');
                $(tempObj).find('._secondName').html(secondName);
                $(tempObj).find('._lastName').html(lastName + ' ');
                $(tempObj).parent().find('._lawyerInfo').html(info);
                $('#editLawyer').modal('toggle');

                $('#edit-lawyer-firstName').val('');
                $('#edit-lawyer-secondName').val('');
                $('#edit-lawyer-lastName').val('');
//                $('#edit-lawyer-info').val('');
            } else {
                alert('Виникла помилка сервера');
            }
        }
    })

    /*
    Open city to load lawyers list
     */
    .on('click', '.open-city', function() {
        $(this).closest('.panel-heading').next().find('.lawyers-list').html('');

        var id = jQuery(this).attr('index');
        var data = {
            id: id
        };

        var result = server_request('legal', 'getLawyers', data);
        if (result) {
            for (var i=0;i<result.message.length;i++) {
                $(this).closest('.panel-heading').next().find('.lawyers-list').prepend(
                    '<li index="' + result.message[i].id + '">' +
                        '<a data-toggle="modal" data-target="#editLawyer" class="edit-lawyer" name="edit-city" href="">' +
                            '<span class="_lastName">' + result.message[i].lastName + ' </span>' +
                            '<span class="_firstName">' + result.message[i].firstName + ' </span>' +
                            '<span class="_secondName">' + result.message[i].secondName + '</span>' +
                        '</a>' +
                        '<br>' +
                        '<span class="small text-muted _lawyerInfo">' + result.message[i].info + '</span>' +
                    '</li>'
                );
            }
        }
    })
;
/*
End of Legal advice
 */


/*
Tree
 */
$(document)

    /*
    Node click
     */
    .on('click', '.tree-node', function() {
        $('#node-title').val($.trim($(this).text()));
        $('#node-description').val($.trim($(this).next().html()));
        $('#state-tree').find('.active-edit').removeClass('active-edit');
        $(this).addClass('active-edit');
    })
    /*
    Edit save
     */
    .on('click', '#save-sub-tree', function() {
        $('#state-tree').find('.active-edit').text(
            $('#node-title').val()
        ).next().text(
            $('#node-description').val()
        );
        $('#editModal').modal('toggle');
    })
    /*
    Edit remove
     */
    .on('click', '#remove-sub-tree', function() {
        $('#state-tree').find('.active-edit').parent().remove();
        $('#editModal').modal('toggle');
    })
    /*
    Edit Add sub node
     */
    .on('click', '#add-sub-tree', function() {

        var epoch = new Date().getTime();

        if($('#state-tree').find('.active-edit').next().next().prop('tagName')) {
            $('#state-tree').find('.active-edit').next().next().append(
                '<li>' +
                    '<span class="tree-node" data-toggle="modal" data-target="#editModal">' +
                        '<i class="icon-leaf"></i> ' +
                        'назва ...' +
                    '</span> ' +
                    '<a href="/backend-state-item/add/' + epoch + '" target="_blank">опис ...</a>' +
                '</li>'
            );
        } else {
            $('#state-tree').find('.active-edit').parent().append(
                '<ul>' +
                    '<li>' +
                        '<span class="tree-node" data-toggle="modal" data-target="#editModal">' +
                            '<i class="icon-leaf"></i> ' +
                            'назва ...' +
                        '</span> ' +
                        '<a href="/backend-state-item/add/' + epoch + '" target="_blank">опис ...</a>' +
                    '</li>' +
                '</ul>'
            );
        }
        $('#editModal').modal('toggle');
    });

$('#save-to-server').on('click', function() {
    var result = server_request(
        'backend-state',
        'update',
        { content: $('#tree-content').html() }
    );
    if (result) {
        alert('Збережено');
    }
});

$('#save-to-server-public').on('click', function() {
    var result = server_request(
        'backend-state',
        'update',
        {
            content: $('#tree-content').html(),
            public: 1
        }
    );
    if (result) {
        alert('Опубліковано на сайті');
    }
});

$('#close-tree').on('click', function() {
    $('#tree-title').val('');
    $('#tree-description').val('');
    $('#sys-message').hide();
    
});

$('#save-tree').on('click', function() {
    var title = $('#tree-title').val();
    var description = $('#tree-description').val();

    if (title == '') {
        $('#sys-message').toggle();
    } else {

        var epoch = new Date().getTime();

        if (!$.trim(description)) {
            description = 'відкрити';
        }

        $('#state-tree .main').append(
            '<li>' +
                '<span class="tree-node" data-toggle="modal" data-target="#editModal">' +
                    '<i class="icon-folder-open"></i> ' +
                    title +
                '</span> ' +
                '<a href="/backend-state-item/add/' + epoch + '" target="_blank"> ' + description + ' </a>' +
            '</li>'
        );

        //'<div class="tree well" id="state-tree"><ul class="main"></ul></div>'
        $('#myModal').modal('toggle');
        $('#tree-title').val('');
        $('#tree-description').val('');
        $('#sys-message').hide();
    }
});
// end of tree

function _ajax(data, item, action, self) {
    url = '/backend/news/' + item.split('_').pop();
    var result = $.ajax({
        type: 'post',
        url: url,
        data: data,
        async: false,
        success: function(data) {
            if (data.response == true) {
                return data;
            } else {
                return false;
            }
        },
        error: function() {
        }
    }).responseText;
    result = JSON.parse(result);
    if (result.message == true) {
        action == 1 ? $(self).html(translate.yes) : $(self).html(translate.no);
        $(self).attr(item, action);
    }
}

$(".analytics-change").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.news-id').html());
    var action = parseInt($(this).attr('_analytics'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _ajax(data, '_analytics', action, this);
});

$(".hide-show").on('click', function(event){
    event.preventDefault();

    var id = parseInt($(this).closest('tr').find('.news-id').html());
    var action = parseInt($(this).attr('_hide'));
    action ? action = 0 : action = 1;

    var data = {
        id: id,
        action: action
    };

    _ajax(data, '_hide', action, this);
});

$("#create").on('click', function(event){
    event.preventDefault();
    $.post("backend/add", null,
        function(data){
            if(data.response == true) {
                console.log(data);
            } else {
                console.log('could not add');
            }
        }, 'json');
});

$('#write-to-session').on('click', function(event) {
    event.preventDefault();
    $.post("backend/update", {
        id: 'Girl, I just love this',
        content: 'some content, with Love'
    },function(data){
        if(data.response == false){
            // print error message
            console.log('could not update');
        }
    }, 'json');
});

(function($)
{
    /**
     * Auto-growing textareas; technique ripped from Facebook
     *
     * http://github.com/jaz303/jquery-grab-bag/tree/master/javascripts/jquery.autogrow-textarea.js
     */
    $.fn.autogrow = function(options)
    {
        return this.filter('textarea').each(function()
        {
            var self         = this;
            var $self        = $(self);
            var minHeight    = $self.height();
            var noFlickerPad = $self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;

            var shadow = $('<div></div>').css({
                position:    'absolute',
                top:         -10000,
                left:        -10000,
                width:       $self.width(),
                fontSize:    $self.css('fontSize'),
                fontFamily:  $self.css('fontFamily'),
                fontWeight:  $self.css('fontWeight'),
                lineHeight:  $self.css('lineHeight'),
                resize:      'none',
                'word-wrap': 'break-word'
            }).appendTo(document.body);

            var update = function(event)
            {
                var times = function(string, number)
                {
                    for (var i=0, r=''; i<number; i++) r += string;
                    return r;
                };

                var val = self.value.replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/&/g, '&amp;')
                    .replace(/\n$/, '<br/>&nbsp;')
                    .replace(/\n/g, '<br/>')
                    .replace(/ {2,}/g, function(space){ return times('&nbsp;', space.length - 1) + ' ' });

                // Did enter get pressed?  Resize in this keydown event so that the flicker doesn't occur.
                if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
                    val += '<br />';
                }

                shadow.css('width', $self.width());
                shadow.html(val + (noFlickerPad === 0 ? '...' : '')); // Append '...' to resize pre-emptively.
                $self.height(Math.max(shadow.height() + noFlickerPad, minHeight));
            }

            $self.change(update).keyup(update).keydown({event:'keydown'},update);
            $(window).resize(update);

            update();
        });
    };
})(jQuery);

$(document).on('click', 'textarea', function() {
    $('textarea').autogrow();
});

$('#backend-news-search').on('click', function() {
    var text = $('#news-search-text').val();
    if (text) {
        window.location.href = '/backend/news?s=' + text;
    }
    return false;
});
