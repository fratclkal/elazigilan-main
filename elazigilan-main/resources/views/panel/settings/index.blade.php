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
                                <span>Uzmanlık Alanları</span>
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
                    <i class="fa fa-cog mr-1" aria-hidden="true"></i>
                    Ayarlar
                </h3>
            </div>
            <!-- /.card-header -->
            <form id="update" action="{{route('panel.settings.update')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card-body">

                    <div class="row mt-3">
                        @if(isset($okay))
                            Başarıyla güncellendi!
                        @endif
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col-12 col-md-6" style="margin-top: 20px">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Sekme Başlığı</span>
                            </div>
                            <input type="text" name="title" value="{{$siteSettings->title}}" id="titleUpdate" class="form-control" aria-label="Sekme Başlığı" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3 col-12 col-md-6" style="margin-top: 20px">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Başlık</span>
                            </div>
                            <input type="text" name="page_title" value="{{$siteSettings->page_title}}" id="contactUpdate" class="form-control" aria-label="Başlık" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>

                    <span id="inputGroup-sizing-default">Sayfa etiketleri (SEO)</span>
                    <textarea class="summernote" name="tags" id="ads_content_update_cke" cols="30" rows="10">{{$siteSettings->tags}}</textarea>

                    <span id="inputGroup-sizing-default">Sayfa açıklaması</span>
                    <textarea class="summernote" name="description" id="ads_content_update_cke" cols="30" rows="10">{{$siteSettings->description}}</textarea>

                    <span id="inputGroup-sizing-default">Üst Resimler</span><br>
                    <input type="file" name="contentFiles[]" multiple id="createContentFile">
                    <br><br>

                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button type="submit" class="btn btn-primary float-right">Güncelle</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 300,                 // set editor height
                width: "90%",                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                dialogsInBody: true
            });
        });
    </script>



@endsection
