


<div class="wrap-content container" id="container">
    <!-- start: PAGE TITLE -->
    <section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">{{ $title }}</h1>
                <br>
                <a href="{{ route('pagesAdd') }}" type="button" class="btn btn-wide btn-primary">
                    Добавить новую
                </a>
            </div>
        </div>
    </section>

    <!-- start: STRIPED ROWS -->
    <div class="container-fluid container-fullw pages">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover" id="sample-table-2">
                    <thead>
                    <tr>
                        <th class="center">Фото</th>
                        <th>Название</th>
                        <th class="hidden-xs">Алиас</th>
                        <th class="col-lg-3 col-md-4"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td class="center"><img src="{{ asset($page->image) }}" class="img-rounded" alt="image"/></td>
                            <td>{{ $page->name }}</td>
                            <td class="hidden-xs">{{ $page->alias }}</td>

                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a
                                        href="{{ route('pagesEdit', $page->id) }}"
                                        class="btn btn-transparent btn-xs"
                                        tooltip-placement="top"
                                        tooltip="Edit"
                                    >
                                        <span class="label label-sm label-default">Редактировать</span>
                                    </a>
                                    <a
                                        href="#"
                                        class="btn btn-transparent btn-xs tooltips"
                                        tooltip-placement="top"
                                        tooltip="Remove"
                                        data-toggle="modal"
                                        data-target="#deleteModal"
                                        data-page="{{ $page->id }}"
                                    >
                                        <span class="label label-sm label-danger">Удалить</span>
                                    </a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="btn-group" dropdown>
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" dropdown-toggle>
                                            <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right dropdown-light" role="menu">
                                            <li>
                                                <a href="{{ route('pagesEdit', $page->id) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a
                                                    href="#"
                                                    data-toggle="modal"
                                                    data-target="#deleteModal"
                                                    data-page="{{ $page->id }}"
                                                >
                                                    Remove
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end: STRIPED ROWS -->
</div>

<!-- Default Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Удаление стрнаицы</h4>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить страницу?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
                    Закрыть
                </button>
                <form action="" method="post" name="page-delete">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="Удалить">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Default Modal -->


<style>
    .pages img{
        width: 40px;
        height: 40px;
    }

    form[name="page-delete"] input[type="submit"]{
        margin-right: 10px;
    }
</style>

<script>
    $(document).ready(function () {
        $('a[data-target="#deleteModal"]').on('click', function () {
            var page_id = $(this).data('page');
            console.log(page_id);
            $('#deleteModal').find('form').attr('action','/admin/pages/edit/' + page_id);
        });

        $('.dropdown-toggle').on('click', function () {
            $(this).parent().find('.dropdown-menu').slideToggle();
            $('.dropdown-toggle').not(this).parent().find('.dropdown-menu').slideUp();
        })
    })
</script>