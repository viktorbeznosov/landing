<div id="panel_edit_account" class="tab-pane fade active in">
    <div id="panel_edit_account" class="tab-pane fade active in">

        <form action="{{ route('servicesAdd') }}" role="form" id="form" method="post">
            {{ csrf_field() }}
            <fieldset>
                <legend>
                    {{ $title }}
                </legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                Название
                            </label>
                            <input type="text" placeholder="Название" class="form-control" id="name" name="name" value="">
                        </div>

                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Текст
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="note-editor">
                                        <textarea class="form-control autosize area-animated" name="text"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">
                                Иконка
                            </label>
                            <input type="text" placeholder="Тип" class="form-control" id="icon" name="icon" value="">
                        </div>

                    </div>

                </div>
            </fieldset>
            <div class="col-md-1">
                <button class="btn btn-primary pull-right" type="submit">
                    Сохранить <i class="fa fa-arrow-circle-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>
