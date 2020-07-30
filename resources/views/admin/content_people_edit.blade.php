<div id="panel_edit_account" class="tab-pane fade active in">

    <form action="{{ route('peopleEdit', $people->id) }}" role="form" id="form" method="post" enctype="multipart/form-data" >
        {{ csrf_field() }}
        <fieldset>
            <legend>
                {{ $title }}
            </legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            Имя
                        </label>
                        <input type="text" placeholder="Название" class="form-control" id="name" name="name" value="{{ $people->name }}">
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Должность
                        </label>
                        <input type="text" placeholder="Тип" class="form-control" id="position" name="position" value="{{ $people->position }}">
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
                                    <textarea class="form-control autosize area-animated" name="text">{{ $people->text }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label>
                            Загрузка фото
                        </label>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                <img
                                        src="@if(isset($people->image) && $people->image != ''){{ asset($people->image) }}
                                        @else{{ asset('assets/img/no-image.jpg') }}
                                        @endif"
                                        alt="">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            <div class="user-edit-image-buttons">
                                <span class="btn btn-azure btn-file"><span class="fileinput-new">
                                    <i class="fa fa-picture"></i> Выберите фото</span><span class="fileinput-exists">
                                        <i class="fa fa-picture"></i> Сменить</span>
                                    <input type="file" name="image" id="image">
                                    <input type="hidden" value="{{ $people->image }}" name="old_image">
                                </span>
                                <a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">
                                    <i class="fa fa-times"></i> Удалить
                                </a>
                            </div>
                        </div>

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