var user_id    = localStorage.getItem('user_id');
var user_email = localStorage.getItem('user_email');
var user_name  = localStorage.getItem('user_name');
var token      = localStorage.getItem('token');

var registerBlock           = $('#register-block');
var loginBlock              = $('#login-block');
var announcementsBlock      = $('#announcements-block');
var announcementBlock       = $('#announcement-block');
var announcementCreateBlock = $('#announcement-form-block');

var announcements  = [];

jQuery.extend({
    getAnnouncements: function (data) {
        announcements  = [];
        var errorMessage   = null;
        var successMessage = null;

        if (token == null) {
            return null;
        }

        $.ajax({
            async: false,
            url: "/api/announcements",
            method: "GET",
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function (result) {
                announcements = result.data;
            },
            error: function (result) {
                errorMessage = result.responseJSON.message;

                if (result.status == 401) {
                    $.destroyAuth();
                }
            }
        });

        if (errorMessage != null) {
            $.displayErrorMessage(errorMessage);
        }
    },
    getAnnouncement: function (id) {
        var errorMessage   = null;
        var successMessage = null;

        if (token == null) {
            return null;
        }

        $.ajax({
            async: false,
            url: "/api/announcements/" + id,
            method: "GET",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function (result) {
                console.log(result);
            }
        });
    },
    createAnnouncement: function (data) {
        var errorMessage   = null;
        var successMessage = null;

        if (token == null) {
            return null;
        }

        $.ajax({
            async: false,
            url: "/api/announcements",
            method: "POST",
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                errorMessage = result.responseJSON.message;
            }
        });

        if (errorMessage == null) {
            $.displaySuccessMessage('Announcements successfully created!');
            $.authenticated();
        } else {
            $.displayErrorMessage(errorMessage);
        }
    },
    updateAnnouncement: function (id, data) {
        var errorMessage   = null;
        var successMessage = null;

        if (token == null) {
            return null;
        }

        $.ajax({
            async: false,
            url: "/api/announcements/" + id,
            method: "PATCH",
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                errorMessage = result.responseJSON.message;
            }
        });

        if (errorMessage == null) {
            $.displaySuccessMessage('Announcements successfully updated!');
            $.authenticated();
        } else {
            $.displayErrorMessage(errorMessage);
        }
    },
    deleteAnnouncement: function (announcement) {
        var errorMessage   = null;
        var successMessage = null;

        if (token == null) {
            return null;
        }

        $.ajax({
            async: false,
            url: "/api/announcements/" + announcement.id,
            method: "DELETE",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                errorMessage = result.responseJSON.message;
            }
        });

        if (errorMessage == null) {
            $.displaySuccessMessage('Announcements successfully deleted!');
            $.authenticated();
        } else {
            $.displayErrorMessage(errorMessage);
        }
    },
    register: function (data) {
        var errorMessage   = null;
        var successMessage = null;
        
        $.ajax({
            async: false,
            url: "/api/register",
            method: "POST",
            data: data,
            success: function (result) {

                console.log(result);

                localStorage.setItem('user_id', result.user.id);
                localStorage.setItem('user_name', result.user.name);
                localStorage.setItem('user_email', result.user.email);
                localStorage.setItem('token', result.access_token);

                user_id    = result.user.id;
                user_name  = result.user.name;
                user_email = result.user.email;
                token      = result.access_token;
            },
            error: function (result) {
                errorMessage = result.responseJSON.message;
            }
        });

        if (errorMessage == null) {
            $.authenticated();
        } else {
            $.displayErrorMessage(errorMessage);
        }
    },
    login: function (data) {
        var errorMessage   = null;
        var successMessage = null;

        $.ajax({
            async: false,
            url: "/api/login",
            method: "POST",
            data: data,
            success: function (result) {
                localStorage.setItem('user_id', result.user.id);
                localStorage.setItem('user_name', result.user.name);
                localStorage.setItem('user_email', result.user.email);
                localStorage.setItem('token', result.access_token);

                user_id    = result.user.id;
                user_name  = result.user.name;
                user_email = result.user.email;
                token      = result.access_token;
            },
            error: function (result) {
                errorMessage = result.responseJSON.message;
            }
        });

        if (errorMessage == null) {
            $.authenticated();
        } else {
            $.displayErrorMessage(errorMessage);
        }
    },
    logout: function (data) {
        var errorMessage   = null;
        var successMessage = null;

        $.ajax({
            async: false,
            url: "/api/logout",
            method: "DELETE",
            data: data,
            success: function (result) {
                $.destroyAuth();
            }
        });
    },
    destroyAuth: function () {
        localStorage.removeItem('user_id');
        localStorage.removeItem('user_name');
        localStorage.removeItem('user_email');
        localStorage.removeItem('token');

        user_id    = null;
        user_name  = null;
        user_email = null;
        token      = null;

        $.authenticated();
    },
    authenticated: function (data) {
        $('#global-danger-message').addClass('d-none');
        $('#global-success-message').addClass('d-none');
        $('#getAnnouncements').addClass('d-none');
        $('#getMyAnnouncements').addClass('d-none');
        $('#logout').addClass('d-none');

        registerBlock.removeClass('d-none');
        loginBlock.removeClass('d-none');
        announcementsBlock.addClass('d-none');
        announcementBlock.addClass('d-none');
        announcementCreateBlock.addClass('d-none');

        announcementCreateBlock.find('input').val('');
        announcementCreateBlock.find('textarea').val('');

        if (!data) {
            data = {};
        }

        if (token != null) {
            $('#getAnnouncements').removeClass('d-none');
            $('#getMyAnnouncements').removeClass('d-none');
            $('#logout').removeClass('d-none');
            registerBlock.addClass('d-none');
            loginBlock.addClass('d-none');
            announcementsBlock.removeClass('d-none');            
            announcementsBlock.find('table tbody tr').remove();

            $.getAnnouncements(data);

            if (!announcements || announcements.length < 1) {
                $('#announcements-block table tbody').append('<tr><td colspan="3" class="text-center">No announcements!</td></tr>');
            }

            $(announcements).each(function (key, item) {
                $('#announcements-block table tbody').append('<tr class="announcement-show" data-key="' + key + '">' +
                    '<td>' + item.title + '</td>' +
                    '<td>' + item.startDate + '</td>' +
                    '<td>' + item.endDate + '</td>' +
                '</tr>');
            });

            $('.announcement-show').click(function () {
                var key = $(this).data('key');

                $.showAnnouncement(announcements[key], key);
            });
        }
    },
    showAnnouncement: function (announcement, key) {
        announcementsBlock.addClass('d-none');
        announcementBlock.removeClass('d-none');

        announcementBlock.find('h2').text(announcement.title);
        announcementBlock.find('#announcement-content').html(announcement.content);
        announcementBlock.find('#announcement-start').text(announcement.startDate);
        announcementBlock.find('#toEdit').data('key', key);
        announcementBlock.find('#toDelete').data('key', key);
    },
    createForm: function (announcement) {
        announcementsBlock.addClass('d-none');
        announcementBlock.addClass('d-none');
        announcementCreateBlock.removeClass('d-none');
        announcementCreateBlock.attr('data-type', 'create');
        announcementCreateBlock.attr('data-id', '');
        announcementCreateBlock.find('[type="submit"]').text('Create');
    },
    editForm: function (announcement) {
        announcementsBlock.addClass('d-none');
        announcementBlock.addClass('d-none');
        announcementCreateBlock.removeClass('d-none');

        announcementCreateBlock.attr('data-type', 'edit');
        announcementCreateBlock.attr('data-id', announcement.id);
        announcementCreateBlock.find('[type="submit"]').text('Update');

        $('#title').val(announcement.title);
        $('#content').val(announcement.content);
        $('#startDate').val(announcement.startDate);
        $('#endDate').val(announcement.endDate);
        $('#active').prop('checked', false);

        if (announcement.active == 1) {
            $('#active').prop('checked', true);
        }
    },
    displayErrorMessage: function (message) {
        $('#global-danger-message').removeClass('d-none');
        $('#global-danger-message').text(message);
    },
    displaySuccessMessage: function (message) {
        $('#global-success-message').removeClass('d-none');
        $('#global-success-message').text(message);
    }
});

// Initate Homepage and Check Auth
$.authenticated();

$('#logout').click(function () {
    $.logout();
});

$('.toList').click(function () {
    $.authenticated();
});

$('.toCreate').click(function () {
    $.createForm();
});

$('#toEdit').click(function () {
    var key = $(this).data('key');

    $.editForm(announcements[key]);
});

$('#toDelete').click(function () {
    var key = $(this).data('key');

    if (confirm("Are you sure?")) {
        $.deleteAnnouncement(announcements[key]);
    }
});

$('#getAnnouncements').click(function () {
    announcementsBlock.find('.card-header span').text('Announcements');
    $.authenticated();
});

$('#getMyAnnouncements').click(function () {
    announcementsBlock.find('.card-header span').text('My Announcements');
    $.authenticated({user_id: user_id});
});
