<div id="panel_edit_account" class="tab-pane fade active in">

    <form action="{{ route('portfolioEdit', $portfolio->id) }}" role="form" id="form" method="post" enctype="multipart/form-data" >
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
                        <input type="text" placeholder="Название" class="form-control" id="name" name="name" value="{{ $portfolio->name }}">
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Тип
                        </label>
                        <input type="text" placeholder="Тип" class="form-control" id="filter" name="filter" value="{{ $portfolio->filter }}">
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
                                    src="@if(isset($portfolio->image) && $portfolio->image != ''){{ asset($portfolio->image) }}
                                         @else{{ asset('assets/img/no-image.png') }}
                                         @endif"
                                    alt="">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            <div class="user-edit-image-buttons">
                                <span class="btn btn-azure btn-file"><span class="fileinput-new">
                                    <i class="fa fa-picture"></i> Выберите фото</span><span class="fileinput-exists">
                                        <i class="fa fa-picture"></i> Сменить</span>
                                    <input type="file" name="image" id="image">
                                    <input type="hidden" value="{{ $portfolio->image }}" name="old_image">
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