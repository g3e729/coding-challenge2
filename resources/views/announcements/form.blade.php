<div id="announcement-form-block" data-type="create" data-id="" class="card mb-5">
    <div class="card-header">{{ __('Create Announcement') }}</div>

    <div class="card-body">

        <form id="create-announcement" action="#">

            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="email" value="" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                <div class="col-md-6">
                    <textarea id="content" class="form-control" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="startDate" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                <div class="col-md-6">
                    <input class="form-control datepicker" id="startDate" name="startDate" placeholder="yyyy-mm-dd" type="text"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="endDate" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

                <div class="col-md-6">
                    <input class="form-control datepicker" id="endDate" name="endDate" placeholder="yyyy-mm-dd" type="text"/>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="active" checked>

                        <label class="form-check-label" for="active">
                            {{ __('Active') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="button" class="btn btn-primary toList">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var titleInput = $('#title');
    var contentInput = $('#content');
    var startDateInput = $('#startDate');
    var endDateInput = $('#endDate');
    var activeInput = $('#active');

    $('#create-announcement').submit(function (e) {
        
        e.preventDefault();

        if ($('#announcement-form-block').data('type') == 'edit') {
            $.updateAnnouncement($('#announcement-form-block').data('id'), {
                title: titleInput.val(),
                content: contentInput.val(),
                startDate: startDateInput.val(),
                endDate: endDateInput.val(),
                active: activeInput.is(':checked') ? 1 : 0
            });
        } else {
            $.createAnnouncement({
                title: titleInput.val(),
                content: contentInput.val(),
                startDate: startDateInput.val(),
                endDate: endDateInput.val(),
                active: activeInput.is(':checked') ? 1 : 0
            });
        }
    });
</script>
