@extends('panel.layout')

@section('content')

    <div style="overflow: scroll" class="modal fade bd-example-modal-lg" id="update_ads_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">İlan Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_ads">
                        <div class="row mt-3">
                            <div class="input-group mb-3 col-6" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Başlık</span>
                                </div>
                                <input type="text" name="title" id="titleUpdate" class="form-control" aria-label="Başlık" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3 col-6" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">İletişim</span>
                                </div>
                                <input type="text" name="contact" id="contactUpdate" class="form-control" aria-label="İletişim" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3 col-3" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <input type="radio" name="is_whatsapp" id="is_whatsapp_update_1" value="1">
                                    <span>Whatsapp</span>
                                </div>
                            </div>
                            <div class="input-group mb-3 col-3" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <input type="radio" name="is_whatsapp" id="is_whatsapp_update_0" value="0">
                                    <span>Telefon</span>
                                </div>
                            </div>
                        </div>

                        <textarea class="summernote" id="ads_content_update_cke" cols="30" rows="10"></textarea>


                        <input type="hidden" name="updateId" id="updateId">

                        <span id="inputGroup-sizing-default">İlan Slider Resmi (Birden fazla seçebilirsiniz.)</span>
                        <br><br>
                        <input type="file" name="contentFiles[]" multiple id="updateContentFile">
                        <br><br>
                        <div class="border w-50" id="updateFileList">

                        </div>
                        <br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="updateAdsPost()" class="btn btn-primary">Kaydet</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    <div style="overflow: scroll" class="modal fade bd-example-modal-lg" id="add-ad-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">İlan Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_ads">
                        <div class="row mt-3">
                            <div class="input-group mb-3 col-6" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Başlık</span>
                                </div>
                                <input type="text" name="title" id="title" class="form-control" aria-label="Başlık" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3 col-6" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">İletişim</span>
                                </div>
                                <input type="text" name="contact" id="contact" class="form-control" aria-label="İletişim" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3 col-3" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <input type="radio" name="is_whatsapp" id="is_whatsapp_0" checked value="1">
                                    <span>Whatsapp</span>
                                </div>
                            </div>
                            <div class="input-group mb-3 col-3" style="margin-top: 20px">
                                <div class="input-group-prepend">
                                    <input type="radio" name="is_whatsapp" id="is_whatsapp_1" value="0">
                                    <span>Telefon</span>
                                </div>
                            </div>
                        </div>

                        <textarea class="summernote" id="ads_content" cols="30" rows="10"></textarea>


                        <span id="inputGroup-sizing-default">İlan Slider Resmi (Birden fazla seçebilirsiniz.)</span>
                        <br>
                        <input type="file" name="contentFiles[]" multiple id="createContentFile">
                        <br><br>
                        <div class="border w-50" id="fileList">

                        </div>

                        <div id="expertise" class="row">
                            <div class="input-group mb-3 col-12">
                                <span>Özellikler</span>
                            </div>
                            <div class="input-group mb-3 col-12">

                                <span class="btn btn-primary" onclick="addExpertise()">+</span> <span class="btn btn-primary" onclick="removeExpertise()">-</span>
                            </div>
                            <br><br>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="createAds()" class="btn btn-primary">Kaydet</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid pt-5">
        <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title justify-content-center">
                    <i class="fa fa-bullhorn mr-1" aria-hidden="true"></i>
                    İlanlar
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="ads-table" class="display nowrap dataTable cell-border" style="width:100%">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Başlık</th>
                        <th>İletişim</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Başlık</th>
                        <th>İletişim</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#add-ad-modal"><i class="fas fa-plus"></i> İlan Ekle</button>
            </div>
        </div>
        <!-- /.card -->
    </div>




    <script type="text/javascript">
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 300,                 // set editor height
                width: "90%",                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                dialogsInBody: true
            });
        });

        var expertiseSayac = 1;

        var expertiseSayacUpdate = 1;

        function addExpertise(){
            $('#expertise').append('<div class="input-group mb-3 col-6">\n' +
                '                                <div class="input-group-prepend">\n' +
                '                                    <span class="input-group-text" id="inputGroup-sizing-default">Özellik Adı</span>\n' +
                '                                </div>\n' +
                '                                <input type="text" name="attribute_name_'+expertiseSayac+'" class="form-control" aria-label="Alan Adı" aria-describedby="inputGroup-sizing-default">\n' +
                '                            </div>' + '<div class="input-group mb-3 col-6">\n' +
                '                                <div class="input-group-prepend">\n' +
                '                                    <span class="input-group-text" id="inputGroup-sizing-default">Değer</span>\n' +
                '                                </div>\n' +
                '                                <input type="text" name="attribute_value_'+expertiseSayac+'" class="form-control" aria-label="Alan Adı" aria-describedby="inputGroup-sizing-default">\n' +
                '                            </div>');
            expertiseSayac++;
        }

        function removeExpertise(){



            if ($('#expertise').children().last().hasClass('input-group')){
                $('#expertise').children().last().remove();
                expertiseSayac--;
            }

        }

        var fileList = $('#fileList');
        fileList.css('display', 'none');

        $("input#createContentFile").change(function() {
            fileList.css('display', 'block');
            fileList.html('');
            var names = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                names.push($(this).get(0).files[i].name);
            }
            $.each(names, function (index, value){
                fileList.append('<div class="w-100 border-bottom">'+value+'</div>');
            });
        });

        var updateFileList = $('#updateFileList');
        updateFileList.css('display', 'none');


        $("input#updateContentFile").change(function() {
            updateFileList.css('display', 'block');
            updateFileList.html('');
            var names = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                names.push($(this).get(0).files[i].name);
            }
            $.each(names, function (index, value){
                updateFileList.append('<div class="w-100 border-bottom">'+value+'</div>');
            });
        });



        function deleteAds(id){
            Swal.fire({
                icon: "warning",
                title:"Emin misiniz?",
                html: "Bu ilanı silmek istediğinize emin misiniz?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "Onayla",
                cancelButtonText: "İptal",
                cancelButtonColor: "#e30d0d"
            }).then((result)=>{
                if (result.isConfirmed){
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('panel.ads.delete') !!}',
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function (){
                            Swal.fire({
                                icon: "success",
                                title:"Başarılı",
                                showConfirmButton: true,
                                confirmButtonText: "Tamam"
                            });
                            table.ajax.reload();
                        },
                        error: function (){
                            Swal.fire({
                                icon: "error",
                                title:"Hata!",
                                html: "<div id=\"validation-errors\"></div>",
                                showConfirmButton: true,
                                confirmButtonText: "Tamam"
                            });
                            $.each(data.responseJSON.errors, function(key,value) {
                                $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div>');
                            });
                        }
                    });
                }
            });
        }


        function createAds(){

            var formData = new FormData(document.getElementById('create_ads'));

            formData.append('ads_content',$('#ads_content').summernote('code'));


            $.ajax({
                type: 'POST',
                url: '{{route('panel.ads.create')}}',
                data:formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData:false,
                success: function (){
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı',
                        html: 'İlan başarıyla oluşturuldu!'
                    });

                    var elements = document.getElementById("create_ads").elements;

                    for (var i = 0, element; element = elements[i++];) {
                        if (element.id !== "is_whatsapp_1" && element.id !== "is_whatsapp_0")
                        element.value = "";
                    }

                    document.getElementById('release_date').value = '{{substr(\Carbon\Carbon::now()->addHours(3),0,10)}}T{{substr(\Carbon\Carbon::now()->addHours(3),11,5)}}';
                    $('#ads_content').summernote('code','')

                    $('#add-ad-modal').modal("toggle");

                    table.ajax.reload();

                },
                error: function (){
                    Swal.fire({
                        icon: 'error',
                        title: 'Başarısız',
                        html: 'Bilinmeyen bir hata oluştu.'
                    });
                }
            });


        }


        $('#update_ads_modal').on('shown.bs.modal', function() {
            $('#ads_content_update_cke').summernote();
        })
        function updateAdsPost(){
            var formData = new FormData(document.getElementById('update_ads'));

            formData.append('ads_content',$('#ads_content_update_cke').summernote('code'));


            $.ajax({
                type: 'POST',
                url: '{{route('panel.ads.update')}}',
                data:formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData:false,
                success: function (){
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı',
                        html: 'İlan başarıyla güncellendi!'
                    });

                    var elements = document.getElementById("update_ads").elements;

                    for (var i = 0, element; element = elements[i++];) {
                        if (element.id !== "is_whatsapp_update_0" && element.id !== "is_whatsapp_update_1"){
                            element.value = "";
                        }
                    }
                    $('#ads_content_update_cke').summernote('code','')


                    $('#update_ads_modal').modal("toggle");
                    table.ajax.reload();

                    updateFileList.css('display', 'none');

                },
                error: function (){
                    Swal.fire({
                        icon: 'error',
                        title: 'Başarısız',
                        html: 'Bilinmeyen bir hata oluştu.'
                    });
                }
            });
        }

        function updateAds(id){
            var title = $('#titleUpdate');


            $.ajax({
                type: 'POST',
                url: '{{route('panel.ads.get')}}',
                data: {id:id},
                success: function (data){
                    $('#ads_content_update_cke').summernote('code',data.content);
                    title.val(data.title);
                    $('#updateId').val(id);

                    $('#contactUpdate').val(data.contact);


                    updateFileList.css('display', 'block');

                    updateFileList.html('');
                    $.each(data.files, function (index, value){
                        updateFileList.append('<div class="w-100 border-bottom"><a target="_blank" href="{{route('content.show.file',0)}}'+value.id+'">'+value.path.substr(14)+'</a></div>');
                    });

                    if (data.is_whatsapp === 1){
                        $("#is_whatsapp_update_0").prop('checked', false);
                        $("#is_whatsapp_update_1").prop('checked', true);
                    }else{
                        $("#is_whatsapp_update_1").prop('checked', false);
                        $("#is_whatsapp_update_0").prop('checked', true);
                    }

                    $('#update_ads_modal').modal("toggle");

                },
                error: function (){
                    Swal.fire({
                        icon: 'error',
                        title: 'Başarısız',
                        html: 'Bilinmeyen bir hata oluştu.'
                    });
                }
            });
        }

        function updateActive(id){
            $.ajax({
                type: 'GET',
                url: '{{route('panel.ads.update_active')}}',
                data: {id:id},
                error: function (){
                    Swal.fire({
                        icon: 'error',
                        title: 'Başarısız',
                        html: 'Bilinmeyen bir hata oluştu.'
                    });
                }
            });
        }


        var table = $('#ads-table').DataTable( {
            order: [
                [0,'DESC']
            ],
            processing: true,
            serverSide: true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Turkish.json"
            },
            ajax: '{!!route('panel.ads.fetch')!!}',
            columns: [
                {data: 'id'},
                {data: 'title'},
                {data: 'contact'},
                {data: 'update'},
                {data: 'delete'}
            ]
        } );

    </script>



@endsection
